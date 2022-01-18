<?php

declare(strict_types=1);

namespace PrettifyStudio\Twitter\ApiV1\Service;

use PrettifyStudio\Twitter\ApiV1\Contract\Twitter as TwitterContract;
use PrettifyStudio\Twitter\ApiV1\Traits\AccountActivityTrait;
use PrettifyStudio\Twitter\ApiV1\Traits\AccountTrait;
use PrettifyStudio\Twitter\ApiV1\Traits\AuthTrait;
use PrettifyStudio\Twitter\ApiV1\Traits\BlockTrait;
use PrettifyStudio\Twitter\ApiV1\Traits\DirectMessageTrait;
use PrettifyStudio\Twitter\ApiV1\Traits\FavoriteTrait;
use PrettifyStudio\Twitter\ApiV1\Traits\FormattingHelpers;
use PrettifyStudio\Twitter\ApiV1\Traits\FriendshipTrait;
use PrettifyStudio\Twitter\ApiV1\Traits\GeoTrait;
use PrettifyStudio\Twitter\ApiV1\Traits\HelpTrait;
use PrettifyStudio\Twitter\ApiV1\Traits\ListTrait;
use PrettifyStudio\Twitter\ApiV1\Traits\MediaTrait;
use PrettifyStudio\Twitter\ApiV1\Traits\SearchTrait;
use PrettifyStudio\Twitter\ApiV1\Traits\StatusTrait;
use PrettifyStudio\Twitter\ApiV1\Traits\TrendTrait;
use PrettifyStudio\Twitter\ApiV1\Traits\UserTrait;
use PrettifyStudio\Twitter\Concern\HotSwapper;
use PrettifyStudio\Twitter\Contract\Configuration;
use PrettifyStudio\Twitter\Contract\Querier;
use PrettifyStudio\Twitter\Exception\ClientException as TwitterClientException;

class Twitter implements TwitterContract
{
    use FormattingHelpers;
    use AccountTrait;
    use AccountActivityTrait;
    use BlockTrait;
    use DirectMessageTrait;
    use FavoriteTrait;
    use FriendshipTrait;
    use GeoTrait;
    use HelpTrait;
    use ListTrait;
    use MediaTrait;
    use SearchTrait;
    use StatusTrait;
    use TrendTrait;
    use UserTrait;
    use AuthTrait;
    use HotSwapper;

    private const DEFAULT_EXTENSION = 'json';
    private const URL_FORMAT = 'https://%s/%s/%s.%s';

    protected Configuration $config;
    protected Querier $querier;
    protected bool $debug;

    public function __construct(Querier $querier)
    {
        $this->setQuerier($querier);
    }

    public function getQuerier(): Querier
    {
        return $this->querier;
    }

    /**
     * @return mixed
     *
     * @throws TwitterClientException
     */
    public function query(
        string $endpoint,
        string $requestMethod = self::REQUEST_METHOD_GET,
        array $parameters = [],
        bool $multipart = false,
        string $extension = self::DEFAULT_EXTENSION
    ) {
        return $this->querier->query($endpoint, $requestMethod, $parameters, $multipart, $extension);
    }

    /**
     * @return mixed
     *
     * @throws TwitterClientException
     */
    public function directQuery(
        string $url,
        string $requestMethod = self::REQUEST_METHOD_GET,
        array $parameters = []
    ) {
        return $this->querier->directQuery($url, $requestMethod, $parameters);
    }

    /**
     * @param  array  $parameters
     * @param  bool  $multipart
     * @param  string  $extension
     * @return mixed|string
     *
     * @throws TwitterClientException
     */
    public function get(string $endpoint, $parameters = [], $multipart = false, $extension = self::DEFAULT_EXTENSION)
    {
        return $this->query($endpoint, self::REQUEST_METHOD_GET, $parameters, $multipart, $extension);
    }

    /**
     * @return mixed
     *
     * @throws TwitterClientException
     */
    public function post(string $endpoint, array $parameters = [], bool $multipart = false)
    {
        return $this->query($endpoint, self::REQUEST_METHOD_POST, $parameters, $multipart);
    }

    /**
     * @return mixed
     *
     * @throws TwitterClientException
     */
    public function delete(string $endpoint, array $parameters = [])
    {
        return $this->query($endpoint, self::REQUEST_METHOD_DELETE, $parameters);
    }

    private function setQuerier(Querier $querier): self
    {
        $config = $querier->getConfiguration();
        $this->config = $config;
        $this->querier = $querier;
        $this->debug = $config->isDebugMode();

        return $this;
    }
}
