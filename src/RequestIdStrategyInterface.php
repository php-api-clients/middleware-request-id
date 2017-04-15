<?php declare(strict_types=1);

namespace ApiClients\Middleware\RequestId;

use Psr\Http\Message\RequestInterface;

interface RequestIdStrategyInterface
{
    public function determineRequestId(RequestInterface $request, array $options): string;
}
