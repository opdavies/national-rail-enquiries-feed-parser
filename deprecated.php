<?php

declare(strict_types=1);

/*
 * Backward compatibility aliases for classes moved in vX.
 * These can be removed in the next major release.
 */

class_alias(
    \Opdavies\NationalRailEnquriesFeedParser\AbstractStationParser::class,
    \Opdavies\NationalRailEnquriesFeedParser\Parser\AbstractStationParser::class
);

class_alias(
    \Opdavies\NationalRailEnquriesFeedParser\Station::class,
    \Opdavies\NationalRailEnquriesFeedParser\Model\Station::class
);

class_alias(
    \Opdavies\NationalRailEnquriesFeedParser\StationAddress::class,
    \Opdavies\NationalRailEnquriesFeedParser\DataTransferObject\StationAddress::class
);

class_alias(
    \Opdavies\NationalRailEnquriesFeedParser\StationCollection::class,
    \Opdavies\NationalRailEnquriesFeedParser\Collection\StationCollection::class
);

class_alias(
    \Opdavies\NationalRailEnquriesFeedParser\StationSerializer::class,
    \Opdavies\NationalRailEnquriesFeedParser\Serializer\StationSerializer::class
);

class_alias(
    \Opdavies\NationalRailEnquriesFeedParser\StationsFeedParser::class,
    \Opdavies\NationalRailEnquriesFeedParser\Parser\StationsFeedParser::class
);

class_alias(
    \Opdavies\NationalRailEnquriesFeedParser\StationsJsonFeedParser::class,
    \Opdavies\NationalRailEnquriesFeedParser\Parser\StationsJsonFeedParser::class
);

class_alias(
    \Opdavies\NationalRailEnquriesFeedParser\StationsXmlFeedParser::class,
    \Opdavies\NationalRailEnquriesFeedParser\Parser\StationsXmlFeedParser::class
);
