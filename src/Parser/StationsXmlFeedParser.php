<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Parser;

use Opdavies\NationalRailEnquriesFeedParser\Model\Station;
use Opdavies\NationalRailEnquriesFeedParser\Serializer\StationSerializer;
use Webmozart\Assert\Assert;
use Webmozart\Assert\InvalidArgumentException;

final class StationsXmlFeedParser implements StationsFeedParser
{
    public function parseStation(string $data): ?Station
    {
        try {
            Assert::stringNotEmpty($data);
        } catch (InvalidArgumentException $e) {
            return null;
        }

        $xml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);

        $serializer = new StationSerializer();

        return $serializer->deserialize(json_encode($xml), Station::class, 'json');
    }

    public function parseStationList(string $data): array
    {
        try {
            Assert::stringNotEmpty($data);
        } catch (InvalidArgumentException $e) {
            return [];
        }

        $xml = simplexml_load_string($data, 'SimpleXMLElement', LIBXML_NOCDATA);

        $stations = [];

        foreach ($xml->Station as $station) {
            $stations[] = $station;
        }

        $serializer = new StationSerializer();

        return $serializer->deserialize(json_encode($stations), Station::class . '[]', 'json');
    }
}
