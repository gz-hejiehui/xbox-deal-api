<?php

namespace GzHejiehui\XboxDealApi\Tests\Entity;

use GzHejiehui\XboxDealApi\Entity\ChannelList;
use GzHejiehui\XboxDealApi\Tests\FakeData;
use GzHejiehui\XboxDealApi\Tests\TestCase;

class ChannelListTest extends TestCase
{
    public function testParseCommonResult()
    {
        $fakeData = json_decode(FakeData::CHANNEL_LIST_COMMON_RESULT_JSON, true);
        $actual = new ChannelList($fakeData);

        $this->assertInstanceOf(ChannelList::class, $actual);
    }

    public function testParseEmptyResult()
    {
        $fakeData = json_decode(FakeData::CHANNEL_LIST_EMPTY_RESULT_JSON, true);
        $actual = new ChannelList($fakeData);

        $this->assertInstanceOf(ChannelList::class, $actual);
    }
}
