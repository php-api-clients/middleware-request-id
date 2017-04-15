<?php declare(strict_types=1);

namespace ApiClients\Middleware\RequestId;

use ApiClients\Middleware\RequestId\RequestIdStrategy\Uuid4Strategy;

final class RequestIdStrategies
{
    const UUID4 = Uuid4Strategy::class;
}
