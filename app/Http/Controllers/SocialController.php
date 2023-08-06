<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use Socialite;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SocialController extends Controller
{
    // 重新導向到驗證頁面
    public function redirectToProvider()
    {
        return Socialite::driver('discord')->redirect();
    }
    public function handleProviderCallback()
    {
        if (!Auth::check()) {
            return redirect()->route('link_account')->with('error', '您尚未登入');
        }
        $user = Auth::user();
        if ($user->discord_id !== null) {
            return redirect()->route('link_account')->with('error', '您已經綁定過 Discord 帳號了');
        }
        $userdc = Socialite::driver('discord')->user();
        $user->discord_id = $userdc->id;
        $user->discord_username = $userdc->name;
        $user->discord_avatar = $userdc->avatar;
        $user->save();
        return redirect()->route('link_account')->with('success', '綁定成功');
    }
    public function profileLink()
    {
    $userpl = Auth::user();
    return view('account.link')->with('user',$userpl);
    }
}
