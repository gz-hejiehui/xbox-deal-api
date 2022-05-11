<?php

namespace GzHejiehui\XboxDealApi\Entity\ChannelList;

final class Item
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
     * @var string $itemType ;
     */
    public string $itemType;

    /**
     * @var float $predictedScore ;
     */
    public float $predictedScore;

    /**
     * @var string $trackingId
     */
    public string $trackingId;

    /**
     * ChannelListItem constructor.
     *
     * @param array $rawData
     */
    public function __construct(array $rawData)
    {
        $this->rawData = $rawData;
        $this->parse();
    }

    /**
     * Parse raw data.
     */
    private function parse(): void
    {
        // Initialize literal properties
        $this->id = $this->rawData['Id'];
        $this->itemType = $this->rawData['ItemType'];
        $this->predictedScore = $this->rawData['PredictedScore'];
        $this->trackingId = $this->rawData['TrackingId'];
    }
}
