<?php

namespace GzHejiehui\XboxDealApi\Endpoint;

use GzHejiehui\XboxDealApi\Exception\Exception as XDAException;
use GzHejiehui\XboxDealApi\XboxDealApi;
use Psr\Http\Client\ClientExceptionInterface;

class GamePass
{
    /**
     * @var string $apiUri The base api uri to fetch games from.
     */
    private string $apiUri = 'https://catalog.gamepass.com/sigls/v2';

    /**
     * @var XboxDealApi The API instance
     */
    private XboxDealApi $api;

    /**
     * GamePass constructor.
     *
     * @param XboxDealApi $api The API instance
     */
    public function __construct(XboxDealApi $api)
    {
        $this->api = $api;
    }

    /**
     * Get all games.
     *
     * @param string $market The market to fetch games from. (default: US)
     * @param string $language The language to fetch games from. (default: en-US)
     *
     * @return array The game ids. (e.g. ["BRL7GC0GP1BM", "9NL4KTK0N4CG"])
     *
     * @throws XDAException
     * @throws ClientExceptionInterface
     */
    public function getAllGames(string $market = 'US', string $language = 'en-US'): array
    {
        return $this->getGames('29a81209-df6f-41fd-a528-2ae6b91f719c', $market, $language);
    }

    /**
     * Get all pc games.
     *
     * @param string $market The market to fetch games from. (default: US)
     * @param string $language The language to fetch games from. (default: en-US)
     *
     * @return array The game ids. (e.g. ["BRL7GC0GP1BM", "9NL4KTK0N4CG"])
     *
     * @throws ClientExceptionInterface
     * @throws XDAException
     */
    public function getAllPCGames(string $market = 'US', string $language = 'en-US'): array
    {
        return $this->getGames('609d944c-d395-4c0a-9ea4-e9f39b52c1ad', $market, $language);
    }

    /**
     * Get all console games.
     *
     * @param string $market The market to fetch games from. (default: US)
     * @param string $language The language to fetch games from. (default: en-US)
     *
     * @return array The game ids. (e.g. ["BRL7GC0GP1BM", "9NL4KTK0N4CG"])
     *
     * @throws ClientExceptionInterface
     * @throws XDAException
     */
    public function getAllConsoleGames(string $market = 'US', string $language = 'en-US'): array
    {
        return $this->getGames('f6f1f99f-9b49-4ccd-b3bf-4d9767a77f5e', $market, $language);
    }

    /**
     * Get bethesda games.
     *
     * @param string $market The market to fetch games from. (default: US)
     * @param string $language The language to fetch games from. (default: en-US)
     *
     * @return array The game ids. (e.g. ["BRL7GC0GP1BM", "9NL4KTK0N4CG"])
     *
     * @throws ClientExceptionInterface
     * @throws XDAException
     */
    public function getBethesdaGames(string $market = 'US', string $language = 'en-US'): array
    {
        return $this->getGames('79fe89cf-f6a3-48d4-af6c-de4482cf4a51', $market, $language);
    }

    /**
     * Get the most popular games.
     *
     * @param string $market The market to fetch games from. (default: US)
     * @param string $language The language to fetch games from. (default: en-US)
     *
     * @return array The game ids. (e.g. ["BRL7GC0GP1BM", "9NL4KTK0N4CG"])
     *
     * @throws ClientExceptionInterface
     * @throws XDAException
     */
    public function getMostPopularGames(string $market = 'US', string $language = 'en-US'): array
    {
        return $this->getGames('a884932a-f02b-40c8-a903-a008c23b1df1', $market, $language);
    }

    /**
     * Get EA Play games.
     *
     * @param string $market The market to fetch games from. (default: US)
     * @param string $language The language to fetch games from. (default: en-US)
     *
     * @return array The game ids. (e.g. ["BRL7GC0GP1BM", "9NL4KTK0N4CG"])
     *
     * @throws ClientExceptionInterface
     * @throws XDAException
     */
    public function getEAPlayGames(string $market = 'US', string $language = 'en-US'): array
    {
        return $this->getGames('b8900d09-a491-44cc-916e-32b5acae621b', $market, $language);
    }

    /**
     * Get games.
     *
     * @param string $sigId The signature id.
     * @param string $market The market to fetch games from. (default: US)
     * @param string $language The language to fetch games from. (default: en-US)
     *
     * @return array The game ids. (e.g. ["BRL7GC0GP1BM", "9NL4KTK0N4CG"])
     *
     * @throws ClientExceptionInterface
     * @throws XDAException
     */
    public function getGames(string $sigId, string $market = 'US', string $language = 'en-US'): array
    {
        $url = $this->buildUrl($sigId, $market, $language);

        $rawData = $this->api->fetchResult($url);

        return $this->parseProductIdsFromRawData($rawData);
    }

    /**
     * Build the url for the api call.
     *
     * @param string $sigId The signature id.
     * @param string $market The market to fetch games from. (default: US)
     * @param string $language The language to fetch games from. (default: en-US)
     *
     * @return string The url.
     */
    private function buildUrl(string $sigId, string $market, string $language): string
    {
        return $this->apiUri . '?id=' . $sigId . '&market=' . $market . '&language=' . $language;
    }

    /**
     * Parse the raw data and return the product ids.
     *
     * @param string $rawData The raw data.
     *
     * @return array The product ids. (e.g. ["BRL7GC0GP1BM", "9NL4KTK0N4CG"])
     */
    private function parseProductIdsFromRawData(string $rawData): array
    {
        $data = json_decode($rawData, true);

        return array_map(fn($item) => $item['id'], array_filter($data, fn($item) => isset($item['id'])));
    }
}
