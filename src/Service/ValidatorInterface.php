<?php

declare(strict_types=1);

namespace xjasmx\TicketingCommonBundle\Service;

interface ValidatorInterface
{
    public function validate(object $object): void;
}