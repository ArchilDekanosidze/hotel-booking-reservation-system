<?php
namespace App\Services\Notification\Providers\SmsProviders\MeliPayamak\Constants;

use App\Services\Notification\Providers\SmsProviders\Contracts\SmsTypes;

class SmsTypesMeliPayamak implements SmsTypes
{
    public static function toPatternCode($type)
    {
        try {
            return [
                self::PANEL_SHARJ => '164904',
                self::FACTOR => '164968',
                self::VERIFICATION_CODE => '164887',
            ][$type];
        } catch (\Throwable $th) {
            throw new \InvalidArgumentException('Patern Type  does not exist');
        }
    }
}
