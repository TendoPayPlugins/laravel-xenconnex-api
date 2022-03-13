<?php

namespace TendoPay\Integration\XenConnex\Api\Customer\Account;

class AccountBankAccount extends Account
{
    private function __construct()
    {
    }

    public function withAccountNumber(string $accountNumber): AccountBankAccount
    {
        $this->filters['account_number'] = $accountNumber;

        return $this;
    }

    public function withAccountHolderName(string $accountHolderName): AccountBankAccount
    {
        $this->filters['account_holder_name'] = $accountHolderName;

        return $this;
    }

    public function withSwiftCode(string $swiftCode): AccountBankAccount
    {
        $this->filters['swift_code'] = $swiftCode;

        return $this;
    }

    public function withAccountType(string $accountType): AccountBankAccount
    {
        $this->filters['account_type'] = $accountType;

        return $this;
    }

    public function withAccountDetails(string $accountDetails): AccountBankAccount
    {
        $this->filters['account_details'] = $accountDetails;

        return $this;
    }

    public function withCurrency(string $currency): AccountBankAccount
    {
        $this->filters['currency'] = $currency;

        return $this;
    }
}