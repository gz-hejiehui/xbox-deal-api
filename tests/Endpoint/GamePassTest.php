<?php

namespace GzHejiehui\XboxDealApi\Tests\Endpoint;

use GzHejiehui\XboxDealApi\Tests\FakeData;
use Laminas\Diactoros\Response\JsonResponse;

class GamePassTest extends \GzHejiehui\XboxDealApi\Tests\TestCase
{
    public function testGetGames()
    {
        $fakeData = json_decode(FakeData::GAME_PASS_ALL_GAMES_RESULT_JSON, true);
        $this->httpClient->addResponse(new JsonResponse($fakeData));

        $actual = $this->getApi()->gamePass()->getGames('29a81209-df6f-41fd-a528-2ae6b91f719c');
        $expected = array_map(fn($item) => $item['id'], array_filter($fakeData, fn($item) => isset($item['id'])));

        $this->assertIsArray($actual);
        $this->assertEquals($expected, $actual);
    }
}
