<?php

declare(strict_types=1);

namespace PrettifyStudio\Twitter\Tests\Unit\ApiV1\Traits;

use PrettifyStudio\Twitter\Tests\Unit\AccessorTestCase;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;

abstract class ConcernTestCase extends AccessorTestCase
{
    protected MockObject $subject;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = $this->getMockForTrait($this->getTraitName());
    }

    abstract protected function getTraitName(): string;
}
