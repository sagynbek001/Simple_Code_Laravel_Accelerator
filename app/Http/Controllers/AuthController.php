<?php

namespace App\Http\Controllers;

use App\Services\v1\AuthService;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\LoginResource;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
        //Session::flush();
        //Auth::logout();
        return $this->result($this->authService->logout($request->user()['phone']));
    }
}
