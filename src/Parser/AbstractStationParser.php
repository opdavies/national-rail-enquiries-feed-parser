<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Parser;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

abstract class AbstractStationParser implements StationsFeedParser
{
    protected SerializerInterface $serializer;

    public function __construct()
    {
        $this->serializer = new Serializer(
            [new ObjectNormalizer(), new PropertyNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );
    }
}
