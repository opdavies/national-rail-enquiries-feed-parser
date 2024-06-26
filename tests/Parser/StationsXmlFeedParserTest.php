<?php

use Opdavies\NationalRailEnquriesFeedParser\DataTransferObject\StationAddress;
use Opdavies\NationalRailEnquriesFeedParser\Model\Station;
use Opdavies\NationalRailEnquriesFeedParser\Parser\StationsXmlFeedParser;
use Symfony\Component\Validator\Exception\ValidationFailedException;

beforeEach(function () {
    $this->parser = new StationsXmlFeedParser();
});

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

    $stations = $this->parser->parseStationList($data);

    expect($stations)
        ->toHaveCount(5)
        ->each->toBeInstanceOf(Station::class);
});

it('parses an empty list of stations from XML', function () {
    $stations = $this->parser->parseStationList('');

    expect($stations)->toBeEmpty();
});

it('parses a single station from XML', function () {
    $data = file_get_contents(__DIR__.'/../stubs/CDF.xml');

    $station = $this->parser->parseStation($data);

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

    $this->parser->parseStation($data);
})->throws(ValidationFailedException::class);

it('throws an exception if the CRS code is too long', function () {
    $data = <<<EOF
        <Station>
            <CrsCode>AAAA</CrsCode>
            <Name>::Name::</Name>
        </Station>
    EOF;

    $this->parser->parseStation($data);
})->throws(ValidationFailedException::class);

it('throws an exception if the CRS code contains invalid characters', function () {
    $data = <<<EOF
        <Station>
            <CrsCode>123</CrsCode>
            <Name>::Name::</Name>
        </Station>
    EOF;

    $this->parser->parseStation($data);
})->throws(ValidationFailedException::class);

it("returns a 5 line address for a station", function () {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    $address = $station->getAddress();

    expect($address)->toBeInstanceOf(StationAddress::class);
    expect($address->line1)->toBe('Aber station');
    expect($address->line2)->toBe('Nantgarw Road');
    expect($address->line3)->toBe('Aber');
    expect($address->line4)->toBe('Caerphilly');
    expect($address->postcode)->toBe('CF83 1AQ');
});

it("returns the postcode for a station", function () {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getPostcode())->toBe('CF83 1AQ');
});

it('returns the InformationServicesOpen text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getInformationServicesOpenText())
        ->toBe('Information available during ticket office opening times.');
});

it('returns the SmartcardComments text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getSmartcardComments())
        ->toBe('<p>Load a pre-purchased season ticket onto a smartcard using the smartcard validator.</p>');
});

it('returns the PassengerServices CustomerService text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getPassengerServicesCustomerServiceText())
        ->toBe('<p>Contact our Customer Relations team directly via <a href="https://tfw.wales/help-and-contact/rail/contact-us">the Transport for Wales Website.</a></p>');
});

it('returns the WiFi text from station facilities', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getWiFiText())
        ->toBe('<p><a href="https://www.btwifi.co.uk/find/" target="_blank" rel="nofollow">Find WiFi Hotspots around Aber station</a></p>');
});

it('returns the station alert', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getStationAlert())
        ->toBe('<p>The taxi rank is located on Penarth Road, under the railway bridge.   </p><p>When exiting the main station entrance (Central Square), turn right and right again under the railway bridge by Viva Brazil.</p><p><a href="https://tfw.wales/places/stations/cardiff-central" title="">F</a><a href="https://urldefense.com/v3/__https:/tfw.wales/places/stations/cardiff-central__;!!KArG4XNCWg!iASOnDudY6nhSAhEwNdGI351bRwpr9LJVlf44jehWS2Guc1Oad24A3Yy7oriXIYPe7YtSbQK36OBE_o68myzABMBUaMpEuEnXw$" title="">or further information click here and s</a><a href="https://urldefense.com/v3/__https://tfw.wales/places/stations/cardiff-central__;!!KArG4XNCWg!iASOnDudY6nhSAhEwNdGI351bRwpr9LJVlf44jehWS2Guc1Oad24A3Yy7oriXIYPe7YtSbQK36OBE_o68myzABMBUaMpEuEnXw$" title="">croll to "Cardiff Central Station taxi rank relocation"</a><a href="https://urldefense.com/v3/__https:/tfw.wales/places/stations/cardiff-central__;!!KArG4XNCWg!iASOnDudY6nhSAhEwNdGI351bRwpr9LJVlf44jehWS2Guc1Oad24A3Yy7oriXIYPe7YtSbQK36OBE_o68myzABMBUaMpEuEnXw$" title="">.</a></p>');
});

it('returns the airport text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getAirportText())
        ->toBe('<p>The T9 Airport Express coach service departs from the bus stop at the rear of the railway station.</p><p>The full timetable can be found <a href="http://www.trawscymru.info/t9/" title="">http://www.trawscymru.info/t9/</a>.  The journey time is 40 minutes.</p>');
});

it('returns the OnwardTravelText from the Interchange section', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getOnwardTravelText())
        ->toBe('<p>There is currently no central bus station.  Bus services depart and arrive at stops around the city centre.  Click on the link to see <a href="http://www.cardiffbus.com/english/servicelisting.shtml#_subnav01" title="">a list of routes and timetables</a></p><p>Buy a Cardiff <em><strong>PlusBus</strong></em> ticket with your train ticket for discount-priced unlimited bus travel around the town. For details visit <a href="http://www.PlusBus.info" title="">www.PlusBus.info</a></p>');
});

it('returns the TaxiRank text from the Interchange section', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getTaxiRankText())
        ->toBe('<p>From Tuesday 20 September 2022, the taxi rank is located on Penarth Road, under the railway bridge.   </p><p>When exiting the main station entrance (Central Square), turn right and right again under the railway bridge by Viva Brazil.</p><p><a href="https://tfw.wales/places/stations/cardiff-central" title="">F</a><a href="https://urldefense.com/v3/__https:/tfw.wales/places/stations/cardiff-central__;!!KArG4XNCWg!iASOnDudY6nhSAhEwNdGI351bRwpr9LJVlf44jehWS2Guc1Oad24A3Yy7oriXIYPe7YtSbQK36OBE_o68myzABMBUaMpEuEnXw$" title="">or further information click here and s</a><a href="https://urldefense.com/v3/__https://tfw.wales/places/stations/cardiff-central__;!!KArG4XNCWg!iASOnDudY6nhSAhEwNdGI351bRwpr9LJVlf44jehWS2Guc1Oad24A3Yy7oriXIYPe7YtSbQK36OBE_o68myzABMBUaMpEuEnXw$" title="">croll to "Cardiff Central Station taxi rank relocation"</a><a href="https://urldefense.com/v3/__https:/tfw.wales/places/stations/cardiff-central__;!!KArG4XNCWg!iASOnDudY6nhSAhEwNdGI351bRwpr9LJVlf44jehWS2Guc1Oad24A3Yy7oriXIYPe7YtSbQK36OBE_o68myzABMBUaMpEuEnXw$" title="">.</a></p>');
});

it('returns the rail replacement services text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getRailReplacementServicesText())
        ->toBe('<p>The rail replacement bus stop is at the rear car park (Penarth Road entrance).</p>');
});

it('returns the StaffHelpAvailable text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getStaffHelpAvailableText())
        ->toBe('<p>Monday to Friday 04:00 to 01:00</p><p>Saturday 04:00 to 00:30</p><p>Sunday 07:00 to 00:30</p>');
});

it('returns the accessibility helpline text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getAccessibilityHelplineText())
        ->toBe('<p>We want everyone to travel with confidence. That is why, if you are planning on travelling on national rail services, you can request an assistance booking in advance - now up to 2 hours before your journey is due to start, any time of the day. For more information about Passenger Assist and how to request an assistance booking via Passenger Assist, please <a href="https://www.nationalrail.co.uk/stations_destinations/passenger-assist.aspx" title="">click here</a>.</p>');
});

it('returns the AccessiblePublicTelephones text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getAccessiblePublicTelephonesText())
        ->toBe('<p>There are four payphones in the concourse and one each on platforms 1/2, 3/4 and 6/7.</p>');
});

it('returns the NationalKeyToilets text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getNationalKeyToiletsText())
        ->toBe('<p>The National Key/Accessible toilets are located in the East Subway near the lifts and on Platform 8; these toilets are operated by a RADAR key and are only available during staffing hours.</p>');
});

it('returns the StepFreeAccess text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getStepFreeAccessText())
        ->toBe('<p>Category A.</p><p>Step free access is available to Platforms 0 to 8.</p>');
});

it('returns the TicketGates text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getTicketGatesText())
        ->toBe('<p>Accessible gate available at each set of ticket gates</p>');
});

it('returns the ticket office location text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getTicketOfficeLocationText())
        ->toBe('<p>At the Penarth Road entrance and on the concourse.</p>');
});

it('returns the cycle storage text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getCycleStorageAnnotationText())
        ->toBe('<p>Sheltered stands are available on each platform.</p>');

    expect($station->getCycleStorageLocationText())
        ->toBe('<p>East end of platforms 1 and 2, 3 and 4, 6 and 7 - also at the front and rear of the station.</p>');
});

it('returns the station buffet text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getStationBuffetText())
        ->toBe('<p>Cold drinks vending machine.</p><p>Hot drinks vending machine.</p><p>Food vending machine.</p><p>Food outlet (Seating available).</p>');
});

it('returns the first class lounge text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getFirstClassLoungeText())
        ->toBe('<p>Located on Platform 1 </p><p>All First Class tickets accepted.</p><p>A comfortable modern lounge, with information screens, complimentary refreshments and a dedicated customer host ready to serve you. </p><p>Wi-Fi is available.</p>');
});

it('returns the postbox location text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getPostBoxText())
        ->toBe('<p>At the Penarth Road entrance and also in the main concourse.</p>');
});

it('returns the ATM machine location text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getAtmMachineLocationText())
        ->toBe('<p>Located outside the main entrance.</p>');
});

it('returns the shops text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getShopsText())
        ->toBe('<p>News agent and convenience store</p>');
});

it('returns the toilets location text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getToiletsLocationText())
        ->toBe('<p>The toilets are located on Platforms 1 to 8. The National Key toilets are located in the East Subway near the lifts and on Platform 8; these toilets are operated by a radar key and are only available during staffing hours.</p>');
});

it('returns the waiting room open and location text', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getWaitingRoomOpenText())->toBe('<p>Closed until further notice.</p>');
    expect($station->getWaitingRoomLocationText())->toBe('<p>On platforms 1/2, 3/4, 6/7 and 8.</p>');
});

it('returns the name and operator name for a single car park', function() {
    $data = file_get_contents(__DIR__.'/../stubs/ABE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getCarParkName())->toBe('Penarth Road');
    expect($station->getCarParkOperatorName())->toBe('APCOA');
});

test('some 5 line addresses have only four lines', function() {
    $data = file_get_contents(__DIR__.'/../stubs/WRE.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getAddress()->line1)->toBe('Wrexham General Station');
    expect($station->getAddress()->line2)->toBe('Station Approach');
    expect($station->getAddress()->line3)->toBe('Wrexham');
    expect($station->getAddress()->line4)->toBeNull();
    expect($station->getAddress()->postcode)->toBe('LL11 2AA');
});

test('some 5 line addresses have only three lines', function() {
    $data = file_get_contents(__DIR__.'/../stubs/LEV.xml');

    $station = $this->parser->parseStation($data);

    expect($station->getAddress()->line1)->toBe('Leven Station');
    expect($station->getAddress()->line2)->toBe('Leven');
    expect($station->getAddress()->line3)->toBeNull();
    expect($station->getAddress()->line4)->toBeNull();
    expect($station->getAddress()->postcode)->toBe('KY8 4LQ');
});

it('returns a null value for text values if they are not present', function() {
    $data = <<<EOF
        <Station>
            <CrsCode>CDF</CrsCode>
            <Name>Cardiff Central</Name>
        </Station>
    EOF;

    $station = $this->parser->parseStation($data);

    expect($station)->toBeInstanceOf(Station::class);

    expect($station->getAccessiblePublicTelephonesText())->toBeNull();
    expect($station->getAccessibilityHelplineText())->toBeNull();
    expect($station->getAirportText())->toBeNull();
    expect($station->getAtmMachineLocationText())->toBeNull();
    expect($station->getAssistedTravelText())->toBeNull();
    expect($station->getCarParkName())->toBeNull();
    expect($station->getCarParkOperatorName())->toBeNull();
    expect($station->getCycleStorageAnnotationText())->toBeNull();
    expect($station->getCycleStorageLocationText())->toBeNull();
    expect($station->getFirstClassLoungeText())->toBeNull();
    expect($station->getInformationServicesOpenText())->toBeNull();
    expect($station->getNationalKeyToiletsText())->toBeNull();
    expect($station->getOnwardTravelText())->toBeNull();
    expect($station->getPassengerServicesCustomerServiceText())->toBeNull();
    expect($station->getPostBoxText())->toBeNull();
    expect($station->getRailReplacementServicesText())->toBeNull();
    expect($station->getShopsText())->toBeNull();
    expect($station->getSmartcardComments())->toBeNull();
    expect($station->getStaffHelpAvailableText())->toBeNull();
    expect($station->getStationAlert())->toBeNull();
    expect($station->getStationBuffetText())->toBeNull();
    expect($station->getStepFreeAccessText())->toBeNull();
    expect($station->getTaxiRankText())->toBeNull();
    expect($station->getTicketGatesText())->toBeNull();
    expect($station->getTicketOfficeLocationText())->toBeNull();
    expect($station->getToiletsLocationText())->toBeNull();
    expect($station->getWaitingRoomLocationText())->toBeNull();
    expect($station->getWaitingRoomOpenText())->toBeNull();
    expect($station->getWiFiText())->toBeNull();
});

it('returns the ticket office closing time for a station where days are set as MondayToFriday', function () {
    $data = file_get_contents(__DIR__.'/../stubs/NWP.xml');

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
    $xml = file_get_contents(__DIR__.'/../stubs/TRF.xml');

    $station = $this->parser->parseStation($xml);

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
        <Station>
            <CrsCode>TRE</CrsCode>
            <Name>Trefforest Estate</Name>
            <Fares>
                <TicketOffice>
                    <com:Available>false</com:Available>
                </TicketOffice>
            </Fares>
        </Station>
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
