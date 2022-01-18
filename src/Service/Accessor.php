<?php

declare(strict_types=1);

namespace PrettifyStudio\Twitter\Service;

use PrettifyStudio\Twitter\Concern\FilteredStream;
use PrettifyStudio\Twitter\Concern\Follows;
use PrettifyStudio\Twitter\Concern\HideReplies;
use PrettifyStudio\Twitter\Concern\HotSwapper;
use PrettifyStudio\Twitter\Concern\SampledStream;
use PrettifyStudio\Twitter\Concern\SearchTweets;
use PrettifyStudio\Twitter\Concern\Timelines;
use PrettifyStudio\Twitter\Concern\TweetCounts;
use PrettifyStudio\Twitter\Concern\TweetLookup;
use PrettifyStudio\Twitter\Concern\UserLookup;
use PrettifyStudio\Twitter\Contract\Querier as QuerierContract;
use PrettifyStudio\Twitter\Contract\Twitter as TwitterContract;

final class Accessor implements TwitterContract
{
    use TweetLookup;
    use SearchTweets;
    use Timelines;
    use FilteredStream;
    use SampledStream;
    use UserLookup;
    use Follows;
    use HideReplies;
    use HotSwapper;
    use TweetCounts;

    private QuerierContract $querier;

    public function __construct(QuerierContract $querier)
    {
        $this->querier = $querier;
    }

    public function getQuerier(): QuerierContract
    {
        return $this->querier;
    }

    private function setQuerier(QuerierContract $querier): self
    {
        $this->querier = $querier;

        return $this;
    }
}
