<?php

namespace App\Http\Controllers;

use App\Jobs\SendEmail;
use App\Jobs\SendSms;
use App\Mail\UserRegistered;
use App\Models\User;
use App\Services\Notification\Constants\SmsFarazTypes;

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
        $data = [
            'patern' => SmsFarazTypes::FACTOR,
            'variables' => ['PersonName', 'UnitName', 'OwnerTenant', 'AllDuesAmount', 'ComplexName'],
        ];
        SendSms::dispatchSync($user, $data);

        // $data = [
        //     'patern' => SmsFarazTypes::VERIFICATION_CODE,
        //     'variables' => ['123'],
        // ];
        // SendSms::dispatchSync($user, $data);
    }

}
