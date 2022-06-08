<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Parser;

interface StationsFeedParser
{
    public function parse(string $data): array;
}
