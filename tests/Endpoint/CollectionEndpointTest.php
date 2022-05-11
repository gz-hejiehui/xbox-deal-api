<?php

namespace GzHejiehui\XboxDealApi\Tests\Endpoint;

use GzHejiehui\XboxDealApi\Entity\Collection;
use GzHejiehui\XboxDealApi\Tests\FakeData;
use GzHejiehui\XboxDealApi\Tests\TestCase;
use Laminas\Diactoros\Response\JsonResponse;

class CollectionEndpointTest extends TestCase
{
    public function testFetch()
    {
        $response = new JsonResponse(json_decode(FakeData::CHANNEL_LIST_COMMON_RESULT_JSON, true));
        $this->httpClient->addResponse($response);

        $actual = $this->getApi()->collection()->channel('TopFree')->fetch();

        $this->assertInstanceOf(Collection::class, $actual);
    }

    public function testFetchRaw()
    {
        $response = new JsonResponse(json_decode(FakeData::CHANNEL_LIST_COMMON_RESULT_JSON, true));
        $this->httpClient->addResponse($response);

        $actual = $this->getApi()->collection()->channel('TopFree')->fetchRaw();
        $expected = FakeData::CHANNEL_LIST_COMMON_RESULT_JSON;

        $this->assertJsonStringEqualsJsonString($expected, $actual);
    }
}
