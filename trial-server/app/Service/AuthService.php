<?php

namespace App\Service;

use App\Exceptions\InvalidCredentialsException;
use App\Http\Requests\LoginRequest;
use App\Models\User;

class AuthService
{
    /**
     * @throws InvalidCredentialsException
     */
    public function login(string $email, string $password ): array
    {
        $user = User::query()->where('email', $email)->first();
        if (!$user) {
            throw new InvalidCredentialsException('Credenciais inválidas');
        }

        if (!password_verify($password, $user->password)) {
            throw new InvalidCredentialsException('Credenciais inválidas');
        }
            $token = $user->createToken('auth_token')->plainTextToken;
            // dd(["Token"=>$token,"User"=>$user]);
            return ["token"=>$token,"user"=>$user];
        }
    }