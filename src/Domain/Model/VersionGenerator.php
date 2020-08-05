<?php

declare(strict_types=1);

namespace Jasmcoder\TicketingCommonBundle\Domain\Model;

trait VersionGenerator
{
    /**
     * @MongoDB\Field(type="int")
     */
    private int $version = 0;

    /**
     * @MongoDB\PrePersist
     * @MongoDB\PreUpdate
     */
    public function incrementVersion(): void
    {
        ++$this->version;
    }
}