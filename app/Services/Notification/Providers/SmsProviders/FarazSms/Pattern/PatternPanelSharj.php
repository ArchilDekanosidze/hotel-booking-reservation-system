<?php
namespace App\Services\Notification\Providers\SmsProviders\FarazSms\Pattern;

use App\Services\Notification\Providers\SmsProviders\FarazSms\Pattern\Contracts\PatternInterface;

class PatternPanelSharj implements PatternInterface
{
    private $variables;

    public function __construct($variables)
    {
        $this->variables = $variables;
    }

    public function createInputData()
    {
        return array("verification-code" => $this->variables[0]);
    }
}
