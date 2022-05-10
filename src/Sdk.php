<?php

namespace GzHejiehui\XboxDealApi;

use GzHejiehui\XboxDealApi\Endpoint\Channel;
use GzHejiehui\XboxDealApi\Endpoint\Product;
use Http\Client\Common\HttpMethodsClientInterface;
use Http\Client\Common\Plugin\HeaderDefaultsPlugin;

final class Sdk
{
    private ClientBuilder $clientBuilder;

    public function __construct(Options $options = null)
    {
        $options = $options ?? new Options();
        $this->clientBuilder = $options->getClientBuilder();

        $this->clientBuilder->addPlugins(
            new HeaderDefaultsPlugin([
                'User-Agent' => 'My Custom SDK', // TODO: use random user agent
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ])
        );
    }

    public function getHttpClient(): HttpMethodsClientInterface
    {
        return $this->clientBuilder->getHttpClient();
    }

    /**
     * Channel Endpoint
     *
     * @param string $name The channel name
     * @return Channel
     */
    public function channel(string $name): Channel
    {
        return new Channel($this, $name);
    }

    /**
     * Product Endpoint
     *
     * @return Product
     */
    public function product(): Product
    {
        return new Product($this);
    }
}
