<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser;

use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractStationParser implements StationsFeedParser
{
    protected SerializerInterface $serializer;

    public function __construct()
    {
        $this->serializer = new StationSerializer();
    }
}
