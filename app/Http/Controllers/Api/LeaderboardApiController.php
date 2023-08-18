<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Balance;
class LeaderboardApiController extends Controller
{
    public function getLeaderboard(Request $request)
    {
            $count = $request->input('count', 10);
            $users = User::join('balances', 'users.id', '=', 'balances.user_id')
                ->orderBy('balances.amount', 'desc')
                ->select('users.name', 'balances.amount as coins', 'users.discord_id')
                ->take($count)
                ->get();
            $total = Balance::sum('amount');
            $highest = Balance::max('amount');
            $lowest = Balance::min('amount');
            $difference = bcsub($highest, $lowest, 2);
            $rawaverage = Balance::avg('amount');
            $roundaverage = round($rawaverage, 2);
            $average = number_format($roundaverage, 2);
            $formattedData = [
                'top' => [],
                'total' => $total,
                'highest' => $highest,
                'lowest' => $lowest,
                'difference' => $difference,
                'average' => $average,
            ];
            foreach ($users as $user) {
                $formattedData['top'][] = [
                    'name' => $user->name,
                    'discord_id' => $user->discord_id,
                    'coins' => $user->coins,
                ];
            }
        
            return response()->json($formattedData);
    }
}
