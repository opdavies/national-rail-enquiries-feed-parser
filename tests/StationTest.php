<?php

use Opdavies\NationalRailEnquriesFeedParser\Model\Station;
use Opdavies\NationalRailEnquriesFeedParser\Parser\StationsXmlParser;

it('returns the station information', function () {
    $data = <<<EOF
        <StationList>
            <Station>
                <Name>Cardiff Central</Name>
                <CrsCode>CDF</CrsCode>
            </Station>
        </StationList>
    EOF;

    $parser = new StationsXmlParser();

    $stations = $parser->parse($data);
    $station = $stations[0];

    expect($station)->toBeInstanceOf(Station::class);

    expect($station->getCrsCode())->toBe('CDF');
    expect($station->getName())->toBe('Cardiff Central');
});
