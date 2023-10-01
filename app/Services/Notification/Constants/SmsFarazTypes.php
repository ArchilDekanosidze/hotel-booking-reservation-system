<?php
namespace App\Services\Notification\Constants;

use App\Services\Notification\Providers\FarazSms\PaternFactor;
use App\Services\Notification\Providers\FarazSms\PaternPanelSharj;
use App\Services\Notification\Providers\FarazSms\PaternVerificationCode;

class SmsFarazTypes
{
    const PANEL_SHARJ = 1;
    const FACTOR = 2;
    const VERIFICATION_CODE = 3;
    public static function toPatern($type)
    {
        try {
            return [
                self::PANEL_SHARJ => '7duic3llh7sovjz',
                self::FACTOR => 'f6jhyw2aye64nwb',
                self::VERIFICATION_CODE => 'e9ssnpjkcqbtjlt',
            ][$type];
        } catch (\Throwable $th) {
            throw new \InvalidArgumentException('Patern Type  does not exist');
        }
    }
    public static function toClass(int $type)
    {
        try {
            return [
                self::PANEL_SHARJ => PaternPanelSharj::class,
                self::FACTOR => PaternFactor::class,
                self::VERIFICATION_CODE => PaternVerificationCode::class,
            ][$type];
        } catch (\Throwable $th) {
            throw new \InvalidArgumentException('class does not exist');
        }
    }
}
