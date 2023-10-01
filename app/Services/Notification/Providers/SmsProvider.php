<?php
namespace App\Services\Notification\Providers;

use App\Models\User;
use App\Services\Notification\Constants\SmsFarazTypes;
use App\Services\Notification\Exceptions\UserDoesNotHaveNumber;
use App\Services\Notification\Providers\Contracts\Provider;
use GuzzleHttp\Client;

class SmsProvider implements Provider
{
    private $user;
    private $data;
    private $phone_number = 'phone';

    public function __construct(User $user, array $data)
    {
        $this->user = $user;
        $this->data = $data;
    }

    public function send()
    {
        $this->havePhoneNumber();
        $mobile = $this->user->{$this->phone_number};
        $client = new Client();
        $url = $this->prepareUrlForSms($mobile);
        $response = $client->post($url);
        return $response->getBody();
    }

    private function prepareUrlForSms(String $mobile)
    {
        $username = config('services.smsFaraz.auth.uname');
        $password = config('services.smsFaraz.auth.pass');
        $from = config('services.smsFaraz.auth.from');
        $pattern_code = $this->data['patern'];
        $patternRealCode = SmsFarazTypes::toPatern($pattern_code);
        $classType = SmsFarazTypes::toClass($pattern_code);
        $inputDataClass = new $classType($this->data);
        $input_data = $inputDataClass->createInputData();
        $to = array($mobile);
        $baseUri = config('services.smsFaraz.baseUri');
        $url = $baseUri . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$patternRealCode";
        // dd($url);

        return $url;
    }

    private function havePhoneNumber()
    {
        if (is_null($this->user->{$this->phone_number})) {
            throw new UserDoesNotHaveNumber();
        }
    }

}
