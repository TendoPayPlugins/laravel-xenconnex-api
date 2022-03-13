<?php

namespace TendoPay\Integration\XenConnex\Api\Token;

interface TokenWithCountryCodes
{
    public function withCountryCodes(array $countryCodes): Token;
}