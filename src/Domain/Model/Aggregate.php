<?php

declare(strict_types=1);

namespace Jasmcoder\TicketingCommonBundle\Domain\Model;


abstract class Aggregate
{
    /**
     * @var DomainEventInterface[]
     */
    private array $recordedEvents = [];

    abstract public function getId(): AggregateIdInterface;

    /**
     * @param DomainEventInterface $event
     */
    protected function recordEvent(DomainEventInterface $event): void
    {
        $this->recordedEvents[] = $event;
    }

    /**
     * @return DomainEventInterface[]
     */
    public function releaseEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];

        return $events;
    }

    public function clearRecordedEvents(): void
    {
        $this->recordedEvents = [];
    }
}