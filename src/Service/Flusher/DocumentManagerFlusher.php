<?php

declare(strict_types=1);

namespace Jasmcoder\TicketingCommonBundle\Service\Flusher;

use Doctrine\ODM\MongoDB\DocumentManager;

class DocumentManagerFlusher implements FlusherInterface
{
    private DocumentManager $manager;

    public function __construct(DocumentManager $manager)
    {
        $this->manager = $manager;
    }

    public function flush(array $options = []): void
    {
        $this->manager->flush($options);
    }
}