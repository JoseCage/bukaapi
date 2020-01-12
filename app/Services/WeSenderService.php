<?php

namespace App\Services;

use WeSender\WeSenderSDK;

class WeSenderService {

    public function send($destines, $message, $specialChar)
    {
        $wesender = new WeSenderSDK(config('app.wesender_api'));

        try {
            $wesender->sendMessage($destines, $message);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
