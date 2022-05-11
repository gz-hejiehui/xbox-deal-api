<?php

namespace GzHejiehui\XboxDealApi\Entity\ChannelList;

class PagingInfo
{
    /**
     * @var array $rawData
     */
    private array $rawData;

    /**
     * @var int $totalItems
     */
    public int $totalItems;

    /**
     * ChannelListPagingInfo constructor.
     *
     * @param array $rawData
     */
    public function __construct(array $rawData)
    {
        $this->rawData = $rawData;
        $this->parse();
    }

    /**
     * parse raw data
     */
    private function parse(): void
    {
        $this->totalItems = $this->rawData['TotalItems'];
    }
}
