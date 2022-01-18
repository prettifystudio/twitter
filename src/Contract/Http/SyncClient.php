<?php

declare(strict_types=1);

namespace PrettifyStudio\Twitter\Contract\Http;

use PrettifyStudio\Twitter\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

interface SyncClient extends Client
{
    /**
     * @return mixed
     *
     * @throws ClientException
     */
    public function request(string $method, string $url, array $data = []);

    /**
     * @return ResponseInterface|null
     */
    public function getLastResponse(): ?ResponseInterface;
}
