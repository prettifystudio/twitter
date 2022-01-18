<?php

namespace ApiV1\Traits;

use BadMethodCallException;

trait MediaSubtitlesTrait
{
    /**
     * Use this endpoint to associate uploaded subtitles to an uploaded video. You can associate subtitles to video before or after Tweeting.
     *
     * Parameters :
     * - media_id
     * - media_category
     * - subtitle_info
     */
    public function postMediaSubtitles($parameters = [])
    {
        return $this->post('media/subtitles/create', $parameters, true);
    }

    /**
     * Use this endpoint to dissociate subtitles from a video and delete the subtitles. You can dissociate subtitles from a video before or after Tweeting. Returns HTTP 200 upon success.
     */
    public function destroyMediaSubtitles($parameters = [])
    {
        return $this->post('media/subtitles/delete', $parameters);
    }
}
