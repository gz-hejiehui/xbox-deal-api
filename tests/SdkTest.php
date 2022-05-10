<?php

namespace GzHejiehui\XboxDealApi\Tests;

use Laminas\Diactoros\Response;

final class SdkTest extends TestCase
{
    public function testCanRequest200Response()
    {
        $this->mockClient->addResponse((new Response())->withStatus(200));

        $httpClient = $this->getSdk()->getHttpClient();
        $response = $httpClient->get('/todos');

        $this->assertEquals(200, $response->getStatusCode());
    }
}
