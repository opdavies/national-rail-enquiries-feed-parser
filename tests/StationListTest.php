<?php

use Opdavies\NationalRailEnquriesFeedParser\Model\Station;
use Opdavies\NationalRailEnquriesFeedParser\Parser\StationsXmlParser;

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

    $parser = new StationsXmlParser();

    $stations = $parser->parse($data);

    expect($stations)
        ->toHaveCount(5)
        ->each->toBeInstanceOf(Station::class)
        ;
});

it('parses an empty list of stations', function () {
    $parser = new StationsXmlParser();

    $stations = $parser->parse('');

    expect($stations)->toBeEmpty();
});
