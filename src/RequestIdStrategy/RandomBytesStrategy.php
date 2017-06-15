<?php declare(strict_types=1);

namespace ApiClients\Middleware\RequestId\RequestIdStrategy;

use ApiClients\Middleware\RequestId\Options;
use ApiClients\Middleware\RequestId\RequestIdStrategyInterface;
use Psr\Http\Message\RequestInterface;

final class RandomBytesStrategy implements RequestIdStrategyInterface
{
    /**
     * @param  RequestInterface $request
     * @param  array            $options
     * @return string
     */
    public function determineRequestId(RequestInterface $request, array $options): string
    {
        return bin2hex(random_bytes($options[Options::LENGTH] ?? 32));
    }
}
