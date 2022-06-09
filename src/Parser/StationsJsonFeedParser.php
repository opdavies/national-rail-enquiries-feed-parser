<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Parser;

use Opdavies\NationalRailEnquriesFeedParser\Model\Station;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
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

        $serializer = new Serializer(
            [new ObjectNormalizer(), new PropertyNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        return $serializer->deserialize($data, Station::class, 'json');
    }

    public function parseStationList(string $data): array
    {
        try {
            Assert::stringNotEmpty($data);
        } catch (InvalidArgumentException $e) {
            return [];
        }

        $serializer = new Serializer(
            [new ObjectNormalizer(), new PropertyNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        return $serializer->deserialize($data, Station::class . '[]', 'json');
    }
}
