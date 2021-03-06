<?php

declare(strict_types=1);

namespace PrettifyStudio\Twitter\Tests\Integration;

use Exception;

interface ResolutionTest
{
    /**
     * @throws Exception
     */
    public function testTwitterResolution(): void;

    /**
     * @throws Exception
     */
    public function testTwitterResolutionViaAlias(): void;
}
