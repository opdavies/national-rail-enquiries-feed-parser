<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Parser;

interface StationsFeedParser
{
    /**
     * @return array<string,mixed>
     */
    public function parseStationList(string $data): array;
}
