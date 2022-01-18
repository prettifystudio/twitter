<?php

declare(strict_types=1);

namespace PrettifyStudio\Twitter\Tests\Unit;

use PrettifyStudio\Twitter\Contract\Configuration;
use PrettifyStudio\Twitter\Contract\Querier;
use PrettifyStudio\Twitter\Tests\Integration\Laravel\TestCase;
use Exception;
use Prophecy\Argument;
use Prophecy\PhpUnit\ProphecyTrait;
use Prophecy\Prophecy\ObjectProphecy;

abstract class AccessorTestCase extends TestCase
{
    use ProphecyTrait;

    protected const USER_ID = '123456789';
    protected const ARBITRARY_PARAMS = ['foo' => 'bar', 'response_format' => 'json'];
    protected const ARBITRARY_RESPONSE = ['response'];

    /**
     * @var ObjectProphecy|Configuration
     */
    protected ObjectProphecy $config;

    /**
     * @var ObjectProphecy|Querier
     */
    protected ObjectProphecy $querier;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        $this->config = $this->prophesize(Configuration::class);
        $this->querier = $this->prophesize(Querier::class);

        $this->config->getApiVersion()
            ->willReturn('1.1');
        $this->config->isDebugMode()
            ->willReturn(true);

        $this->querier
            ->usingCredentials(Argument::cetera())
            ->willReturn($this->querier);
        $this->querier
            ->usingConfiguration(Argument::cetera())
            ->willReturn($this->querier);
        $this->querier
            ->withOAuth1Client(Argument::cetera())
            ->willReturn($this->querier);
        $this->querier
            ->withOAuth2Client(Argument::cetera())
            ->willReturn($this->querier);
        $this->querier
            ->getConfiguration()
            ->willReturn($this->config->reveal());
    }
}
