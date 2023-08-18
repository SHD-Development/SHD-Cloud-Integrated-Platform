<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Balance;
use App\Models\Team;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        
        




        // 取得已註冊人數
        View::composer('admin.index', function ($view) {
            $usersCount = User::count(); 
            $view->with('usersCount', $usersCount);
        });
        // Http::post('', [
        //     'content' => "",
        //     'embeds' => [
        //         [
        //             'title' => "SHD Cloud Integrated Platform 線上整合平台",
        //             'description' => "檢測到新的連線",
        //             'color' => '7506394',
        //         ]
        //     ],
        // ]);
        // $users = User::all();
        // foreach ($users as $user) {
        //     $user->ownedTeams()->save(Team::forceCreate([
        //         'user_id' => $user->id,
        //         'name' => explode(' ', $user->name, 2)[0]."'s Team",
        //         'personal_team' => true,
        //     ]));
        // }
        
    }
}
