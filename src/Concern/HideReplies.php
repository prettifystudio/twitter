<?php

declare(strict_types=1);

namespace PrettifyStudio\Twitter\Concern;

use PrettifyStudio\Twitter\Contract\Twitter;
use PrettifyStudio\Twitter\Exception\ClientException;

trait HideReplies
{
    use ApiV2Behavior;

    /**
     * @throws ClientException
     *
     * @see https://developer.twitter.com/en/docs/twitter-api/tweets/hide-replies/api-reference/put-tweets-id-hidden
     */
    public function hideTweet(string $tweetId, bool $hidden = true)
    {
        $parameters = [
            'hidden' => $hidden,
            Twitter::KEY_REQUEST_FORMAT => Twitter::REQUEST_FORMAT_JSON,
        ];

        return $this->getQuerier()
            ->put(sprintf('tweets/%s/hidden', $tweetId), $this->withDefaultParams($parameters));
    }
}
