<?php

use Opdavies\NationalRailEnquriesFeedParser\Model\Station;
use Opdavies\NationalRailEnquriesFeedParser\Parser\StationsJsonFeedParser;
use Symfony\Component\Validator\Exception\ValidationFailedException;

it('parses a list of stations from JSON', function () {
    $data = <<<EOF
    [
        { "CrsCode": "CDF", "Name": "Cardiff Central" },
        { "CrsCode": "CDF", "Name": "Cardiff Central" },
        { "CrsCode": "CDF", "Name": "Cardiff Central" },
        { "CrsCode": "CDF", "Name": "Cardiff Central" },
        { "CrsCode": "CDF", "Name": "Cardiff Central" }
    ]
    EOF;

    $parser = new StationsJsonFeedParser();

    $stations = $parser->parseStationList($data);

    expect($stations)
        ->toHaveCount(5)
        ->each->toBeInstanceOf(Station::class)
        ;
});

it('parses an empty list of stations from JSON', function () {
    $parser = new StationsJsonFeedParser();

    $stations = $parser->parseStationList('[]');

    expect($stations)->toBeEmpty();
});

it('parses a single station from JSON', function () {
    $data = <<<EOF
    {
      "Accessibility": {
        "Helpline": {
          "com_Annotation": {
            "com_Note": "<p>Test.</p>"
          }
        }
      },
      "CrsCode": "CDF",
      "Name": "Cardiff Central"
    }
    EOF;

    $parser = new StationsJsonFeedParser();

    $station = $parser->parseStation($data);

    expect($station)->toBeInstanceOf(Station::class);

    expect($station->getAssistedTravelText())->toBe('<p>Test.</p>');
    expect($station->getCrsCode())->toBe('CDF');
    expect($station->getName())->toBe('Cardiff Central');
});

it('throws an exception if the CRS code is too short', function () {
    $data = '{ "CrsCode": "AA", "Name": "::Name::" }';

    $parser = new StationsJsonFeedParser();

    $parser->parseStation($data);
})->throws(ValidationFailedException::class);

it('throws an exception if the CRS code is too long', function () {
    $data = '{ "CrsCode": "AAAA", "Name": "::Name::" }';

    $parser = new StationsJsonFeedParser();

    $parser->parseStation($data);
})->throws(ValidationFailedException::class);

it('throws an exception if the CRS code contains invalid characters', function () {
    $data = '{ "CrsCode": "123", "Name": "::Name::" }';

    $parser = new StationsJsonFeedParser();

    $parser->parseStation($data);
})->throws(ValidationFailedException::class);
