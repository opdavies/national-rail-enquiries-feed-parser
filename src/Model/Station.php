<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Model;

final class Station
{
    private string $CrsCode;

    private string $Name;

    public function getCrsCode(): string
    {
        return $this->CrsCode;
    }

    public function getName(): string
    {
        return $this->Name;
    }

    public function setCrsCode(string $crsCode): void
    {
        $this->CrsCode = $crsCode;
    }

    public function setName(string $name): void
    {
        $this->Name = $name;
    }
}
