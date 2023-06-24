<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DiscordNotification extends Controller
{
    public function embed1()
    {
        return Http::post('https://discord.com/api/webhooks/1112347230838468678/KUixGxZ3ScFIxVCqEHoi_r-TRsj37S-b7TXkfyAFpeTJrQGEpmu7eLHFp7z-NrEXp2cD', [
            'content' => "",
            'embeds' => [
                [
                    'title' => "SHD Cloud Integrated Platform 線上整合平台",
                    'description' => "✅ 伺服器已啟動",
                    'color' => '7506394',
                ]
            ],
        ]);

    }
}
