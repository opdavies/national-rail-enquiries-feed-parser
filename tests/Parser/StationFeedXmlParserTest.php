<?php

use Opdavies\NationalRailEnquriesFeedParser\Model\Station;
use Opdavies\NationalRailEnquriesFeedParser\Parser\StationsXmlFeedParser;
use Symfony\Component\Validator\Exception\ValidationFailedException;

it('parses a list of stations from XML', function () {
    $data = <<<EOF
        <StationList>
            <Station>
                <CrsCode>CDF</CrsCode>
                <Name>Cardiff Central</Name>
            </Station>
            <Station>
                <CrsCode>CDF</CrsCode>
                <Name>Cardiff Central</Name>
            </Station>
            <Station>
                <CrsCode>CDF</CrsCode>
                <Name>Cardiff Central</Name>
            </Station>
            <Station>
                <CrsCode>CDF</CrsCode>
                <Name>Cardiff Central</Name>
            </Station>
            <Station>
                <CrsCode>CDF</CrsCode>
                <Name>Cardiff Central</Name>
            </Station>
        </StationList>
    EOF;

    $parser = new StationsXmlFeedParser();

    $stations = $parser->parseStationList($data);

    expect($stations)
        ->toHaveCount(5)
        ->each->toBeInstanceOf(Station::class)
        ;
});

it('parses an empty list of stations from XML', function () {
    $parser = new StationsXmlFeedParser();

    $stations = $parser->parseStationList('');

    expect($stations)->toBeEmpty();
});

it('parses a single station from XML', function () {
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

it('throws an exception if the CRS code is too short', function () {
    $data = <<<EOF
        <Station>
            <CrsCode>12</CrsCode>
            <Name>::Name::</Name>
        </Station>
    EOF;

    $parser = new StationsXmlFeedParser();

    $parser->parseStation($data);
})->throws(ValidationFailedException::class);

it('throws an exception if the CRS code is too long', function () {
    $data = <<<EOF
        <Station>
            <CrsCode>1234</CrsCode>
            <Name>::Name::</Name>
        </Station>
    EOF;

    $parser = new StationsXmlFeedParser();

    $parser->parseStation($data);
})->throws(ValidationFailedException::class);
