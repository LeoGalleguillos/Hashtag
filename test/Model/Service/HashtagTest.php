<?php
namespace LeoGalleguillos\HashtagTest\Model\Service;

use ArrayObject;
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
}
