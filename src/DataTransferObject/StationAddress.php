<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\DataTransferObject;

final class StationAddress
{
    public function __construct(
        public string $line1,
        public string $line2,
        public string $line3,
        public string $line4,
        public string $postcode,
    ) {
    }
}
