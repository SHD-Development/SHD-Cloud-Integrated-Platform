<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class BalanceApiController extends Controller
{
    public function updateBalance(Request $request)
    {
        $discordId = $request->input('discord_id');
        $coins = $request->input('coins');

        $user = User::where('discord_id', $discordId)->first();

        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $balance = $user->balance; 
        $balance->increment('amount', $coins);

        return response()->json([
            'message' => 'Balance updated successfully',
            'coins' => $user->balance->amount,
        ]);
    }
}
