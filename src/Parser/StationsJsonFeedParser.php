<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Parser;

use Opdavies\NationalRailEnquriesFeedParser\Model\Station;
use Webmozart\Assert\Assert;
use Webmozart\Assert\InvalidArgumentException;

final class StationsJsonFeedParser extends AbstractStationParser
{
    public function parseStation(string $data): ?Station
    {
        try {
            Assert::stringNotEmpty($data);
        } catch (InvalidArgumentException $e) {
            return null;
        }

        return $this->serializer->deserialize($data, Station::class, 'json');
    }

    public function parseStationList(string $data): array
    {
        try {
            Assert::stringNotEmpty($data);
        } catch (InvalidArgumentException $e) {
            return [];
        }

        return $this->serializer->deserialize($data, Station::class . '[]', 'json');
    }
}
