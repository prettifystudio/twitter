<?php

namespace PrettifyStudio\Twitter\ApiV1\Traits;

use BadMethodCallException;

trait MediaTrait
{
    /**
     * Upload media (images) to Twitter, to use in a Tweet or Twitter-hosted Card.
     *
     * Parameters :
     * - media
     * - media_data
     *
     * @return mixed
     *
     * @throws BadMethodCallException
     */
    public function uploadMedia(array $parameters = [])
    {
        $commandKey = 'command';
        $mediaKey = 'media';
        $mediaDataKey = 'media_data';

        if (isset($parameters[$mediaKey], $parameters[$mediaDataKey])) {
            throw new BadMethodCallException('You cannot use `media` and `media_data` at the same time.');
        }

        if (!(isset($parameters[$mediaKey]) || isset($parameters[$mediaDataKey]) || isset($parameters[$commandKey]))) {
            throw new BadMethodCallException('Required parameter: `media`, `media_data` or `command`');
        }

        return $this->post('media/upload', $this->normalizeParameters($parameters), true);
    }

    /**
     * Get the status of uploaded media
     *
     * Parameters :
     * - command (STATUS)
     * - media_id
     */
    public function uploadStatus($parameters = [])
    {
        return $this->directQuery('https://upload.twitter.com/1.1/media/upload.json', 'GET', $parameters);
    }


    private function normalizeParameters(array $parameters): array
    {
        $normalizedParams = [];
        $nameKey = 'name';
        $contentsKey = 'contents';

        foreach ($parameters as $key => $value) {
            if (is_array($value) && isset($value[$nameKey], $value[$contentsKey])) {
                $normalizedParams[] = $value;

                continue;
            }

            if (!is_array($value)) {
                $normalizedParams[] = [
                    $nameKey => $key,
                    $contentsKey => $value,
                ];
            }
        }

        return $normalizedParams;
    }
}
