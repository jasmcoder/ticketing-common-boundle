<?php

declare(strict_types=1);

namespace xjasmx\TicketingCommonBundle\Service\Validator;

interface ValidatorInterface
{
    public function validate(object $object): void;
}