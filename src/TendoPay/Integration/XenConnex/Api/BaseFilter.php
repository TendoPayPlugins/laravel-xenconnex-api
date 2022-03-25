<?php

namespace TendoPay\Integration\XenConnex\Api;

use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;

abstract class BaseFilter
{
    private array $filters = [];
    private array $requiredFieldsOptions = [];

    /**
     * @throws ValidationException
     */
    final public function toArray(): array
    {
        if ( ! empty($this->requiredFieldsOptions)) {
            $exampleOfRequiredField = '';
            foreach ($this->requiredFieldsOptions as $requiredFields) {
                $isValid = true;
                foreach ($requiredFields as $requiredField) {
                    if ( ! array_key_exists($requiredField, $this->filters)) {
                        $isValid                = false;
                        $exampleOfRequiredField = $requiredField;
                    }
                }
                if ($isValid) {
                    return $this->filters;
                }
            }
            throw new ValidationException(implode(' or ', array_map(function ($requiredFields) {
                    return json_encode($requiredFields);
                }, $this->requiredFieldsOptions)).' are required.');
        }

        return $this->filters;
    }

    protected function addFilter(string $name, $value): FieldValidator
    {
        $this->filters[$name] = $value;

        return new FieldValidator($name, $value);
    }

    protected function addRequiredFieldsOption(array $requiredFields)
    {
        $this->requiredFieldsOptions[] = $requiredFields;
    }
}