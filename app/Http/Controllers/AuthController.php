<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AuthService;


/**
 * Class AuthController
 *
 * @package App\Http\Controllers
 * @author Vinícius Siqueira
 * @link https://github.com/ViniciusSCS
 * @date 2024-10-01 15:52:14
 * @copyright UniEVANGÉLICA
 */
class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        return $this->authService->login($credentials); 
    }
    
    public function logout(Request $request)
    {
        $tokenId = $request->user()->token()->id;
        return $this->authService->logout($tokenId);
    }
}
