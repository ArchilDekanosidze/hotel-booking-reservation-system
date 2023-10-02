<?php
namespace App\Services\Notification\Providers\SmsProviders\FarazSms\Constants;

use App\Services\Notification\Providers\SmsProviders\Contracts\SmsTypes;

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
        $fileName = 'Pattern' . self::toPatternCode(self::PANEL_SHARJ);
        $paternPath = __NAMESPACE__;
        $pos = strrpos($paternPath, '\\');
        if (!$pos) {
            $pos = strrpos($paternPath, '/');
        }
        $paternPath = substr($paternPath, 0, $pos + 1);
        $paternPath = $paternPath . 'Pattern\\' . $fileName;
        if (!class_exists($paternPath)) {
            throw new \InvalidArgumentException('class does not exist');
        }
        return $paternPath;
        // try {
        //     return [
        //         self::PANEL_SHARJ => Pattern7duic3llh7sovjz::class,
        //         self::FACTOR => Patternf6jhyw2aye64nwb::class,
        //         self::VERIFICATION_CODE => Patterne9ssnpjkcqbtjlt::class,
        //     ][$type];
        // } catch (\Throwable $th) {
        //     throw new \InvalidArgumentException('class does not exist');
        // }
    }
}
