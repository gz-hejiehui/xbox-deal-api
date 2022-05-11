<?php

namespace GzHejiehui\XboxDealApi\Entity;

use GzHejiehui\XboxDealApi\Entity\ChannelList\Item;
use GzHejiehui\XboxDealApi\Entity\ChannelList\PagingInfo;

final class ChannelList
{
    /**
     * @var array $rawData
     */
    private array $rawData;

    /**
     * @var string $id
     */
    public string $id;

    /**
     * @var string $name
     */
    public string $name;

    /**
     * @var string
     */
    public string $version;

    /**
     * @var string $continuationToken
     */
    public string $continuationToken;

    /**
     * @var string $title
     */
    public string $title;

    /**
     * @var string $longTitle
     */
    public string $longTitle;

    /**
     * @var string $status
     */
    public string $status;

    /**
     * @var string $details
     */
    public string $details;

    /**
     * @var Item[]
     */
    public array $items;

    /**
     * @var PagingInfo $pagingInfo
     */
    public PagingInfo $pagingInfo;

    /**
     * ChannelList constructor.
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
        // Initialize literal properties
        $this->id = $this->rawData['Id'];
        $this->name = $this->rawData['Name'];
        $this->version = $this->rawData['Version'];
        $this->continuationToken = $this->rawData['ContinuationToken'];
        $this->title = $this->rawData['Title'];
        $this->longTitle = $this->rawData['LongTitle'];
        $this->status = $this->rawData['Status'];
        $this->details = $this->rawData['Details'] ?? '';

        // Initialize items
        $this->items = array_map(fn($item) => new Item($item), $this->rawData['Items']);

        // Initialize paging info
        $this->pagingInfo = new PagingInfo($this->rawData['PagingInfo']);
    }
}
