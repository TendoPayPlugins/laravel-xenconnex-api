<?php

namespace TendoPay\Integration\XenConnex\Api\Transactions;

class GetTransactionsParams
{
    private ?int $count = null;
    private ?int $offset = null;
    private ?string $startDate = null;
    private ?string $endDate = null;

    public function setCount(?int $count): void
    {
        $this->count = $count;
    }

    public function setOffset(?int $offset): void
    {
        $this->offset = $offset;
    }

    public function setStartDate(?string $startDate): void
    {
        $this->startDate = $startDate;
    }

    public function setEndDate(?string $endDate): void
    {
        $this->endDate = $endDate;
    }

    public function getParams(): array
    {
        $params = [];
        if (isset($this->count)) {
            $params['count'] = $this->count;
        }
        if (isset($this->offset)) {
            $params['offset'] = $this->offset;
        }
        if (isset($this->startDate)) {
            $params['startDate'] = $this->startDate;
        }
        if (isset($this->endDate)) {
            $params['endDate'] = $this->endDate;
        }

        return $params;
    }

}