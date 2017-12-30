<?php
namespace LeoGalleguillos\Hashtag\Model\Service;

use Exception;
use LeoGalleguillos\Hashtag\Model\Table as HashtagTable;

class Hashtag
{
    public function __construct(HashtagTable\Hashtag $hashtagTable)
    {
        $this->hashtagTable = $hashtagTable;
    }

    /**
     * return int
     */
    public function tryToGetHashtagIdOrInsertAndGetHashtagId($hashtag)
    {
        try {
            return $this->hashtagTable->selectHashtagIdWhereHashtagEquals(
                $hashtag
            );
        } catch (Exception $exception) {
            return $this->hashtagTable->insertWhereNotExists($hashtag);
        }
    }
}
