<?php

namespace GzHejiehui\XboxDealApi\Tests;

use GzHejiehui\XboxDealApi\Endpoint\CollectionEndpoint;
use GzHejiehui\XboxDealApi\Endpoint\ProductEndpoint;
use GzHejiehui\XboxDealApi\Exception\Exception as XboxDealApiException;
use GzHejiehui\XboxDealApi\Exception\NotFoundException;
use GzHejiehui\XboxDealApi\Exception\ParseJsonException;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\Response\JsonResponse;

class XboxDealApiTest extends TestCase
{
    public function testFetchResult()
    {
        $excepted = '{"foot":"ball"}';

        $this->httpClient->addResponse(new JsonResponse(['foot' => 'ball']));
        $actual = $this->getApi()->fetchResult('/test');

        $this->assertEquals($excepted, $actual);
    }

    public function testFetchResultNotFoundException()
    {
        $this->expectException(NotFoundException::class);

        $this->httpClient->addResponse((new Response())->withstatus(404));
        $this->getApi()->fetchResult('/test');
    }

    public function testFetchResultUnknownApiException()
    {
        $this->expectException(XboxDealApiException::class);

        $this->httpClient->addResponse((new Response())->withstatus(500));
        $this->getApi()->fetchResult('/test');
    }

    public function testParseJson()
    {
        $expected = ['foot' => 'ball'];
        $actual = $this->getApi()->parseJson('{"foot":"ball"}');

        $this->assertEquals($expected, $actual);
    }

    public function testParseJsonException()
    {
        $this->expectException(ParseJsonException::class);

        $this->getApi()->parseJson("{'foot':'ball'}");
    }

    public function testChannelEndpoint()
    {
        $actual = $this->getApi()->collection();
        $this->assertInstanceOf(CollectionEndpoint::class, $actual);
    }

    public function testProductEndpoint()
    {
        $actual = $this->getApi()->product();
        $this->assertInstanceOf(ProductEndpoint::class, $actual);
    }
}
