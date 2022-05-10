<?php

namespace GzHejiehui\XboxDealApi\Endpoint;

interface EndpointInterface
{
    /**
     * Fetch the result from the API.
     *
     * @return mixed
     */
    function fetch();

    /**
     * Fetch the raw data from the API
     *
     * @return string
     */
    function fetchRaw(): string;
}
