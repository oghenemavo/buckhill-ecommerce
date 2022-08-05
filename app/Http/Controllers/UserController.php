<?php

namespace App\Http\Controllers;

use App\Events\LoginUser;
use App\Http\Requests\UserPostRequest;
use App\Http\Requests\UserPutRequest;
use App\Interfaces\IUserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    protected IUserRepository $_userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->middleware('auth:api')->except(['login', 'create']);
        $this->_userRepository = $userRepository;
    }

    public function index()
    {
        $user = auth()->user();

        return response()->json([
            'status' => true,
            'message' => 'User Retrieved Successfully',
            'data' => $user,
        ]);
    }

    public function create(UserPostRequest $request)
    {
        $user = $this->_userRepository->createUser($request->all());

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
                'data' => $user,
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to create User',
        ]);
    }

    public function edit(UserPutRequest $request)
    {
        $user = $this->_userRepository->updateUser($request->all(), auth()->user());

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'User updated successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to update User',
        ]);
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth::attempt($credentials);
        if (! $token) {
            return response()->json([
                'status' => false,
                'message' => 'Unauthorized',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $user = Auth::user();
        event(new LoginUser($user));

        return response()->json([
            'status' => true,
            'data' => $user,
            'authorization' => [
                'token' => $token,
                'type' => 'bearer',
            ],
        ]);
    }

    public function refresh()
    {
        return response()->json([
            'status' => true,
            'user' => auth()->user(),
            'authorization' => [
                'token' => Auth::refresh(),
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

    public function remove()
    {
        auth()->user()->delete();

        return response()->json([
            'status' => true,
            'message' => 'Successfully Deleted out',
        ]);
    }
}
