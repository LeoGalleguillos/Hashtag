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
    public function buildFromArray(array $array) : HashtagEntity\Hashtag
    {
        $hashtagEntity = new HashtagEntity\Hashtag();

        $hashtagEntity->setHashtagId($array['user_id'])
                   ->setHashtagname($array['username']);

        if (isset($array['created'])) {
            $hashtagEntity->setCreated(
                new DateTime($array['created'])
            );
        }

        $hashtagEntity->setViews(
            (int) ($array['views'] ?? 0)
        );
        $hashtagEntity->setWelcomeMessage(
            (string) ($array['welcome_message'] ?? '')
        );

        return $hashtagEntity;
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
