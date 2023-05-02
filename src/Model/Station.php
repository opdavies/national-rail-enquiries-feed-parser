<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Model;

use Illuminate\Support\Arr;
use Opdavies\NationalRailEnquriesFeedParser\DataTransferObject\StationAddress;
use Symfony\Component\Validator\Constraints as Assert;

final class Station
{
    /**
     * @var array<int,string>
     */
    private array $address;

    /**
     * @var array<string,mixed>
     */
    private array $Accessibility;

    /**
     * @Assert\Regex("/^[A-Z]{3}$/")
     */
    private string $CrsCode;

    /**
     * @Assert\NotBlank
     */
    private string $Name;

    public function getAddress(): StationAddress {
        /** @var array<int,string> */
        $addressLines = [
            ...Arr::get($this->address, 'com:PostalAddress.add:A_5LineAddress.add:Line'),
            Arr::get($this->address, 'com:PostalAddress.add:A_5LineAddress.add:PostCode'),
        ];

        return new StationAddress(...$addressLines);
    }

    public function getAssistedTravelText(): ?string
    {
        return dot($this->Accessibility)->get('Helpline.com_Annotation.com_Note');
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

    /**
     * @param array<int,string> $address
     */
    public function setAddress(array $address): void
    {
        $this->address = $address;
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
