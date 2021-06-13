<?php
namespace LeoGalleguillos\HashtagTest\Model\Factory;

use Exception;
use LeoGalleguillos\Hashtag\Model\Factory as HashtagFactory;
use LeoGalleguillos\Hashtag\Model\Table as HashtagTable;
use PHPUnit\Framework\TestCase;

class HashtagTest extends TestCase
{
    protected function setUp(): void
    {
        $this->hashtagTableMock   = $this->createMock(HashtagTable\Hashtag::class);
        $this->hashtagFactory = new HashtagFactory\Hashtag(
            $this->hashtagTableMock
        );
    }

    public function testInitialize()
    {
        $this->assertInstanceOf(
            HashtagFactory\Hashtag::class,
            $this->hashtagFactory
        );
    }
}
