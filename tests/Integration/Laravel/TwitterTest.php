<?php

declare(strict_types=1);

namespace PrettifyStudio\Twitter\Tests\Integration\Laravel;

use PrettifyStudio\Twitter\Contract\ServiceProvider;
use PrettifyStudio\Twitter\Tests\Integration\ResolutionTest;
use PrettifyStudio\Twitter\Twitter;
use Exception;

/**
 * @internal
 * @coversNothing
 */
final class TwitterTest extends TestCase implements ResolutionTest
{
    /**
     * @throws Exception
     */
    public function testTwitterResolution(): void
    {
        self::assertInstanceOf(Twitter::class, app(Twitter::class));
    }

    /**
     * @throws Exception
     */
    public function testTwitterResolutionViaAlias(): void
    {
        self::assertInstanceOf(Twitter::class, app(ServiceProvider::PACKAGE_ALIAS));
    }
}
