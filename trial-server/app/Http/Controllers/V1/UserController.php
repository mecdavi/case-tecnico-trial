<?php

namespace App\Http\Controllers\V1;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Service\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): AnonymousResourceCollection
    {
        $request->validate([
            'busca'    => 'nullable|string',
            /**
             * Ordenar por.
             * @var string
             * @example id, name, created_at
             */
            'order'    => 'nullable|string',
            /**
             * Classificar por.
             * @var string
             * @example ASC/DESC
             */
            'sort'     => 'nullable|in:ASC,DESC',
            'page'     => 'nullable|integer|min:1',
            'per_page' => 'nullable|integer|min:1|max:100',
        ]);

        $query = User::query();

        // $query->whereNotIn('id', [$request->user()->id]);

        if($request->filled('busca')) {
            $query->whereRaw("(
                LOWER(name) like LOWER('%{$request['busca']}%') OR
                LOWER(email) like LOWER('%{$request['busca']}%')
            )");

            $query->orWhereHas('client', function ($query) use ($request) {
                $query->whereRaw("(
                    LOWER(corporate_name) like LOWER('%{$request['busca']}%') OR
                    LOWER(area_of_activity) like LOWER('%{$request['busca']}%') OR
                    cnpj like '%{$request['busca']}%'
                )");
            });
        }

        $user = $query->orderBy($request->input('order', 'id'), $request->input('sort', 'DESC'))
            ->paginate($request->input('per_page', 10));

        return UserResource::collection($user);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserStoreRequest $request): UserResource
    {

        $user = $this->userService->createUser($request->validated());
        return new UserResource($user);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): UserResource
    {
        $user = User::query()->findOrFail($id);

        return new UserResource($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserUpdateRequest $request, string $id): UserResource
    {
        // dd($request);
        $user = User::query()->findOrFail($id);
        $user = $this->userService->updateUser($request->validated(), $user->id);
        return new UserResource($user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        DB::beginTransaction();

        $user = User::query()->findOrFail($id);

        if(isset($user->client_id) && $user->client_id) {
            $clientId = $user->client_id;

            $user->client_id = null;
            $user->update();

            $client = Client::query()->where('id', $clientId)->first();
            if($client) {
                if(count($client->projects)) {
                    foreach($client->projects as $project) {
                        $project->survey_forms()->delete();
                        $project->delete();
                    }
                }
                $client->addresses()->delete();
                $client->forceDelete();
            }
        }

        $user->delete();

        DB::commit();

        return response()->json([
            'message' => 'Usuário deletado com sucesso.'
        ]);
    }
}