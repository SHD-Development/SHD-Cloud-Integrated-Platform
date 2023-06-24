<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use Spatie\Permission\Models\Role;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Balance;

class UserInfoApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function getTotalUserCount(Request $request)
    {
        $usersCount = User::count();
        return response()->json(['amount' => $usersCount ], 200);
    }
    public function getAdminUserCount(Request $request)
    {
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminUsersCount = $adminRole->users()->count();
            return response()->json(['amount' => $adminUsersCount ], 200);
        } else {
            return response()->json(['message' => 'Server Error' ], 500);
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
