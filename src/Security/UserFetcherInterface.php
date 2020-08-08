<?php

declare(strict_types=1);

namespace Jasmcoder\TicketingCommonBundle\Security;

interface UserFetcherInterface
{
    public function getPresentUser(): UserInterface;

    public function getPresentUserOrNull(): ?UserInterface;
}