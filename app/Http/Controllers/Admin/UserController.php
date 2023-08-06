<?php

namespace App\Http\Controllers\Admin;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\DiscordAlerts\Facades\DiscordAlert;
use App\Models\Balance;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    public function create()
    {
        $roles = Role::all();
        return view('admin.create-user', compact('roles'));
    }

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
        Alert::success('Success', 'User created successfully.');
        Http::post($webhookUrl, [
            'content' => "",
            'embeds' => [
                [
                    'title' => "SHD Cloud Integrated Platform 線上整合平台",
                    'description' => "`✅` 用戶已經創建! 他的用戶名稱為 `{$user->name}` 並且他的電子郵件為 `{$user->email}`",
                    'color' => '323232',
                ]
            ],
        ]);
        return redirect()->route('admin.create-user')->with('success', 'User created successfully.');

    }
    

}
