<?php

declare(strict_types=1);

namespace PrettifyStudio\Twitter\Exception;

use InvalidArgumentException;

final class InvalidConfigException extends InvalidArgumentException implements TwitterException
{
}
