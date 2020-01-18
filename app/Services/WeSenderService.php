<?php

namespace Buka\Services;

use WeSender\WeSenderSDK;

class WeSenderService {

    public static function send($destines, $message, $specialChar = false)
    {
        $wesender = new WeSenderSDK(config('app.wesender_api'));

        try {
            $wesender->sendMessage($destines, $message, $specialChar = true);
        } catch (\Throwable $th) {
            throw $th;
        }

        return $wesender;
    }
}
