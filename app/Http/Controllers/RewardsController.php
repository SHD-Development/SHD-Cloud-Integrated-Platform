<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use App\Models\Balance;
use Carbon\Carbon;
class RewardsController extends Controller
{
    public function getDailyReward()
    {
        $user = auth()->user();

        // 檢查用戶是否已經領取過今日獎勵
        $today = Carbon::today();
        $claimedReward = Reward::where('user_id', $user->id)
            ->whereDate('claimed_at', $today)
            ->first();

        if ($claimedReward) {
            return view('daily-rewards', ['claimed' => true]);
        } else {
            return view('daily-rewards', ['claimed' => false]);
        }
    }

    public function claimDailyReward()
    {
        $user = auth()->user();
        $today = Carbon::today();

        $claimedReward = Reward::where('user_id', $user->id)
            ->whereDate('claimed_at', $today)
            ->first();

        if ($claimedReward) {
            return redirect()->route('daily-reward')->with('error', '您今天已經領取過免費 IPC 了');
        }

        Reward::create([
            'user_id' => $user->id,
            'claimed_at' => $today,
        ]);
        $rewardCoins = mt_rand(1, 10) / 100;
        $balance = Balance::where('user_id', $user->id)->first();
        $balance->increment('amount', $rewardCoins);

        return redirect()->route('daily-reward')->with('success', '領取成功');
    }
}
