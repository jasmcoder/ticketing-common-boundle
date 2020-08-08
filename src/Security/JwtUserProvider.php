<?php

declare(strict_types = 1);

namespace Jasmcoder\TicketingCommonBundle\Security;

use Lexik\Bundle\JWTAuthenticationBundle\Security\User\JWTUserInterface;

class JwtUserProvider implements JWTUserInterface, UserInterface
{
    private string $username;
    private array $roles;
    private string $id;

    public function __construct(string $username, string $id, array $roles = [])
    {
        $this->username = $username;
        $this->roles = $roles;
        $this->id = $id;
    }

    /**
     * {@inheritdoc}
     */
    public static function createFromPayload($username, array $payload)
    {
        if (isset($payload['roles'])) {
            return new static($username, $payload['id'],  (array)$payload['roles']);
        }

        return new static($username, $payload['id']);
    }

    public function getId(): string
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getUsername():string
    {
        return $this->username;
    }

    /**
     * {@inheritdoc}
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * {@inheritdoc}
     */
    public function getPassword()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getSalt()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function eraseCredentials(): void
    {
    }
}