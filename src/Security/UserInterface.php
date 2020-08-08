<?php

declare(strict_types=1);

namespace Jasmcoder\TicketingCommonBundle\Security;

interface UserInterface
{
    public function getId(): string;

    public function getUsername():string;

    public function getRoles(): array;
}