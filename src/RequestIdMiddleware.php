<?php declare(strict_types=1);

namespace ApiClients\Middleware\RequestId;

use ApiClients\Foundation\Middleware\ErrorTrait;
use ApiClients\Foundation\Middleware\MiddlewareInterface;
use ApiClients\Foundation\Middleware\PostTrait;
use Psr\Http\Message\RequestInterface;
use React\Promise\CancellablePromiseInterface;
use function React\Promise\resolve;

final class RequestIdMiddleware implements MiddlewareInterface
{
    use PostTrait;
    use ErrorTrait;

    /**
     * @param  RequestInterface            $request
     * @param  string                      $transactionId
     * @param  array                       $options
     * @return CancellablePromiseInterface
     */
    public function pre(
        RequestInterface $request,
        string $transactionId,
        array $options = []
    ): CancellablePromiseInterface {
        if (!isset($options[RequestIdMiddleware::class][Options::STRATEGY])) {
            return resolve($request);
        }

        $strategy = $options[RequestIdMiddleware::class][Options::STRATEGY];

        if (!class_exists($strategy)) {
            return resolve($request);
        }

        if (!is_subclass_of($strategy, RequestIdStrategyInterface::class)) {
            return resolve($request);
        }

        /** @var RequestIdStrategyInterface $strategy */
        $strategy = new $strategy();

        return resolve(
            $request->withAddedHeader(
                'X-Request-ID',
                $strategy->determineRequestId($request, $options[RequestIdMiddleware::class])
            )
        );
    }
}
