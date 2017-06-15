<?php declare(strict_types=1);

namespace ApiClients\Tests\Foundation\Transport\RequestIdStrategy;

use ApiClients\Middleware\RequestId\Options;
use ApiClients\Middleware\RequestId\RequestIdStrategy\RandomBytesStrategy;
use ApiClients\Tools\TestUtilities\TestCase;
use Psr\Http\Message\RequestInterface;

final class RandomBytesStrategyTest extends TestCase
{
    public function testWorking()
    {
        $requestId = (new RandomBytesStrategy())->determineRequestId(
            $this->prophesize(RequestInterface::class)->reveal(),
            []
        );
        self::assertInternalType('string', $requestId);
        self::assertCount(64, str_split($requestId));
    }

    public function lengthProvider()
    {
        for ($i = 1; $i < 8192; $i *= 2) {
            yield [$i];
        }
    }

    /**
     * @dataProvider lengthProvider
     */
    public function testWorkingWithOption(int $length)
    {
        $requestId = (new RandomBytesStrategy())->determineRequestId(
            $this->prophesize(RequestInterface::class)->reveal(),
            [
                Options::LENGTH => $length,
            ]
        );
        self::assertInternalType('string', $requestId);
        self::assertCount($length * 2, str_split($requestId));
    }
}
