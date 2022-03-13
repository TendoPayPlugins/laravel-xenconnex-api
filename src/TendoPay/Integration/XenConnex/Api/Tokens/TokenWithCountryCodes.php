<?php

namespace TendoPay\Integration\XenConnex\Api\Tokens;

interface TokenWithCountryCodes
{
    public function withCountryCodes(array $countryCodes): Token;
}