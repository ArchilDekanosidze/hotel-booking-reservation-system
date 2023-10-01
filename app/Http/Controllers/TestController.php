<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Jobs\SendSms;
use App\Jobs\SendSmsToMultipleUser;
use App\Jobs\SendSmsWithNumber;
use App\Mail\UserRegistered;
use App\Models\User;
use App\Services\Notification\Providers\SmsProviders\Contracts\SmsTypes;

class TestController extends Controller
{
    public function testEmail()
    {
        $user = User::find(1);
        $mailable = new UserRegistered();
        SendEmail::dispatch($user, $mailable);
    }

    public function testSms()
    {
        // $main = '122';
        // $test = is_array($main) ? $main : array($main);
        // dd($test);
        // $user = User::find(1);
        // $multipleUser = User::all();
        // $data = [
        //     'type' => SmsTypes::FACTOR,
        //     'variables' => ['PersonName', 'UnitName', 'OwnerTenant', 'AllDuesAmount', 'ComplexName'],
        // ];

        $data = [
            'type' => SmsTypes::VERIFICATION_CODE,
            'variables' => ['verificationCode' => '222'],
        ];
        SendSmsWithNumber::dispatchSync(['09120919921', '09011401689'], $data);return;
        SendSmsToMultipleUser::dispatchSync($multipleUser, $data);return;
        SendSms::dispatchSync($user, $data);return;

    }

}
