<?php

namespace GzHejiehui\XboxDealApi\Tests;

use GzHejiehui\XboxDealApi\XboxDealApi;
use Http\Mock\Client;
use Laminas\Diactoros\RequestFactory;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected ClientInterface $httpClient;
    protected RequestFactoryInterface $requestFactory;

    protected function setUp(): void
    {
        parent::setUp();

        $this->httpClient = new Client();
        $this->requestFactory = new RequestFactory();
    }

    protected function getApi(): XboxDealApi
    {
        return new XboxDealApi($this->httpClient, $this->requestFactory);
    }
}
