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

it('parses a single station', function () {
    $data = <<<EOF
        <Station>
            <Accessibility>
                <Helpline>
                    <com_Annotation>
                        <com_Note><![CDATA[<p>Test.</p>]]></com_Note>
                    </com_Annotation>
                </Helpline>
            </Accessibility>
            <CrsCode>CDF</CrsCode>
            <Name>Cardiff Central</Name>
        </Station>
    EOF;

    $parser = new StationsXmlFeedParser();

    $station = $parser->parseStation($data);

    expect($station)->toBeInstanceOf(Station::class);

    expect($station->getAssistedTravelText())->toBe('<p>Test.</p>');
    expect($station->getCrsCode())->toBe('CDF');
    expect($station->getName())->toBe('Cardiff Central');
});
