<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Serializer;

use Opdavies\NationalRailEnquriesFeedParser\Model\Station;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

final class StationSerializer implements SerializerInterface
{
    private SerializerInterface $serializer;

    public function __construct()
    {
        $this->serializer = new Serializer(
            [new ObjectNormalizer(), new PropertyNormalizer(), new ArrayDenormalizer()],
            [new JsonEncoder()]
        );
    }

    public function serialize($data, string $format, array $context = []): string
    {
        return $this->serializer->serialize($data, $format, $context);
    }

    public function deserialize($data, string $type, string $format, array $context = [])
    {
        if ($type == Station::class) {
            $data = self::normalizeArrayValues($data);
        }

        return $this->serializer->deserialize($data, $type, $format, $context);
    }

    private static function normalizeArrayValues(string $data): string
    {
        $data = json_decode($data);

        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $data->{$key} = $value[0]->{0};
            }
        }

        return json_encode($data);
    }
}
