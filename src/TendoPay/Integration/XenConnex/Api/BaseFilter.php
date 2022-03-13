<?php

namespace TendoPay\Integration\XenConnex\Api;

abstract class BaseFilter
{
    private array $filters = [];

    final public function toArray(): array
    {
        return $this->filters;
    }

    protected function addFilter(string $name, $value): FieldValidator
    {
        $this->filters[$name] = $value;

        return new FieldValidator($name, $value);
    }
}