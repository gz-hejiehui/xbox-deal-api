<?php

namespace GzHejiehui\XboxDealApi\Tests;

use GzHejiehui\XboxDealApi\ClientBuilder;
use GzHejiehui\XboxDealApi\Options;
use GzHejiehui\XboxDealApi\Sdk;
use Http\Mock\Client;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected Client $mockClient;

    protected function setUp(): void
    {
        parent::setUp();

        $this->mockClient = new Client();
    }

    protected function getSdk(): Sdk
    {
        return new Sdk(new Options([
            'client_builder' => new ClientBuilder($this->mockClient),
        ]));
    }
}
