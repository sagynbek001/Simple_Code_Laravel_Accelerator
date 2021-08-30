<?php

namespace App\Http\Controllers;

use App\Services\v1\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request)
    {
        return  $this->result($this->authService->register($request->all()));
    }

    public function get_profile(Request $request)
    {
        return new ProfileResource($request->user());
    }

    public function login(LoginRequest $request)
    {
        return $this->result($this->authService->login($request->all()));
    }

    public function logout(Request $request)
    {
        return $this->result($this->authService->logout($request->user()['phone']));
    }
}
