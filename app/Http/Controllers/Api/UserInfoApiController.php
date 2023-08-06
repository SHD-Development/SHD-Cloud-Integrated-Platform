<?php

namespace App\Http\Controllers\Api;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Http;

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
        $webhookUrl = config('scip.webhook.url');
        $usersCount = User::count();
        Http::post($webhookUrl, [
            'content' => "",
            'embeds' => [
                [
                    'title' => "SHD Cloud Integrated Platform 線上整合平台",
                    'description' => "`✅` API請求成功! 類型為GET 請求的資訊為總用戶數目 控制器回傳的資料JSON為 `'amount' => {$usersCount}`",
                    'color' => '323232',
                ]
            ],
        ]);
        return response()->json(['amount' => $usersCount ], 200);
        
    }
    public function getAdminUserCount(Request $request)
    {
        $webhookUrl = config('scip.webhook.url');
        $adminRole = Role::where('name', 'admin')->first();
        if ($adminRole) {
            $adminUsersCount = $adminRole->users()->count();
            Http::post($webhookUrl, [
                'content' => "",
                'embeds' => [
                    [
                        'title' => "SHD Cloud Integrated Platform 線上整合平台",
                        'description' => "`✅` API請求成功! 類型為GET 請求的資訊為管理員用戶數目 控制器回傳的資料JSON為 `'amount' => {$adminUsersCount}`",
                        'color' => '323232',
                    ]
                ],
            ]);
            return response()->json(['amount' => $adminUsersCount ], 200);
        } else {
            Http::post($webhookUrl, [
                'content' => "",
                'embeds' => [
                    [
                        'title' => "SHD Cloud Integrated Platform 線上整合平台",
                        'description' => "`❌` 出錯了! 伺服器回報了一個錯誤!",
                        'color' => '323232',
                    ]
                ],
            ]);
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
    public function checkBalance(Request $request)
    {
        $discordId = $request->input('discord_id');
        if (!$discordId) {
            return response()->json(['message' => '請提供 Discord 用戶 ID'], 400);
        }
        $user = User::where('discord_id', $discordId)->first();
        if (!$user) {
            return response()->json(['message' => '找不到對應的用戶'], 404);
        }
        return response()->json(['coins' => $user->balance->amount]);
    }
}
