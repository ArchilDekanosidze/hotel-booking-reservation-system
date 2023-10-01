<?php
namespace App\Services\Notification\Providers\SmsProviders\FarazSms\Constants;

use App\Services\Notification\Providers\SmsProviders\Contracts\SmsTypes;
use App\Services\Notification\Providers\SmsProviders\FarazSms\Pattern\PatternFactor;
use App\Services\Notification\Providers\SmsProviders\FarazSms\Pattern\PatternPanelSharj;
use App\Services\Notification\Providers\SmsProviders\FarazSms\Pattern\PatternVerificationCode;

class SmsTypesFaraz implements SmsTypes
{
    public static function toPatternCode($type)
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
    public static function toClass($type)
    {
        try {
            return [
                self::PANEL_SHARJ => PatternPanelSharj::class,
                self::FACTOR => PatternFactor::class,
                self::VERIFICATION_CODE => PatternVerificationCode::class,
            ][$type];
        } catch (\Throwable $th) {
            throw new \InvalidArgumentException('class does not exist');
        }
    }
}
