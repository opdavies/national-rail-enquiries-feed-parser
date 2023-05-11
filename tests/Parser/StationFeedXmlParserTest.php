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

it('returns the SmartcardComments text', function() {
    $data = <<<EOF
        <Station>
            <Name>Aber</Name>
            <CrsCode>ABE</CrsCode>
            <Fares>
                <SmartcardComments>
                    <com:Note><![CDATA[<p>Load a pre-purchased season ticket onto a smartcard using the smartcard validator.</p>]]></com:Note>
                </SmartcardComments>
            </Fares>
        </Station>
    EOF;

    $parser = new StationsXmlFeedParser();

    $station = $parser->parseStation($data);

    expect($station->getSmartcardComments())
        ->toBe('<p>Load a pre-purchased season ticket onto a smartcard using the smartcard validator.</p>');
});

it('returns the PassengerServices CustomerService text', function() {
    $data = <<<EOF
    <Station>
        <Name>Aber</Name>
        <CrsCode>ABE</CrsCode>
        <PassengerServices>
          <CustomerService>
            <com:Annotation>
              <com:Note><![CDATA[<p>Contact our Customer Relations team directly via <a href="https://tfw.wales/help-and-contact/rail/contact-us">the Transport for Wales Website.</a></p>]]></com:Note>
            </com:Annotation>
          </CustomerService>
        </PassengerServices>
    </Station>
    EOF;

    $parser = new StationsXmlFeedParser();

    $station = $parser->parseStation($data);

    expect($station->getPassengerServicesCustomerServiceText())
        ->toBe('<p>Contact our Customer Relations team directly via <a href="https://tfw.wales/help-and-contact/rail/contact-us">the Transport for Wales Website.</a></p>');
});

it('returns the WiFi text from station facilities', function() {
    $data = <<<EOF
    <Station>
        <Name>Aber</Name>
        <CrsCode>ABE</CrsCode>
        <WiFi>
          <com:Annotation>
            <com:Note><![CDATA[<p><a href="https://www.btwifi.co.uk/find/" target="_blank" rel="nofollow">Find WiFi Hotspots around Aber station</a></p>]]></com:Note>
          </com:Annotation>
          <com:Available>false</com:Available>
        </WiFi>
    </Station>
    EOF;

    $parser = new StationsXmlFeedParser();

    $station = $parser->parseStation($data);

    expect($station->getWiFiText())
        ->toBe('<p><a href="https://www.btwifi.co.uk/find/" target="_blank" rel="nofollow">Find WiFi Hotspots around Aber station</a></p>');
});

it('returns the station alert', function() {
    $data = <<<EOF
        <Station>
            <Name>Aber</Name>
            <CrsCode>ABE</CrsCode>
            <StationAlerts>
              <AlertText><![CDATA[<p>The taxi rank is located on Penarth Road, under the railway bridge.   </p><p>When exiting the main station entrance (Central Square), turn right and right again under the railway bridge by Viva Brazil.</p><p><a href="https://tfw.wales/places/stations/cardiff-central" title="">F</a><a href="https://urldefense.com/v3/__https:/tfw.wales/places/stations/cardiff-central__;!!KArG4XNCWg!iASOnDudY6nhSAhEwNdGI351bRwpr9LJVlf44jehWS2Guc1Oad24A3Yy7oriXIYPe7YtSbQK36OBE_o68myzABMBUaMpEuEnXw$" title="">or further information click here and s</a><a href="https://urldefense.com/v3/__https://tfw.wales/places/stations/cardiff-central__;!!KArG4XNCWg!iASOnDudY6nhSAhEwNdGI351bRwpr9LJVlf44jehWS2Guc1Oad24A3Yy7oriXIYPe7YtSbQK36OBE_o68myzABMBUaMpEuEnXw$" title="">croll to "Cardiff Central Station taxi rank relocation"</a><a href="https://urldefense.com/v3/__https:/tfw.wales/places/stations/cardiff-central__;!!KArG4XNCWg!iASOnDudY6nhSAhEwNdGI351bRwpr9LJVlf44jehWS2Guc1Oad24A3Yy7oriXIYPe7YtSbQK36OBE_o68myzABMBUaMpEuEnXw$" title="">.</a></p>]]></AlertText>
            </StationAlerts>
        </Station>
    EOF;

    $parser = new StationsXmlFeedParser();

    $station = $parser->parseStation($data);

    expect($station->getStationAlert())
        ->toBe('<p>The taxi rank is located on Penarth Road, under the railway bridge.   </p><p>When exiting the main station entrance (Central Square), turn right and right again under the railway bridge by Viva Brazil.</p><p><a href="https://tfw.wales/places/stations/cardiff-central" title="">F</a><a href="https://urldefense.com/v3/__https:/tfw.wales/places/stations/cardiff-central__;!!KArG4XNCWg!iASOnDudY6nhSAhEwNdGI351bRwpr9LJVlf44jehWS2Guc1Oad24A3Yy7oriXIYPe7YtSbQK36OBE_o68myzABMBUaMpEuEnXw$" title="">or further information click here and s</a><a href="https://urldefense.com/v3/__https://tfw.wales/places/stations/cardiff-central__;!!KArG4XNCWg!iASOnDudY6nhSAhEwNdGI351bRwpr9LJVlf44jehWS2Guc1Oad24A3Yy7oriXIYPe7YtSbQK36OBE_o68myzABMBUaMpEuEnXw$" title="">croll to "Cardiff Central Station taxi rank relocation"</a><a href="https://urldefense.com/v3/__https:/tfw.wales/places/stations/cardiff-central__;!!KArG4XNCWg!iASOnDudY6nhSAhEwNdGI351bRwpr9LJVlf44jehWS2Guc1Oad24A3Yy7oriXIYPe7YtSbQK36OBE_o68myzABMBUaMpEuEnXw$" title="">.</a></p>');
});

it('returns the airport text', function() {
    $data = <<<EOF
        <Station>
            <Name>Aber</Name>
            <CrsCode>ABE</CrsCode>
            <Airport>
              <com:Annotation>
                <com:Note><![CDATA[<p>The T9 Airport Express coach service departs from the bus stop at the rear of the railway station.</p><p>The full timetable can be found <a href="http://www.trawscymru.info/t9/" title="">http://www.trawscymru.info/t9/</a>.  The journey time is 40 minutes.</p>]]></com:Note>
              </com:Annotation>
            </Airport>
        </Station>
    EOF;

    $parser = new StationsXmlFeedParser();

    $station = $parser->parseStation($data);

    expect($station->getAirportText())
        ->toBe('<p>The T9 Airport Express coach service departs from the bus stop at the rear of the railway station.</p><p>The full timetable can be found <a href="http://www.trawscymru.info/t9/" title="">http://www.trawscymru.info/t9/</a>.  The journey time is 40 minutes.</p>');
});
