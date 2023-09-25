<?php

use Opdavies\NationalRailEnquriesFeedParser\Model\Station;
use Opdavies\NationalRailEnquriesFeedParser\Parser\StationsJsonFeedParser;
use Symfony\Component\Validator\Exception\ValidationFailedException;

beforeEach(function () {
    $this->parser = new StationsJsonFeedParser();
});

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
        ->each->toBeInstanceOf(Station::class);
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

it("returns the postcode for a station", function () {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.json');

    $station = $this->parser->parseStation($data);

    expect($station->getPostcode())->toBe('CF83 1AQ');
});

it('returns the ticket office closing time for a station where days are set as MondayToFriday', function () {
    $data = file_get_contents(__DIR__.'/../stubs/NWP.json');

    $station = $this->parser->parseStation($data);

    expect($station->getClosingTime(day: 'Monday'))->toBe('20:00');
    expect($station->getClosingTime(day: 'Tuesday'))->toBe('20:00');
    expect($station->getClosingTime(day: 'Wednesday'))->toBe('20:00');
    expect($station->getClosingTime(day: 'Thursday'))->toBe('20:00');
    expect($station->getClosingTime(day: 'Friday'))->toBe('20:00');

    expect($station->getClosingTime(day: 'Saturday'))->toBe('20:30');
    expect($station->getClosingTime(day: 'Sunday'))->toBe('19:45');
});

it('returns the ticket office closing time for a station where days are defined as different days', function () {
    $json = file_get_contents(__DIR__.'/../stubs/TRF.json');

    $station = $this->parser->parseStation($json);

    expect($station->getClosingTime(day: 'Monday'))->toBe('13:00');
    expect($station->getClosingTime(day: 'Tuesday'))->toBe('13:00');
    expect($station->getClosingTime(day: 'Wednesday'))->toBe('13:00');
    expect($station->getClosingTime(day: 'Thursday'))->toBe('13:00');
    expect($station->getClosingTime(day: 'Friday'))->toBe('13:00');
    expect($station->getClosingTime(day: 'Saturday'))->toBe('13:00');

    expect($station->getClosingTime(day: 'Sunday'))->toBeNull();
});

it('returns null if a station does not have a ticket office', function() {
    $data = <<<EOF
      {
        "CrsCode": "TRE",
        "Name": "Trefforest Estate",
        "Fares": {
          "TicketOffice": {
            "Available": false
          }
        }
      }
    EOF;

    $station = $this->parser->parseStation($data);

    expect($station->getClosingTime(day: 'Monday'))->toBeNull();
    expect($station->getClosingTime(day: 'Tuesday'))->toBeNull();
    expect($station->getClosingTime(day: 'Wednesday'))->toBeNull();
    expect($station->getClosingTime(day: 'Thursday'))->toBeNull();
    expect($station->getClosingTime(day: 'Friday'))->toBeNull();
    expect($station->getClosingTime(day: 'Saturday'))->toBeNull();
    expect($station->getClosingTime(day: 'Sunday'))->toBeNull();
});
