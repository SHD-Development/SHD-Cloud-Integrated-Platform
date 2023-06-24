<?php

return [
    /*
     * The webhook URLs that we'll use to send a message to Discord.
     */
    'webhook_urls' => [
        'default' => 'https://discord.com/api/webhooks/1112347230838468678/KUixGxZ3ScFIxVCqEHoi_r-TRsj37S-b7TXkfyAFpeTJrQGEpmu7eLHFp7z-NrEXp2cD',
    ],

    /*
     * This job will send the message to Discord. You can extend this
     * job to set timeouts, retries, etc...
     */
    'job' => Spatie\DiscordAlerts\Jobs\SendToDiscordChannelJob::class,
];
