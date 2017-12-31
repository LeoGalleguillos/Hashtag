<?php
namespace LeoGalleguillos\HashtagTest\Model\Service;

use ArrayObject;
use Exception;
use LeoGalleguillos\Hashtag\Model\Service as HashtagService;
use LeoGalleguillos\Hashtag\Model\Table as HashtagTable;
use PHPUnit\Framework\TestCase;

class HashtagTest extends TestCase
{
    protected function setUp()
    {
        $this->hashtagTable   = $this->createMock(HashtagTable\Hashtag::class);
        $this->hashtagService = new HashtagService\Hashtag(
            $this->hashtagTable
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(HashtagService\Hashtag::class, $this->hashtagService);
    }

    public function testTryToGetHashtagIdOrInsertAndGetHashtagId()
    {
        $hashtag = 'ootd';

        $this->hashtagTable->method('insertIgnore')->willReturn(456);
        $this->hashtagTable->method('selectHashtagIdWhereHashtagEquals')->will(
            $this->onConsecutiveCalls(
                123,
                $this->throwException(new Exception)
            )
        );

        $this->assertSame(
            123,
            $this->hashtagService->tryToGetHashtagIdOrInsertAndGetHashtagId($hashtag)
        );
        $this->assertSame(
            456,
            $this->hashtagService->tryToGetHashtagIdOrInsertAndGetHashtagId($hashtag)
        );
    }
}
