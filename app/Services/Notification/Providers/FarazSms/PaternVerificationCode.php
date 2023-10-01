<?php
namespace App\Services\Notification\Providers\FarazSms;

class PaternVerificationCode
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function createInputData()
    {
        return $input_data = array("verification-code" => $this->data['variables'][0]);
    }
}
