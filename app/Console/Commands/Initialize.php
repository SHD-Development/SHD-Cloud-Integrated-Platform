<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Balance;
use App\Models\Team;
class initialize extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scip:initialize';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialize integrated platform system settings.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 系統管理員創建
        $rootUser = User::firstOrNew(['email' => 'root@example.com']);
        if (!$rootUser->exists) {
        $rootUser->name = 'root';
        $rootUser->password = Hash::make('12345678');
        
        $rootUser->save();
        $balance = Balance::create([
            'user_id' => $rootUser->id,
            'amount' => 0,
        ]);
        

        
        }
        // 身分組創建
        if (!Role::where('name', 'admin')->exists()) {
            Role::create(['name' => 'admin']);
        }
        if (!Role::where('name', 'user')->exists()) {
            Role::create(['name' => 'user']);
        }
        
        // 權限創建
        if (!Permission::where('name', 'access adminui')->where('guard_name', 'web')->exists()) {
            Permission::create(['name' => 'access adminui']);
        }
        if (!Permission::where('name', 'access adminui index')->where('guard_name', 'web')->exists()) {
            Permission::create(['name' => 'access adminui index']);
        }
        if (!Permission::where('name', 'access adminui user')->where('guard_name', 'web')->exists()) {
            Permission::create(['name' => 'access adminui user']);
        }
        if (!Permission::where('name', 'access adminui announcement')->where('guard_name', 'web')->exists()) {
            Permission::create(['name' => 'access adminui announcement']);
        }
        if (!Permission::where('name', 'access adminui store')->where('guard_name', 'web')->exists()) {
            Permission::create(['name' => 'access adminui store']);
        }

        // 身分組變數定義
        $adminRole = Role::findByName('admin');
        // 為admin身分組賦予所有權限
        $permissions = Permission::all();
        foreach ($permissions as $permission) {
        $adminRole->givePermissionTo($permission);
        }
        // 權限給予
        $adminRole->givePermissionTo('access adminui');
        $adminRole->givePermissionTo('access adminui index');
        $adminRole->givePermissionTo('access adminui user');
        $adminRole->givePermissionTo('access adminui announcement');
        $adminRole->givePermissionTo('access adminui store');
        // 為root使用者賦予admin身分組
        $adminRole = Role::findOrCreate('admin');
        $rootUser->assignRole($adminRole);
    }
}
