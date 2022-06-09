<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Parser;

use Opdavies\NationalRailEnquriesFeedParser\Model\Station;

interface StationsFeedParser
{
    public function parseStation(string $data): ?Station;

    /**
     * @return array<string,mixed>
     */
    public function parseStationList(string $data): array;
}
