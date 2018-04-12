<?php
namespace LeoGalleguillos\Hashtag\Model\Factory;

use LeoGalleguillos\Hashtag\Model\Entity as HashtagEntity;
use LeoGalleguillos\Hashtag\Model\Table\Hashtag as HashtagTable;

class Hashtag
{
    public function __construct(HashtagTable $hashtagTable)
    {
        $this->hashtagTable = $hashtagTable;
    }

    public function buildFromHashtag(string $hashtag)
    {
        $array = $this->hashtagTable->selectWhereHashtag(
            $hashtag
        );

        return $this->buildFromArray($array);
    }

    /**
     * Build from array.
     *
     * @param array $array
     * @return HashtagEntity\Hashtag
     */
    public function buildFromArray(array $array)
    {
        $hashtagEntity = new HashtagEntity\Hashtag();

        $hashtagEntity->setHashtagId($array['hashtag_id'])
                      ->setHashtag($array['hashtag']);

        return $hashtagEntity;
    }
}
