<?php

use Opdavies\NationalRailEnquriesFeedParser\DataTransferObject\StationAddress;
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
        ->each->toBeInstanceOf(Station::class);
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
            <CrsCode>AA</CrsCode>
            <Name>::Name::</Name>
        </Station>
    EOF;

    $parser = new StationsXmlFeedParser();

    $parser->parseStation($data);
})->throws(ValidationFailedException::class);

it('throws an exception if the CRS code is too long', function () {
    $data = <<<EOF
        <Station>
            <CrsCode>AAAA</CrsCode>
            <Name>::Name::</Name>
        </Station>
    EOF;

    $parser = new StationsXmlFeedParser();

    $parser->parseStation($data);
})->throws(ValidationFailedException::class);

it('throws an exception if the CRS code contains invalid characters', function () {
    $data = <<<EOF
        <Station>
            <CrsCode>123</CrsCode>
            <Name>::Name::</Name>
        </Station>
    EOF;

    $parser = new StationsXmlFeedParser();

    $parser->parseStation($data);
})->throws(ValidationFailedException::class);

it("returns a 5 line address for a station", function () {
    $data = <<<EOF
        <Station>
            <Name>Aber</Name>
            <CrsCode>ABE</CrsCode>
            <Address>
              <com:PostalAddress>
                <add:A_5LineAddress>
                  <add:Line>Aber station</add:Line>
                  <add:Line>Nantgarw Road</add:Line>
                  <add:Line>Aber</add:Line>
                  <add:Line>Caerphilly</add:Line>
                  <add:PostCode>CF83 1AQ</add:PostCode>
                </add:A_5LineAddress>
              </com:PostalAddress>
            </Address>
        </Station>
    EOF;

    $parser = new StationsXmlFeedParser();

    $station = $parser->parseStation($data);

    $address = $station->getAddress();

    expect($address)->toBeInstanceOf(StationAddress::class);
    expect($address->line1)->toBe('Aber station');
    expect($address->line2)->toBe('Nantgarw Road');
    expect($address->line3)->toBe('Aber');
    expect($address->line4)->toBe('Caerphilly');
    expect($address->postcode)->toBe('CF83 1AQ');
});

it('returns the InformationServicesOpen text', function() {
    $data = <<<EOF
        <Station>
            <Name>Aber</Name>
            <CrsCode>ABE</CrsCode>
            <InformationSystems>
                <InformationAvailableFromStaff>-1</InformationAvailableFromStaff>
                <InformationServicesOpen>
                    <com:Annotation>
                        <com:Note><![CDATA[Information available during ticket office opening times.]]></com:Note>
                    </com:Annotation>
                </InformationServicesOpen>
            </InformationSystems>
        </Station>
    EOF;

    $parser = new StationsXmlFeedParser();

    $station = $parser->parseStation($data);

    expect($station->getInformationServicesOpenText())
        ->toBe('Information available during ticket office opening times.');
});
