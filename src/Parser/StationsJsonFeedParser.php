<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Parser;

use Opdavies\NationalRailEnquriesFeedParser\Model\Station;
use Opdavies\NationalRailEnquriesFeedParser\Serializer\StationSerializer;
use Webmozart\Assert\Assert;
use Webmozart\Assert\InvalidArgumentException;

final class StationsJsonFeedParser implements StationsFeedParser
{
    public function parseStation(string $data): ?Station
    {
        try {
            Assert::stringNotEmpty($data);
        } catch (InvalidArgumentException $e) {
            return null;
        }

        $serializer = new StationSerializer();

        return $serializer->deserialize($data, Station::class, 'json');
    }

    public function parseStationList(string $data): array
    {
        try {
            Assert::stringNotEmpty($data);
        } catch (InvalidArgumentException $e) {
            return [];
        }

        $serializer = new StationSerializer();

        return $serializer->deserialize($data, Station::class . '[]', 'json');
    }
}
