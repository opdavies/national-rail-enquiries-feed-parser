<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Parser;

interface StationsFeedParser
{
    /**
     * @return array<string,mixed>
     */
    public function parse(string $data): array;
}
