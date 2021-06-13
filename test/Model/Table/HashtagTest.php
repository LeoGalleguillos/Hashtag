<?php
namespace LeoGalleguillos\HastagTest\Model\Table;

use ArrayObject;
use Exception;
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

    protected function setUp(): void
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

    public function testSelectHashtagIdWhereHashtagEquals()
    {
        $hashtag = 'ootd';

        try {
            $hashtagId = $this->hashtagTable->selectHashtagIdWhereHashtagEquals(
                $hashtag
            );
            $this->fail();
        } catch (Exception $exception) {
            $this->assertSame(
                'Hashtag not found',
                $exception->getMessage()
            );
        }

        $this->hashtagTable->insertIgnore('ootd');
        $this->hashtagTable->insertIgnore('helloworld');
        $this->hashtagTable->insertIgnore('iphone');
        $this->assertSame(
            1,
            $this->hashtagTable->selectHashtagIdWhereHashtagEquals('ootd')
        );
        $this->assertSame(
            2,
            $this->hashtagTable->selectHashtagIdWhereHashtagEquals('helloworld')
        );
        $this->assertSame(
            3,
            $this->hashtagTable->selectHashtagIdWhereHashtagEquals('iphone')
        );
    }

    public function testInsertIgnore()
    {
        $hashtag = 'ootd';
        $this->assertEquals(
            1,
            $this->hashtagTable->insertIgnore($hashtag)
        );
        $this->assertEquals(
            0,
            $this->hashtagTable->insertIgnore($hashtag)
        );
        $hashtag = 'helloworld';
        $this->assertEquals(
            3,
            $this->hashtagTable->insertIgnore($hashtag)
        );
    }

    public function testSelectWhereHashtag()
    {
        $hashtag = 'ootd';
        $this->hashtagTable->insertIgnore($hashtag);

        $array = [
            'hashtag_id' => '1',
            'hashtag'    => 'ootd',
        ];
        $this->assertSame(
            $array,
            $this->hashtagTable->selectWhereHashtag($hashtag)
        );
    }
}
