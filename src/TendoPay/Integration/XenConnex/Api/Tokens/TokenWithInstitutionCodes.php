<?php

namespace TendoPay\Integration\XenConnex\Api\Tokens;

interface TokenWithInstitutionCodes
{
    public function withInstitutionCodes(array $institutionCodes): Token;
}