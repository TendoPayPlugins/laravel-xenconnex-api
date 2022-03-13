<?php

namespace TendoPay\Integration\XenConnex\Api\Token;

use TendoPay\Integration\XenConnex\Api\BaseFilter;
use TendoPay\Integration\XenConnex\Api\Exceptions\ValidationException;

class LinkProperties extends BaseFilter
{
    /**
     * @throws ValidationException
     */
    public static function builder(
        string $successRedirectUrl,
        string $failureRedirectUrl,
        string $cancelRedirectUrl
    ): LinkProperties {
        return new LinkProperties(
            $successRedirectUrl,
            $failureRedirectUrl,
            $cancelRedirectUrl);
    }

    /**
     * @throws ValidationException
     */
    private function __construct(
        string $successRedirectUrl,
        string $failureRedirectUrl,
        string $cancelRedirectUrl
    ) {
        $this->addFilter('success_redirect_url', $successRedirectUrl)
             ->withRegexCheck('/^https:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)$/');
        $this->addFilter('failure_redirect_url', $failureRedirectUrl)
             ->withRegexCheck('/^https:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)$/');
        $this->addFilter('cancel_redirect_url', $cancelRedirectUrl)
             ->withRegexCheck('/^https:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{1,256}\.[a-zA-Z0-9()]{1,6}\b([-a-zA-Z0-9()@:%_\+.~#?&//=]*)$/');
    }
}