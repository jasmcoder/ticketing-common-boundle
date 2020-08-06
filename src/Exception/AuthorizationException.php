<?php

declare(strict_types=1);

namespace Jasmcoder\TicketingCommonBundle\Exception;

class AuthorizationException extends \Exception
{
    public function __construct(string $message, int $code = 0)
    {
        parent::__construct($message, $code);
    }
}