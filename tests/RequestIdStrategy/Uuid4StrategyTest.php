<?php declare(strict_types=1);

namespace ApiClients\Tests\Foundation\Transport\RequestIdStrategy;

use ApiClients\Middleware\RequestId\RequestIdStrategy\Uuid4Strategy;
use ApiClients\Tools\TestUtilities\TestCase;
use Psr\Http\Message\RequestInterface;
use Ramsey\Uuid\Uuid;

final class Uuid4StrategyTest extends TestCase
{
    public function testWorking()
    {
        self::assertTrue(Uuid::isValid(
            (new Uuid4Strategy())->determineRequestId(
                $this->prophesize(RequestInterface::class)->reveal(),
                []
            )
        ));
    }
}
