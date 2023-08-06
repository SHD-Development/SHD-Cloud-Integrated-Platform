<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    use HasFactory;
    protected $table = 'codes';

    protected $fillable = [
        'code',
        'expires_at',
        'redeemable_times',
        'reward_tokens',
    ];

    protected $dates = ['expires_at'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_codes', 'code_id', 'user_id');
    }
    public function redeem(User $user)
    {
        // 檢查代碼是否有效
        if (!$this->isValid()) {
            return false;
        }

        // 檢查用戶是否已經兌換過該代碼
        if ($user->hasRedeemedCode($this)) {
            return false;
        }

        // 更新用戶的獎勵代幣餘額
        $user->balance()->increment('amount', $this->reward_tokens);

        // 記錄兌換紀錄
        $this->redeems()->create([
            'user_id' => $user->id,
            'redeemed_at' => now(),
        ]);

        return true;
    }

    public function isValid()
    {
        return $this->expires_at > now() && $this->redeemable_times > 0;
    }

    public function redeems()
    {
        return $this->hasMany(Redeem::class);
    }
}
