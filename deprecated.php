<?php

declare(strict_types=1);

/*
 * Backward compatibility aliases for classes moved in vX.
 * These can be removed in the next major release.
 */

$map = [
    'AbstractStationParser' => 'Parser',
    'Station' => 'Model',
    'StationAddress' => 'DataTransferObject',
    'StationCollection' => 'Collection',
    'StationSerializer' => 'Serializer',
    'StationsFeedParser' => 'Parser',
    'StationsJsonFeedParser' => 'Parser',
    'StationsXmlFeedParser' => 'Parser',
];

foreach ($map as $class => $subNamespace) {
    class_alias(
        "Opdavies\\NationalRailEnquriesFeedParser\\{$class}",
        "Opdavies\\NationalRailEnquriesFeedParser\\{$subNamespace}\\{$class}"
    );
}
