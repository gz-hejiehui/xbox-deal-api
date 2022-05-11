<?php

namespace GzHejiehui\XboxDealApi;

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
     * ChannelList constructor.
     *
     * @param array $rawData
     */
    public function __construct(array $rawData)
    {
        $this->rawData = $rawData;
    }

    /**
     * parse raw data to properties
     */
    private function parse(): void
    {
        $this->id = $this->rawData['Id'];
        $this->name = $this->rawData['Name'];
        $this->version = $this->rawData['Version'];
        $this->continuationToken = $this->rawData['ContinuationToken'];
        $this->title = $this->rawData['Title'];
        $this->longTitle = $this->rawData['LongTitle'];
        $this->status = $this->rawData['Status'];
        $this->details = $this->rawData['Details'] ?: '';
    }
}
