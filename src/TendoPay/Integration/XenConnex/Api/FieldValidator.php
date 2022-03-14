<?php

namespace TendoPay\Integration\XenConnex\Api;


use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;

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
    function withNotEmptyValue(): FieldValidator
    {
        if (empty($this->value)) {
            throw new ValidationException($this->name.' is invalid. It should not be empty.');
        }

        return $this;
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

    /**
     * @throws ValidationException
     */
    function withAvailableOptions(string ...$options): FieldValidator
    {
        if (is_string($this->value) && ! in_array($this->value, $options)) {
            throw new ValidationException($this->name.'='.$this->value.' is invalid. Available options: ('.implode(',',
                    $options).')');
        } elseif (is_array($this->value)) {
            foreach ($this->value as $val) {
                if ( ! in_array($val, $options)) {
                    throw new ValidationException($this->name.'=['.$val.'] is invalid. Available options: ('.implode(',',
                            $options).')');
                }
            }
        }

        return $this;
    }
}