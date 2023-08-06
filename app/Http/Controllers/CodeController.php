<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;
use App\Models\Code;
use App\Models\Balance;
use Carbon\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class CodeController extends Controller
{
    public function create()
    {
        
        return view('admin.create-code');
    }
    public function redeemCode(Request $request)
{
    $code = $request->input('code');

    // 檢查代碼是否存在且可兌換
    $codeRecord = Code::where('code', $code)->first();
    if (!$codeRecord) {
        return redirect()->route('redeemdash')->with('error', '這個代碼不存在');
    }
    // 檢查用戶是否已兌換過該代碼
    if ($codeRecord->users()->where('user_id', auth()->id())->exists()) {
        return redirect()->route('redeemdash')->with('error', '您已經兌換過這個代碼了');

    }
    if ($codeRecord->redeemed_times >= $codeRecord->redeemable_times) {
        return redirect()->route('redeemdash')->with('error', '這個兌換代碼已經被兌換完了');
    }
    if ($codeRecord->expires_at < Carbon::now()) {
        return redirect()->route('redeemdash')->with('error', '這個代碼已經過期了');
    }

    

    // 更新代碼的已兌換次數和用戶兌換記錄
    $codeRecord->increment('redeemed_times');
    $codeRecord->users()->attach(auth()->id());

    // 獎勵代幣數量
    $rewardTokens = $codeRecord->reward_tokens;

    // 將獎勵代幣加到用戶的餘額中
    $user = auth()->user();
    $balance = Balance::where('user_id', $user->id)->first();
    $balance->increment('amount', $rewardTokens);

    return redirect()->route('redeemdash')->with('success', '已成功兌換代碼');
}









public function redeemCodeApi(Request $request)
{
    $code = $request->input('code');

    // 檢查代碼是否存在且可兌換
    $codeRecord = Code::where('code', $code)->first();
    if (!$codeRecord) {
        return response()->json(['message' => 'Invalid code'], 400);
    }
    if ($codeRecord->redeemed_times >= $codeRecord->redeemable_times) {
        return response()->json(['message' => 'Code already redeemed'], 400);
    }
    if ($codeRecord->expires_at < Carbon::now()) {
        return response()->json(['message' => 'Code has expired'], 400);
    }

    // 檢查用戶是否已兌換過該代碼
    if ($codeRecord->users()->where('user_id', auth()->id())->exists()) {
        return response()->json(['message' => 'Code already redeemed by this user'], 400);
    }

    // 更新代碼的已兌換次數和用戶兌換記錄
    $codeRecord->increment('redeemed_times');
    $codeRecord->users()->attach(auth()->id());

    // 獎勵代幣數量
    $rewardTokens = $codeRecord->reward_tokens;

    // 將獎勵代幣加到用戶的餘額中
    $user = auth()->user();
    $balance = Balance::where('user_id', $user->id)->first();
    $balance->increment('amount', $rewardTokens);

    return response()->json(['message' => 'Code redeemed successfully'], 200);
}
public function store(Request $request)
    {
        $webhookUrl = config('scip.webhook.url');
        $request->validate([
            'code' => 'required|unique:codes',
            'reward' => 'required|numeric',
            'expiration' => 'required|date',
            'limit' => 'required|integer',
        ]);

        $code = new Code();
        $code->code = $request->input('code');
        $code->reward_tokens = $request->input('reward');
        $code->expires_at = $request->input('expiration');
        $code->redeemable_times = $request->input('limit');
        $code->save();
        Http::post($webhookUrl, [
            'content' => "",
            'embeds' => [
                [
                    'title' => "SHD Cloud Integrated Platform 線上整合平台",
                    'description' => "`✅` 代碼已經創建! 其代碼為 `{$code->code}` 其獎勵為 `{$code->reward_tokens}` 其過期時間為 `{$code->expires_at} 並且其有效次數為 `{$code->redeemable_times}`",
                    'color' => '323232',
                ]
            ],
        ]);
        return redirect()->back()->with('success', '已新增代碼');
    }
}
