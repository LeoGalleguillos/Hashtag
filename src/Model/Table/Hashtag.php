<?php
namespace LeoGalleguillos\Hashtag\Model\Table;

use Exception;
use Zend\Db\Adapter\Adapter;

class Hashtag
{
    /**
     * @var Adapter
     */
    private $adapter;

    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * Select hashtag ID where hashtag equals.
     *
     * @throws Exception
     * @return int
     */
    public function selectHashtagIdWhereHashtagEquals($hashtag)
    {
        $sql = '
            SELECT `hashtag_id`
              FROM `hashtag`
             WHERE `hashtag` = ?
                 ;
        ';
        $row = $this->adapter->query($sql, [$hashtag])->current();

        if (empty($row)) {
            throw new Exception('Hashtag not found');
        }

        return (int) $row['hashtag_id'];
    }

    public function selectWhereHashtag(string $hashtag) : array
    {
        $sql = '
            SELECT `hashtag_id`
                 , `hashtag`
              FROM `hashtag`
             WHERE `hashtag` = ?
                 ;
        ';
        return $this->adapter->query($sql)->execute([$hashtag])->current();
    }

    public function insertIgnore($hashtag)
    {
        $sql = '
            INSERT IGNORE
              INTO `hashtag` (`hashtag`)
            VALUES (?)
                 ;
        ';
        $parameters = [
            $hashtag
        ];

        return $this->adapter->query($sql, $parameters)->getGeneratedValue();
    }
}
