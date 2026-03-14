<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser;

interface StationsFeedParser
{
    public function parseStation(string $data): ?Station;

    /**
     * @return StationCollection<int,Station>
     */
    public function parseStationList(string $data): StationCollection;
}
