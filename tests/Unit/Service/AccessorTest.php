<?php
/**
 * @noinspection PhpParamsInspection
 */

declare(strict_types=1);

namespace PrettifyStudio\Twitter\Tests\Unit\Service;

use PrettifyStudio\Twitter\Contract\Twitter;
use PrettifyStudio\Twitter\Service\Accessor;
use PrettifyStudio\Twitter\Tests\Unit\AccessorTestCase;
use Exception;
use Prophecy\PhpUnit\ProphecyTrait;

/**
 * @coversDefaultClass \PrettifyStudio\Twitter\Service\Accessor
 */
final class AccessorTest extends AccessorTestCase
{
    use ProphecyTrait;

    private Twitter $subject;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->subject = new Accessor($this->querier->reveal());
    }

    /**
     * @covers \PrettifyStudio\Twitter\Concern\HotSwapper::usingCredentials
     * @covers ::__construct
     * @covers ::getQuerier
     *
     * @throws Exception
     */
    public function testUsingCredentials(): void
    {
        $accessToken = 'token';
        $accessTokenSecret = 'secret';
        $consumerKey = 'consumer-key';
        $consumerSecret = 'consumer-secret';

        $this->config->getAccessToken()
            ->willReturn($accessToken);
        $this->config->getAccessTokenSecret()
            ->willReturn($accessTokenSecret);
        $this->config->getConsumerKey()
            ->willReturn($consumerKey);
        $this->config->getConsumerSecret()
            ->willReturn($consumerSecret);

        $result = $this->subject
            ->usingCredentials($accessToken, $accessTokenSecret, $consumerKey, $consumerSecret);
        $resultConfig = $result->getQuerier()
            ->getConfiguration();

        self::assertInstanceOf(Twitter::class, $result);
        self::assertSame($result, $this->subject);
        self::assertSame($accessToken, $resultConfig->getAccessToken());
        self::assertSame($accessTokenSecret, $resultConfig->getAccessTokenSecret());
        self::assertSame($consumerKey, $resultConfig->getConsumerKey());
        self::assertSame($consumerSecret, $resultConfig->getConsumerSecret());
    }

    /**
     * @covers \PrettifyStudio\Twitter\Concern\HotSwapper::usingConfiguration
     * @covers ::__construct
     * @covers ::getQuerier
     *
     * @throws Exception
     */
    public function testUsingConfiguration(): void
    {
        $accessToken = 'access-token';

        $this->config->getAccessToken()
            ->willReturn($accessToken);

        $result = $this->subject
            ->usingConfiguration($this->config->reveal());
        $resultConfig = $result->getQuerier()
            ->getConfiguration();

        self::assertInstanceOf(Twitter::class, $result);
        self::assertSame($result, $this->subject);
        self::assertSame($resultConfig->getAccessToken(), $accessToken);
    }
}
