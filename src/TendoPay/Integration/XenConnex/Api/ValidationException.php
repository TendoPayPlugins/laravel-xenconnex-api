<?php

namespace TendoPay\Integration\XenConnex\Api;

class ValidationException extends XenConnexApiException
{
    public function __construct(string $message = '')
    {
        parent::__construct($message);
    }
}