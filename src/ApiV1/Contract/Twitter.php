<?php

declare(strict_types=1);

namespace PrettifyStudio\Twitter\ApiV1\Contract;

use PrettifyStudio\Twitter\Twitter as BaseTwitterContract;

interface Twitter extends BaseTwitterContract
{
    public const KEY_OAUTH_CALLBACK = 'oauth_callback';
    public const KEY_OAUTH_VERIFIER = 'oauth_verifier';
    public const KEY_OAUTH_TOKEN = 'oauth_token';
    public const KEY_OAUTH_TOKEN_SECRET = 'oauth_token_secret';
}
