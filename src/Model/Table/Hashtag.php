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

    public function insertIfNotExists($hashtag)
    {
        return $this->insertWhereNotExists($hashtag);
    }

    /**
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

        if ($row === false) {
            throw new Exception('Hashtag not found');
        }

        return (int) $row['hashtag_id'];
    }

    public function insertWhereNotExists($hashtag)
    {
        $sql = '
            INSERT
              INTO `hashtag` (`hashtag`)
                SELECT ?
                FROM `hashtag`
               WHERE NOT EXISTS (
                   SELECT `hashtag`
                     FROM `hashtag`
                    WHERE `hashtag` = ?
               )
               LIMIT 1
            ;
        ';
        $parameters = [
            $hashtag,
            $hashtag
        ];

        return $this->adapter->query($sql, $parameters)->getGeneratedValue();
    }
}
