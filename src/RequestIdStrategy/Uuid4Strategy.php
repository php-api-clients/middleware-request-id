<?php declare(strict_types=1);

namespace ApiClients\Middleware\RequestId\RequestIdStrategy;

use ApiClients\Middleware\RequestId\RequestIdStrategyInterface;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\Uuid;

final class Uuid4Strategy implements RequestIdStrategyInterface
{
    /**
     * @param  RequestInterface $request
     * @param  array            $options
     * @return string
     */
    public function determineRequestId(RequestInterface $request, array $options): string
    {
        return Uuid::uuid4()->toString();
    }
}
