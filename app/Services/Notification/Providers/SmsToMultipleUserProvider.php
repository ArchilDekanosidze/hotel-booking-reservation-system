<?php
namespace App\Services\Notification\Providers;

use App\Services\Notification\Exceptions\SomeUsersDoNotHaveNumber;
use App\Services\Notification\Providers\Contracts\Provider;
use App\Services\Notification\Providers\SmsProviders\Contracts\SmsSender;

class SmsToMultipleUserProvider implements Provider
{
    private $multipleUser;
    private $data;
    private $phone_number_column_name = 'phone';

    public function __construct($multipleUser, array $data)
    {
        $this->multipleUser = $multipleUser;
        $this->data = $data;
    }

    public function send()
    {
        // $this->havePhoneNumber();
        foreach ($this->multipleUser as $user) {
            $mobile = $user->{$this->phone_number_column_name};
            $smsProvider = new SmsSender($mobile, $this->data);
            $smsProvider->send();
        }

    }

    private function havePhoneNumber()
    {
        foreach ($this->multipleUser as $user) {
            if (is_null($user->{$this->phone_number_column_name})) {
                throw new SomeUsersDoNotHaveNumber();
            }
        }
    }

}
