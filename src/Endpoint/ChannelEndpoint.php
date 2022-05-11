<?php

namespace GzHejiehui\XboxDealApi\Endpoint;

use GzHejiehui\XboxDealApi\Entity\ChannelList;
use GzHejiehui\XboxDealApi\Exception\Exception as XboxDealApiException;
use GzHejiehui\XboxDealApi\XboxDealApi;
use Psr\Http\Client\ClientExceptionInterface;

class ChannelEndpoint implements EndpointInterface
{
    /**
     * @var XboxDealApi $api
     */
    private XboxDealApi $api;

    /**
     * @var string $channelName
     */
    private string $channelName;

    /**
     * @var array $queryParams
     */
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
        $this->channelName = $queryChannel;

        // Set default query params
        $this->queryParams = [
            'ItemTypes' => 'Game',
            'Language' => 'en-US',
            'Market' => 'US',
            'count' => 200,
            'skipItems' => 0,
            'deviceFamily' => 'Windows.Xbox',
        ];
    }

    /**
     * Set the channel name to query
     *
     * @param string $name The channel name
     * @return $this
     */
    public function channel(string $name): self
    {
        $this->channelName = trim($name);
        return $this;
    }

    /**
     * Set the query item type
     *
     * @param string $itemType
     * @return $this
     */
    public function itemType(string $itemType): self
    {
        $this->queryParams['ItemTypes'] = trim($itemType);
        return $this;
    }

    /**
     * Set the query language
     *
     * @param string $language
     * @return $this
     */
    public function language(string $language): self
    {
        $this->queryParams['Language'] = trim($language);
        return $this;
    }

    /**
     * Set the query market
     *
     * @param string $market
     * @return $this
     */
    public function market(string $market): self
    {
        $this->queryParams['Market'] = $market;
        return $this;
    }

    /**
     * Set the query page
     *
     * @param int $page The page number, default is 1
     * @param int $count The number of items per page, default is 200
     * @return $this
     */
    public function page(int $page, int $count = 200): self
    {
        $this->queryParams['count'] = $count;
        $this->queryParams['skipItems'] = $count * ($page - 1);
        return $this;
    }

    /**
     * Set the query device family
     *
     * @param string $deviceFamily
     * @return $this
     */
    public function deviceFamily(string $deviceFamily): self
    {
        $this->queryParams['deviceFamily'] = $deviceFamily;
        return $this;
    }

    /**
     * Fetch the channel list
     *
     * @return ChannelList
     * @throws ClientExceptionInterface
     * @throws XboxDealApiException
     */
    public function fetch(): ChannelList
    {
        $rawData = $this->api->parseJson($this->fetchRaw());
        return new ChannelList($rawData);
    }

    /**
     * Fetch the raw data from the API.
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
     * Build the query url.
     *
     * @return string
     */
    private function buildQueryUrl(): string
    {
        $uri = 'https://reco-public.rec.mp.microsoft.com/channels/Reco/V8.0/Lists/Computed/' . $this->channelName;
        $query = http_build_query($this->queryParams);

        return $uri . '?' . $query;
    }
}
