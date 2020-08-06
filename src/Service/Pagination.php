<?php

declare(strict_types=1);

namespace Jasmcoder\TicketingCommonBundle\Service;

use Symfony\Component\HttpFoundation\Request;

class Pagination
{
    public const DEFAULT_LIMIT = 50;
    public const DEFAULT_OFFSET = 0;

    public const LIMIT_NAME = 'limit';
    public const OFFSET_NAME = 'page';

    public int $page;
    public int $limit;

    public function __construct(int $page = self::DEFAULT_OFFSET, int $limit = self::DEFAULT_LIMIT)
    {
        $this->page = $page;
        $this->limit = $limit;
    }

    public static function fromRequest(Request $request): self
    {
        $limit = $request->get(self::LIMIT_NAME, self::DEFAULT_LIMIT);
        $page = $request->get(self::OFFSET_NAME, self::DEFAULT_OFFSET);

        return new self((int)$page, (int)$limit);
    }
}