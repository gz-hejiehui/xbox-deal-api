<?php

namespace GzHejiehui\XboxDealApi;

use GzHejiehui\XboxDealApi\Endpoint\CollectionEndpoint;
use GzHejiehui\XboxDealApi\Endpoint\ProductEndpoint;
use GzHejiehui\XboxDealApi\Exception\Exception as XboxDealApiException;
use GzHejiehui\XboxDealApi\Exception\NotFoundException;
use GzHejiehui\XboxDealApi\Exception\ParseJsonException;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;

final class XboxDealApi
{
    /**
     * @var ClientInterface The PSR-18 HTTP client.
     */
    private ClientInterface $httpClient;

    /**
     * @var RequestFactoryInterface The PSR-18 HTTP request factory.
     */
    private RequestFactoryInterface $requestFactory;

    /**
     * XboxDealApi constructor.
     *
     * @param ClientInterface $httpClient
     * @param RequestFactoryInterface $requestFactory
     */
    public function __construct(ClientInterface $httpClient, RequestFactoryInterface $requestFactory)
    {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
    }

    /**
     * Fetches the result.
     *
     * @param string $url
     * @return string
     *
     * @throws ClientExceptionInterface
     * @throws XboxDealApiException
     */
    public function fetchResult(string $url): string
    {
        $url = $this->requestFactory->createRequest('GET', $url);

        $response = $this->httpClient->sendRequest($url);
        $result = $response->getBody()->getContents();
        if ($response->getStatusCode() !== 200) {
            if ($response->getStatusCode() === 404) {
                throw new NotFoundException();
            }
            throw new XboxDealApiException('The Api returned a response with status code ' . $response->getStatusCode() . ' and the following content `' . $result . '`');
        }

        return $result;
    }

    /**
     * Parse the json result to an array.
     *
     * @throws XboxDealApiException
     */
    public function parseJson(string $result): array
    {
        $decoded = json_decode($result, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new ParseJsonException('The Api returned a response with an invalid json content `' . $result . '`');
        }
        return $decoded;
    }

    /**
     * Get the collection endpoint.
     *
     * @return CollectionEndpoint
     */
    public function collection(): CollectionEndpoint
    {
        return new CollectionEndpoint($this);
    }

    /**
     * Get the product endpoint.
     *
     * @return ProductEndpoint
     */
    public function productEndpoint(): ProductEndpoint
    {
        return new ProductEndpoint($this);
    }
}
