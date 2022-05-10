<?php

namespace GzHejiehui\XboxDealApi\Endpoint;

use GzHejiehui\XboxDealApi\Exception\Exception as XboxDealApiException;
use GzHejiehui\XboxDealApi\XboxDealApi;
use Psr\Http\Client\ClientExceptionInterface;

class ProductEndpoint implements EndpointInterface
{
    /**
     * @var XboxDealApi $api
     */
    private XboxDealApi $api;

    private array $queryParams;

    public function __construct(XboxDealApi $api)
    {
        $this->api = $api;
        $this->queryParams = [
            'bigIds' => 'C48ZFTBQ17Q3',
            'market' => 'US',
            'languages' => 'en-US',
            'MS-CV' => 'DGU1mcuYo0WMMp+F.1',
        ];
    }

    /**
     * @param string ...$bigIds
     * @return $this
     */
    public function bigIds(string ...$bigIds): self
    {
        $this->queryParams['bigIds'] = implode(',', $bigIds);
        return $this;
    }

    /**
     * @param string $market
     * @return $this
     */
    public function market(string $market): self
    {
        $this->queryParams['market'] = trim($market);
        return $this;
    }

    /**
     * @param string $language
     * @return $this
     */
    public function language(string $language): self
    {
        $this->queryParams['languages'] = trim($language);
        return $this;
    }

    /**
     * @return array
     *
     * @throws ClientExceptionInterface
     * @throws XboxDealApiException
     */
    public function fetch(): array
    {
        return $this->api->parseJson($this->fetchRaw());
    }

    /**
     * Fetches the raw data from the API.
     *
     * @return string
     *
     * @throws ClientExceptionInterface
     * @throws XboxDealApiException
     */
    public function fetchRaw(): string
    {
        $queryUrl = $this->buildQueryUrl();

        return $this->api->fetchResult($queryUrl);
    }

    /**
     * Builds the query url.
     *
     * @return string
     */
    private function buildQueryUrl(): string
    {
        $uri = 'https://displaycatalog.mp.microsoft.com/v7.0/products';
        $query = http_build_query($this->queryParams);

        return $uri . '?' . $query;
    }
}
