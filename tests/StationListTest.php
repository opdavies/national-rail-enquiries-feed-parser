<?php

use Opdavies\NationalRailEnquriesFeedParser\Model\Station;
use Opdavies\NationalRailEnquriesFeedParser\Parser\StationsXmlFeedParser;

it('parses a list of stations', function () {
    $data = <<<EOF
        <StationsList>
            <Station></Station>
            <Station></Station>
            <Station></Station>
            <Station></Station>
            <Station></Station>
        </StationsList>
    EOF;

    $parser = new StationsXmlFeedParser();

    $stations = $parser->parseStationList($data);

    expect($stations)
        ->toHaveCount(5)
        ->each->toBeInstanceOf(Station::class)
        ;
});

it('parses an empty list of stations', function () {
    $parser = new StationsXmlFeedParser();

    $stations = $parser->parseStationList('');

    expect($stations)->toBeEmpty();
});
