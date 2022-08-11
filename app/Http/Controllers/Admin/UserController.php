<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaginationRequest;
use App\Http\Requests\UserPutRequest;
use App\Repositories\AdminRepository;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param  \App\Repositories\AdminRepository  $adminRepository
     * @return void
     */
    public function __construct(protected AdminRepository $adminRepository)
    {
        $this->adminRepository = $adminRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Http\Requests\PaginationRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function allUsers(PaginationRequest $request)
    {
        $users = $this->adminRepository->fetchUsers($request->validated());

        return response()->json([
            'status' => true,
            'message' => 'All Users Fetched successfully',
            'data' => $users,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserPutRequest  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uuid
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($uuid)
    {
        $this->adminRepository->deleteUser($uuid);

        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully',
        ]);
    }
}
