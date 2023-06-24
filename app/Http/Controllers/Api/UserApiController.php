<?php

namespace App\Http\Controllers\Api;
use Spatie\DiscordAlerts\Facades\DiscordAlert;
use Illuminate\Support\Facades\Http;
use App\Models\Balance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class UserApiController extends Controller
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
    public function store(Request $request)
    {
        $webhookUrl = config('scip.webhook.url');

        $request->validate([
            'email' => 'required|email|unique:users',
            'name' => 'required',
            'password' => 'required|min:8',
            'role' => 'required|array',
        ]);

        $user = User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make($request->password),
        ]);
        $roleName = $request->role;
        $roles = Role::whereIn('name', $roleName)->get();
        $user->syncRoles($roles);
        // foreach ($request->role as $roleId) {
        //     $role = Role::findOrFail($roleId);
        //     $user->assignRole($role);
        // }
        $balance = Balance::create([
            'user_id' => $user->id,
            'amount' => 0,
        ]);
        Http::post($webhookUrl, [
            'content' => "",
            'embeds' => [
                [
                    'title' => "SHD Cloud Integrated Platform 線上整合平台",
                    'description' => "✅ 用戶已經創建! 他的用戶名稱為 `{$user->name}` 並且他的電子郵件為 `{$user->email}`",
                    'color' => '323232',
                ]
            ],
        ]);
        return response()->json(['message' => 'User created successfully'], 201);
        

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
