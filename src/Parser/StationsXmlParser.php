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

final class StationsXmlParser
{
    public function parse(string $data): array
    {
        try {
            Assert::stringNotEmpty($data);
        } catch (InvalidArgumentException $e) {
            return [];
        }

        $xml = simplexml_load_string($data);

        $stations = [];

        foreach ($xml->Station as $station) {
            $stations[] = $station;
        }

        $serializer = new Serializer(
            [new ObjectNormalizer(), new PropertyNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );

        return $serializer->deserialize(json_encode($stations), Station::class . '[]', 'json');
    }
}
