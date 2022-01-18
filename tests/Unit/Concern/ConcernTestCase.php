<?php

declare(strict_types=1);

namespace PrettifyStudio\Twitter\Tests\Unit\Concern;

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

        $this->subject->method('getQuerier')
            ->willReturn($this->querier->reveal());
    }

    abstract protected function getTraitName(): string;
}
