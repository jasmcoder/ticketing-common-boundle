<?php

declare(strict_types=1);

namespace Jasmcoder\TicketingCommonBundle\Service\Flusher;

interface FlusherInterface
{
    public function flush(): void;
}