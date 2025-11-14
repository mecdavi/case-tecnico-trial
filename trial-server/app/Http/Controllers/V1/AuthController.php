<?php

namespace App\Http\Controllers\V1;

use App\Exceptions\InvalidCredentialsException;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Service\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct( AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Efetua o login do usuário e retorna o token de autenticação.
     * @param LoginRequest $request
     * @return JsonResponse
     */
    public function login(LoginRequest $request ) : JsonResponse
    {
        try {
            $authToken = $this->authService->login(
                $request->string('email')->value(),
                $request->string('password')->value()
            );
            // dd($authToken);
            return response()->json([
                'token' => $authToken["token"],
                'token_type' => 'Bearer',
                'usuario' => $authToken["user"],
            ]);
        }catch ( InvalidCredentialsException $exception){
            return response()->json([
                'message' => $exception->getMessage()
            ], 401);
        }

    }
    /**
     * Retorna os dados do usuário autenticado.
     * @param Request $request
     * @return UserResource
     */
    
    public function me(Request $request): UserResource
    {
        return new UserResource($request->user());
    }

    public function passwordRecoveryRequest( Request $request ): JsonResponse
    {
        $request->validate(['email' => 'required|email']);

        $usuario = User::query()->where('email', $request['email'])->first();
        if($usuario) {
            $token = Password::createToken($usuario);

            $url = 'teste url';

            $emailBody = [
                'usuario_nome' => $usuario->name,
                'url'          => $url
            ];
            #disparar email
            #Mail::to($usuario->email)
            #   ->send(new RecuperarSenhaMail($emailBody));
            echo('Email enviado');
        }

        return response()->json([
            'message' => 'Se um usuário com esse e-mail existir, um link de redefinição de senha será enviado para o e-mail informado.'
        ]);
    }

    public function resetPassword( Request $request ): JsonResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
            'token' => 'required'
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password),
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? response()->json(['message' => 'Senha redefinida com sucesso.'])
            : response()->json(['message' => 'Erro ao redefinir a senha.'], 500);
    }
}