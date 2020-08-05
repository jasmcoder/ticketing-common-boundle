<?php

declare(strict_types=1);

namespace Jasmcoder\TicketingCommonBundle\Domain\Model;

interface AggregateIdInterface
{
    public static function fromString(string $id): self;

    public function equals(AggregateIdInterface $other): bool;

    public function __toString();
}