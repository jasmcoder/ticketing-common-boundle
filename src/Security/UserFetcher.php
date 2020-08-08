<?php

declare(strict_types=1);

namespace Jasmcoder\TicketingCommonBundle\Security;

use Symfony\Component\Security\Core\Security;

class UserFetcher implements UserFetcherInterface
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    public function getPresentUser(): UserInterface
    {
        $user = $this->security->getUser();

        if ($user === null) {
            throw new \InvalidArgumentException('Current user not found check security access list');
        }

        if (!($user instanceof UserInterface)) {
            throw new \InvalidArgumentException(sprintf('Invalid user type %s', \get_class($user)));
        }

        return $user;
    }

    public function getPresentUserOrNull(): ?UserInterface
    {
        $user = $this->security->getUser();

        if ($user === null) {
            return null;
        }

        if (!($user instanceof UserInterface)) {
            throw new \InvalidArgumentException(sprintf('Invalid user type %s', \get_class($user)));
        }

        return $user;
    }
}