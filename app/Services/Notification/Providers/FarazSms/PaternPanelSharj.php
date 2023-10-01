<?php
namespace App\Services\Notification\Providers\FarazSms;

class PaternPanelSharj
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function createInputData()
    {
        return array("verification-code" => $this->data['variables'][0]);
    }
}
