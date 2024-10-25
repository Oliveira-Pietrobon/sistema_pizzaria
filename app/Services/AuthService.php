<?php
namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Laravel\Passport\TokenRepository;

class AuthService
{
    protected $tokenRepository;

    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    public function login($credentials)
    {   
        if (Auth::attempt(['email' => strtolower($credentials['email']), 'password' => $credentials['password']])) {
            $user = auth()->user();
            $user->token = $user->createToken($user->email)->accessToken;

            return [
                'status' => 200,
                'message' => 'Usuário logado com sucesso!',
                'usuario' => $user
            ];
        }

        return [
            'status' => 404,
            'message' => 'Usuário ou senha incorreto',
            'data'=> Auth::attempt(['email' => strtolower($credentials['email']), 'password' => $credentials['password']])
        ];
    }

    public function logout($tokenId)
    {
        $this->tokenRepository->revokeAccessToken($tokenId);

        return [
            'status' => true,
            'message' => 'Usuário deslogado com sucesso!'
        ];
    }
}
