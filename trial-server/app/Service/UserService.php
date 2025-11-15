<?php

namespace App\Service;

use App\Enums\UserRoleEnum;
use App\Models\{Client, User};
use Illuminate\Support\Facades\DB;

class UserService
{
    public function createUser(array $data)
    {
        try {
            switch ($data['role']) {
                case 'Admin':
                    $user = User::query()->create($data);
                    $user->assignRole(UserRoleEnum::ADMIN);

                    return $user;
                    break;

                case 'User':
                    DB::beginTransaction();
                    
                    $user = User::query()->create([
                        'name'     => $data['name'],
                        'email'    => $data['email'],
                        'password' => bcrypt($data['password']),
                    ]);

                    $user->assignRole(UserRoleEnum::USER);

                    DB::commit();

                    return $user;
                    break;

                default:
                    throw new \Exception("Nenhuma permissão encontrada!", 422);
                    break;
            }
        } catch (\Exception $e) {
            $error = [
                "data" => [
                    "message" => $e->getMessage(),
                ]
            ];

            DB::rollback();

            return response()->json($error, 500);
        }
    }

    public function updateUser(array $data, int $id)
    {
        try {
            DB::beginTransaction();

            $user = User::query()->findOrFail($id);
            $user->update($data);

            switch ($data['role']) {
                case 'Admin':

                    $user->update();
                    $user->assignRole(UserRoleEnum::ADMIN);
                    break;

                case 'User':
                    $user->update();
                    $user->assignRole(UserRoleEnum::USER);
                    break;
                default:
                    throw new \Exception("Nenhuma permissão encontrada!", 422);
                    break;
            }

            DB::commit();

            return $user;
        } catch (\Exception $e) {
            $error = [
                "data" => [
                    "message" => $e->getMessage(),
                ]
            ];

            DB::rollback();

            return response()->json($error, 500);
        }
    }
}