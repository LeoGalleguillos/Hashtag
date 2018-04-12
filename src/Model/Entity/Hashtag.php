<?php
namespace LeoGalleguillos\Hashtag\Model\Entity;

class Hashtag
{
    /**
     * @var int
     */
    protected $hashtagId;

    /**
     * @var string
     */
    protected $hashtag;

    public function getHashtag() : string
    {
        return $this->hashtag;
    }

    public function getHashtagId() : int
    {
        return $this->hashtagId;
    }

    public function setHashtag(string $hashtag) : HashtagEntity\Hashtag
    {
        $this->hashtag = $hashtag;
        return $this;
    }

    public function setHashtagId(int $hashtagId) : HashtagEntity\Hashtag
    {
        $this->hashtagId = $hashtagId;
        return $this;
    }
}
