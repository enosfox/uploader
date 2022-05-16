<?php

namespace KitsuneCode\Uploader;

use Exception;

/**
 * Class KitsuneCode Media
 *
 * @author Enos S. S. Silva <https://github.com/enosfox>
 * @package KitsuneCode\Uploader
 */
class Media extends Uploader
{
    /**
     * Allow mp4 video and mp3 audio
     * @var array allowed media types
     * https://www.freeformatter.com/mime-types-list.html
     */
    protected static array $allowTypes = [
        "audio/mp3",
        "audio/mpeg",
        "video/mp4",
        "video/quicktime",
        "video/webm",
        "audio/webm"
    ];

    /**
     * Allowed extensions to types.
     * @var array
     */
    protected static array $extensions = [
        "mp3",
        "mp4",
        "mov",
        "webm",
        "weba"
    ];

    /**
     * @param array $media
     * @param string $name
     * @return string
     * @throws Exception
     */
    public function upload(array $media, string $name): string
    {
        $this->ext($media);

        if (!in_array($media['type'], static::$allowTypes) || !in_array($this->ext, static::$extensions)) {
            throw new Exception("Not a valid media type or extension");
        }

        $this->name($name);
        move_uploaded_file($media['tmp_name'], "{$this->path}/{$this->name}");
        return "{$this->path}/{$this->name}";
    }
}