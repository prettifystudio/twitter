<?php
/**
 * @noinspection PhpParamsInspection
 */

declare(strict_types=1);

namespace PrettifyStudio\Twitter\Tests\Unit\ApiV1\Traits;

use PrettifyStudio\Twitter\ApiV1\Traits\FormattingHelpers;

final class FormattingHelpersTest extends ConcernTestCase
{
    /**
     * @dataProvider dataGetUserLink
     */
    public function testGetUserLink($user): void
    {
        $this->assertSame(
            'https://twitter.com/PrettifyStudio',
            $this->subject->linkUser($user)
        );
    }

    public function dataGetUserLink(): array
    {
        return [
            'string' =>  ['PrettifyStudio'],
            'object' =>  [(object) ['screen_name' => 'PrettifyStudio']],
            'array' =>  [['screen_name' => 'PrettifyStudio']],
        ];
    }

    /**
     * @dataProvider dataLinkAddTweetToFavorites
     */
    public function testLinkAddTweetToFavorites($tweet): void
    {
        $this->assertSame(
            'https://twitter.com/intent/favorite?tweet_id=1381031025053155332',
            $this->subject->linkAddTweetToFavorites($tweet)
        );
    }

    public function dataLinkAddTweetToFavorites(): array
    {
        return [
            'object' =>  [(object) ['id_str' => '1381031025053155332']],
            'array' =>  [['id_str' => '1381031025053155332']],
        ];
    }

    protected function getTraitName(): string
    {
        return FormattingHelpers::class;
    }
}
