<?php

namespace App\Http\Controllers\Admin;

use App\Events\LoginUser;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserPostRequest;
use App\Repositories\AdminRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private static $is_admin = 1;

    public function __construct(protected AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function store(UserPostRequest $request)
    {
        $admin = $this->adminRepository->createAdmin($request->all());

        if ($admin) {
            return response()->json([
                'status' => true,
                'message' => 'Admin created successfully',
                'data' => $admin,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to create Admin',
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');
        $credentials['is_admin'] = self::$is_admin;

        $token = Auth::attempt($credentials);
        if (! $token) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $admin = Auth::user();
        event(new LoginUser($admin));

        return response()->json([
            'status' => true,
            'data' => $admin,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

    public function logout()
    {
        auth()->logout();

        return response()->json([
            'status' => true,
            'message' => 'Successfully logged out',
        ]);
    }
}
