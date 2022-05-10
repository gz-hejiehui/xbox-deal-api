<?php

namespace GzHejiehui\XboxDealApi\Endpoint;

use GzHejiehui\XboxDealApi\HttpClient\Message\ResponseMediator;
use GzHejiehui\XboxDealApi\Sdk;
use Http\Client\Exception;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class Product
{
    /**
     * @var Sdk $sdk
     */
    private Sdk $sdk;

    /**
     * @var array $queryParams
     */
    private array $queryParams = [];

    /**
     * @param Sdk $sdk
     */
    public function __construct(Sdk $sdk)
    {
        $this->sdk = $sdk;
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
     */
    private function getQueryParams(): array
    {
        $resolver = new OptionsResolver();
        $resolver->setDefaults([
            'bigIds' => '',
            'market' => 'US',
            'languages' => 'en-US',
            'MS-CV' => 'DGU1mcuYo0WMMp+F.1',
        ]);

        return $resolver->resolve($this->queryParams);
    }

    /**
     * @return array
     * @throws Exception
     */
    public function get(): array
    {
        $queryString = http_build_query($this->getQueryParams());
        $url = sprintf('https://displaycatalog.mp.microsoft.com/v7.0/products?%s', $queryString);

        return ResponseMediator::getContent($this->sdk->getHttpClient()->get($url));
    }
}
