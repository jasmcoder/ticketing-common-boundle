<?php

declare(strict_types=1);

namespace Jasmcoder\TicketingCommonBundle\Service\Validator;

interface ValidatorInterface
{
    public function validate(object $object): void;
}