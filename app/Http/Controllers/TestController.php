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
        $user = User::find(1);
        $multipleUser = User::all();

        // $data = [
        //     'type' => SmsTypes::VERIFICATION_CODE_NAME,
        //     'variables' => ['name' => 'hamed', 'verificationCode' => '333'],
        // ];

        $data = [
            'type' => SmsTypes::VERIFICATION_CODE,
            'variables' => ['verificationCode' => '7'],
        ];

        $result = SendSmsWithNumber::dispatchSync(['09120919921'], $data);return;
        $result = SendSmsToMultipleUser::dispatchSync($multipleUser, $data);return;
        $result = SendSms::dispatchSync($user, $data);return;
        $result = SendSmsWithNumber::dispatchSync(['09120919921', '09011401689'], $data);return;

    }

}
