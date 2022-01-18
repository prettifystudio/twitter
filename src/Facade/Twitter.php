<?php

namespace PrettifyStudio\Twitter\Facade;

use PrettifyStudio\Twitter\Twitter as TwitterContract;
use Illuminate\Support\Facades\Facade;

/**
 * @codeCoverageIgnore
 */
class Twitter extends Facade
{
    /**
     * Get the registered name of the component.
     */
    protected static function getFacadeAccessor(): string
    {
        return TwitterContract::class;
    }
}
