<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Serializer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\NameConverter\CamelCaseToSnakeCaseNameConverter;
use Symfony\Component\Serializer\Normalizer\ArrayDenormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\PropertyNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Exception\ValidationFailedException;
use Symfony\Component\Validator\Validation;

final class StationSerializer implements SerializerInterface
{
    private SerializerInterface $serializer;

    public function __construct()
    {
        $this->serializer = new Serializer(
            [
                new ObjectNormalizer(nameConverter: new CamelCaseToSnakeCaseNameConverter()),
                new PropertyNormalizer(),
                new ArrayDenormalizer(),
            ],
            [new JsonEncoder()]
        );
    }

    public function serialize(mixed $data, string $format, array $context = []): mixed
    {
        return $this->serializer->serialize($data, $format, $context);
    }

    public function deserialize(mixed $data, string $type, string $format, array $context = []): mixed
    {
        $station = $this->serializer->deserialize($data, $type, $format, $context);

        $validator = Validation::createValidatorBuilder()
            ->enableAnnotationMapping()
            ->getValidator();

        $violations = $validator->validate($station);

        if ($violations->count() > 0) {
            throw new ValidationFailedException('Validation failed.', $violations);
        }

        return $station;
    }
}
