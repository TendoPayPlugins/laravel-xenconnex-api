<?php

namespace TendoPay\Integration\XenConnex\Api\Token;

interface TokenWithInstitutionCodes
{
    public function withInstitutionCodes(array $institutionCodes): Token;
}