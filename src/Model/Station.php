<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Model;

final class Station
{
    /**
     * @var array<string,mixed>
     */
    private array $Accessibility;

    private string $CrsCode;

    private string $Name;

    public function getAssistedTravelText(): string
    {
        return $this->Accessibility['Helpline']['com_Annotation']['com_Note'];
    }

    public function getCrsCode(): string
    {
        return $this->CrsCode;
    }

    public function getName(): string
    {
        return $this->Name;
    }

    /**
     * @param array<string,mixed> $values
     */
    public function setAccessibility(array $values): void
    {
        $this->Accessibility = $values;
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
