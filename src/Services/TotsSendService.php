<?php

namespace Tots\EmailTSend\Services;

use Tots\Email\Services\TotsEmailService;
use TotsSend\TotsSend;

class TotsSendService implements TotsEmailService
{
    public $config = [];

    public function __construct($config)
    {
        $this->config = $config;
    }

    public function send($email, $template, $params = [])
    {
        $service = new TotsSend($this->config['key']);
        return $service->send($email, $template, $params);
    }
}
