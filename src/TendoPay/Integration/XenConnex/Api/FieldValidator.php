<?php

namespace TendoPay\Integration\XenConnex\Api;


class FieldValidator
{
    private string $name;
    private $value;

    function __construct(string $name, $value)
    {
        $this->name  = $name;
        $this->value = $value;
    }

    /**
     * @throws ValidationException
     */
    function withMaxLength(int $maxLength): FieldValidator
    {
        if (is_string($this->value) && strlen($this->value) > $maxLength) {
            throw new ValidationException($this->name.'='.$this->value.' is invalid. Length should be <= '.$maxLength.' characters.');
        }

        return $this;
    }

    /**
     * @throws ValidationException
     */
    function withRegexCheck(string $regex): FieldValidator
    {
        if (is_string($this->value) && preg_match($regex, $this->value) !== 1) {
            throw new ValidationException($this->name.'='.$this->value.' is invalid. It should follow '.$regex.' pattern.');
        }

        return $this;
    }
}