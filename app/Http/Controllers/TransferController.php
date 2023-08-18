<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class TransferController extends Controller
{
    public function showTransferPage()
    {
        $sender = auth()->user();
        if (!$sender) {
            return redirect()->route('login')->with('info', '請先登入帳號');
        }
        $users = User::all();
        return view('transfer', ['users' => $users]);
    }
    public function processTransfer(Request $request)
    {
        $sender = auth()->user();
        if (!$sender) {
            return redirect()->route('login')->with('info', '請先登入帳號');
        }
        $recipientId = $request->input('recipient');
        $amount = $request->input('amount');
        if ($sender->id == $recipientId) {
            return redirect()->back()->with('error', '不能轉帳給自己');
        }
        if ($amount > 10.00) {
            return redirect()->back()->with('error', '每次轉帳金額不能大於 10');
        }
        if ($amount < 0.01) {
            return redirect()->back()->with('error', '轉帳金額過小');
        }
        if ($sender->balance->amount < $amount) {
            return redirect()->back()->with('error', '餘額不足');
        }
        $balance = $sender->balance;
        $balance->decrement('amount', $amount);
        $sender->save();

        $recipient = User::findOrFail($recipientId);
        $recipient->balance->increment('amount', $amount);
        $recipient->save();

        return redirect()->route('show-transfer')->with('success', '轉帳成功');
    }
}
