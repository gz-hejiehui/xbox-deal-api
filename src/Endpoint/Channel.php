<?php

namespace GzHejiehui\XboxDealApi\Endpoint;

use GzHejiehui\XboxDealApi\HttpClient\Message\ResponseMediator;
use GzHejiehui\XboxDealApi\Sdk;
use Http\Client\Exception;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class Channel
{
    private const HOST = 'https://reco-public.rec.mp.microsoft.com';

    /**
     * @var Sdk $sdk
     */
    private Sdk $sdk;

    /**
     * @var string $name
     */
    private string $name;

    /**
     * @var array $queryParams
     */
    private array $queryParams = [];

    public function __construct(Sdk $sdk, string $name)
    {
        $this->sdk = $sdk;
        $this->name = trim($name);
    }

    /**
     * @param string $itemType
     * @return $this
     */
    public function itemType(string $itemType): self
    {
        $this->queryParams['ItemTypes'] = trim($itemType);
        return $this;
    }


    /**
     * @param string $language
     * @return $this
     */
    public function language(string $language): self
    {
        $this->queryParams['Language'] = trim($language);
        return $this;
    }

    /**
     * @param string $market
     * @return $this
     */
    public function market(string $market): self
    {
        $this->queryParams['Market'] = $market;
        return $this;
    }

    /**
     * @param int $count
     * @return $this
     */
    public function count(int $count): self
    {
        $this->queryParams['count'] = $count;
        return $this;
    }

    /**
     * @param string $deviceFamily
     * @return $this
     */
    public function deviceFamily(string $deviceFamily): self
    {
        $this->queryParams['deviceFamily'] = $deviceFamily;
        return $this;
    }

    /**
     * @param int $skipItems
     * @return $this
     */
    public function skipItems(int $skipItems): self
    {
        $this->queryParams['skipItems'] = $skipItems;
        return $this;
    }

    /**
     * @return array
     */
    private function getQueryParams(): array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'ItemTypes' => 'Game',
            'Language' => 'en-US',
            'Market' => 'US',
            'count' => 200,
            'skipItems' => 0,
            'deviceFamily' => 'Windows.Xbox',
        ]);

        return $resolver->resolve($this->queryParams);
    }

    /**
     * @throws Exception
     */
    public function get(): array
    {
        $queryString = http_build_query($this->getQueryParams());
        $url = sprintf('%s/channels/Reco/V8.0/Lists/Computed/%s?%s', self::HOST, $this->name, $queryString);

        return ResponseMediator::getContent($this->sdk->getHttpClient()->get($url));
    }
}
