<?php
namespace App\Services\Notification\Providers\SmsProviders\FarazSms\Pattern;

use App\Services\Notification\Providers\SmsProviders\FarazSms\Pattern\Contracts\PatternInterface;

class Patternf6jhyw2aye64nwb implements PatternInterface
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function createInputData()
    {
        return array("PersonName" => $this->data['variables'][0],
            "UnitName" => $this->data['variables'][1],
            "OwnerTenant" => $this->data['variables'][2],
            "AllDuesAmount" => $this->data['variables'][3],
            "ComplexName" => $this->data['variables'][4]);
    }
}
