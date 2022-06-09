<?php

use Opdavies\NationalRailEnquriesFeedParser\Model\Station;
use Opdavies\NationalRailEnquriesFeedParser\Parser\StationsXmlFeedParser;

it('returns the station information', function () {
    $data = <<<EOF
        <StationList>
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
        </StationList>
    EOF;

    $parser = new StationsXmlFeedParser();

    $stations = $parser->parseStationList($data);
    $station = $stations[0];

    expect($station)->toBeInstanceOf(Station::class);

    expect($station->getAssistedTravelText())->toBe('<p>Test.</p>');
    expect($station->getCrsCode())->toBe('CDF');
    expect($station->getName())->toBe('Cardiff Central');
});
