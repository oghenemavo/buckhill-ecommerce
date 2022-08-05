<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserPutRequest;
use App\Interfaces\IAdminRepository;

class UserController extends Controller
{
    public function __construct(protected IAdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    public function allUsers()
    {
        $users = $this->adminRepository->fetchUsers();

        return response()->json([
            'status' => true,
            'message' => 'All Users Fetched successfully',
            'data' => $users,
        ]);
    }

    public function editUser(UserPutRequest $request, $uuid)
    {
        $user = $this->adminRepository->updateUser($request->all(), $uuid);

        if ($user) {
            return response()->json([
                'status' => true,
                'message' => 'User updated successfully',
            ]);
        }

        return response()->json([
            'status' => false,
            'message' => 'Unable to update user',
        ]);
    }
}
