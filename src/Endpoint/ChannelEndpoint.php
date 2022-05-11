<?php

namespace GzHejiehui\XboxDealApi\Endpoint;

use GzHejiehui\XboxDealApi\ChannelList;
use GzHejiehui\XboxDealApi\Exception\Exception as XboxDealApiException;
use GzHejiehui\XboxDealApi\XboxDealApi;
use Psr\Http\Client\ClientExceptionInterface;

class ChannelEndpoint implements EndpointInterface
{
    /**
     * @var XboxDealApi $api
     */
    private XboxDealApi $api;

    private string $queryChannel;
    private array $queryParams;

    /**
     * ChannelEndpoint constructor.
     *
     * @param XboxDealApi $api
     * @param string $queryChannel
     */
    public function __construct(XboxDealApi $api, string $queryChannel = 'TopFree')
    {
        $this->api = $api;
        $this->queryChannel = $queryChannel;
        $this->queryParams = [
            'ItemTypes' => 'Game',
            'Language' => 'en-US',
            'Market' => 'US',
            'count' => 200,
            'skipItems' => 0,
            'deviceFamily' => 'Windows.Xbox',
        ];
    }

    public function channel($name): self
    {
        $this->queryChannel = trim($name);
        return $this;
    }

    public function itemType(string $itemType): self
    {
        $this->queryParams['ItemTypes'] = trim($itemType);
        return $this;
    }

    public function language(string $language): self
    {
        $this->queryParams['Language'] = trim($language);
        return $this;
    }

    public function market(string $market): self
    {
        $this->queryParams['Market'] = $market;
        return $this;
    }

    public function count(int $count): self
    {
        $this->queryParams['count'] = $count;
        return $this;
    }

    public function deviceFamily(string $deviceFamily): self
    {
        $this->queryParams['deviceFamily'] = $deviceFamily;
        return $this;
    }

    public function skipItems(int $skipItems): self
    {
        $this->queryParams['skipItems'] = $skipItems;
        return $this;
    }

    /**
     * @return ChannelList
     *
     * @throws ClientExceptionInterface
     * @throws XboxDealApiException
     */
    public function fetch(): ChannelList
    {
        $rawData = $this->api->parseJson($this->fetchRaw());
        return new ChannelList($rawData);
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
        $uri = 'https://reco-public.rec.mp.microsoft.com/channels/Reco/V8.0/Lists/Computed/' . $this->queryChannel;
        $query = http_build_query($this->queryParams);

        return $uri . '?' . $query;
    }
}
