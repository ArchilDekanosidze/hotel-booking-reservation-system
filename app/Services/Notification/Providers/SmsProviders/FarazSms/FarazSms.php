<?php
namespace App\Services\Notification\Providers\SmsProviders\FarazSms;

use App\Services\Notification\Providers\SmsProviders\FarazSms\Constants\SmsTypesFaraz;
use GuzzleHttp\Client;

class FarazSms
{
    private $mobiles;
    private $data;

    public function __construct($mobiles, array $data)
    {
        $this->mobiles = $mobiles;
        $this->data = $data;
    }

    public function send()
    {
        $client = new Client();
        $url = $this->prepareUrlForSms();
        $response = $client->post($url);
        return $response->getBody();
    }

    private function prepareUrlForSms()
    {
        $username = config('services.smsFaraz.auth.uname');
        $password = config('services.smsFaraz.auth.pass');
        $from = config('services.smsFaraz.auth.from');
        $smsType = $this->data['type'];
        $patternCode = SmsTypesFaraz::toPatternCode($smsType);
        $classPath = SmsTypesFaraz::toClass($smsType);
        $smsFarazClass = new $classPath($this->data['variables']);
        // dd($smsFarazClass);
        $input_data = $smsFarazClass->createInputData();
        $to = $this->mobiles;
        $baseUri = config('services.smsFaraz.baseUri');
        $url = $baseUri . $username . "&password=" . urlencode($password) . "&from=$from&to=" . json_encode($to) . "&input_data=" . urlencode(json_encode($input_data)) . "&pattern_code=$patternCode";
        return $url;
    }

}
