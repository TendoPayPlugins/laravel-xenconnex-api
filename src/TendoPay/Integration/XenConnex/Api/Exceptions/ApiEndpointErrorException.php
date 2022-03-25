<?php

namespace TendoPay\Integration\XenConnex\Api\Exceptions;

class ApiEndpointErrorException extends XenConnexApiException
{
    private string $xenConnexErrorCode;
    private array $errors;

    public function __construct(string $message = '', string $xenConnexErrorCode = '', array $errors = [])
    {
        parent::__construct('['.$xenConnexErrorCode.'] '.$message.' '.json_encode($errors));
        $this->xenConnexErrorCode = $xenConnexErrorCode;
        $this->errors             = $errors;
    }

    public function getXenConnexErrorCode(): string
    {
        return $this->xenConnexErrorCode;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}