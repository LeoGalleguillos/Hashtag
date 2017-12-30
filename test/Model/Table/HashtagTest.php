<?php
namespace LeoGalleguillos\HastagTest\Model\Table;

use ArrayObject;
use LeoGalleguillos\Hashtag\Model\Table as HashtagTable;
use Zend\Db\Adapter\Adapter;
use PHPUnit\Framework\TestCase;

class HashtagTest extends TestCase
{
    /**
     * @var string
     */
    protected $sqlPath = __DIR__ . '/../../..' . '/sql/leogalle_test/hashtag/';

    /**
     * @var HashtagTable\Hashtag
     */
    protected $hashtagTable;

    protected function setUp()
    {
        $configArray        = require(__DIR__ . '/../../../config/autoload/local.php');
        $configArray        = $configArray['db']['adapters']['leogalle_test'];
        $this->adapter      = new Adapter($configArray);
        $this->hashtagTable = new HashtagTable\Hashtag($this->adapter);

        $this->dropTable();
        $this->createTable();
    }

    protected function dropTable()
    {
        $sql = file_get_contents($this->sqlPath . 'drop.sql');
        $result = $this->adapter->query($sql)->execute();
    }

    protected function createTable()
    {
        $sql = file_get_contents($this->sqlPath . 'create.sql');
        $result = $this->adapter->query($sql)->execute();
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(HashtagTable\Hashtag::class, $this->hashtagTable);
    }
}
