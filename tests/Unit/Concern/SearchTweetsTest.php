<?php
/**
 * @noinspection PhpParamsInspection
 */

declare(strict_types=1);

namespace PrettifyStudio\Twitter\Tests\Unit\Concern;

use PrettifyStudio\Twitter\Concern\SearchTweets;
use Exception;
use Prophecy\Argument;

final class SearchTweetsTest extends ConcernTestCase
{
    /**
     * @throws Exception
     */
    public function testSearchRecent(): void
    {
        $query = 'cars';
        $params = self::ARBITRARY_PARAMS;

        $this->querier->get(
            'tweets/search/recent',
            Argument::that(
                fn (array $argument) => $argument['query'] === $query
            )
        )
            ->shouldBeCalledTimes(1);

        $this->subject->searchRecent($query, $params);
    }

    /**
     * @throws Exception
     */
    public function testSearchAll(): void
    {
        $query = 'cars';
        $params = self::ARBITRARY_PARAMS;

        $this->querier->get(
            'tweets/search/all',
            Argument::that(
                fn (array $argument) => $argument['query'] === $query
            )
        )
            ->shouldBeCalledTimes(1);

        $this->subject->searchAll($query, $params);
    }

    protected function getTraitName(): string
    {
        return SearchTweets::class;
    }
}
