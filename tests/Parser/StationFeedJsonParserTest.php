<?php

use Opdavies\NationalRailEnquriesFeedParser\Model\Station;
use Opdavies\NationalRailEnquriesFeedParser\Parser\StationsJsonFeedParser;

it('parses a list of stations from JSON', function () {
    $data = <<<EOF
    [
        {},
        {},
        {},
        {},
        {}
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
      "CrsCode": [ { "0": "CDF" } ],
      "Name": [ { "0": "Cardiff Central" } ]
    }
    EOF;

    $parser = new StationsJsonFeedParser();

    $station = $parser->parseStation($data);

    expect($station)->toBeInstanceOf(Station::class);

    expect($station->getAssistedTravelText())->toBe('<p>Test.</p>');
    expect($station->getCrsCode())->toBe('CDF');
    expect($station->getName())->toBe('Cardiff Central');
});
