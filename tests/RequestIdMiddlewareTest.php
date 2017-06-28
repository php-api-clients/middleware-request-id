<?php declare(strict_types=1);

namespace ApiClients\Tests\Middleware\RequestId;

use ApiClients\Middleware\RequestId\Options;
use ApiClients\Middleware\RequestId\RequestIdMiddleware;
use ApiClients\Middleware\RequestId\RequestIdStrategy\Uuid4Strategy;
use ApiClients\Tools\TestUtilities\TestCase;
use Ramsey\Uuid\Uuid;
use React\EventLoop\Factory;
use RingCentral\Psr7\Request;
use function Clue\React\Block\await;

final class RequestIdMiddlewareTest extends TestCase
{
    public function testPre()
    {
        $request = await(
            (new RequestIdMiddleware())->pre(
                new Request('GET', 'https://example.com/'),
                'abc',
                [
                    RequestIdMiddleware::class => [
                        Options::STRATEGY => Uuid4Strategy::class,
                    ],
                ]
            ),
            Factory::create()
        );
        self::assertTrue(Uuid::isValid($request->getHeaderLine('X-Request-ID')));
    }
}
