<?php

declare(strict_types=1);

namespace Opdavies\NationalRailEnquriesFeedParser\Model;

use Opdavies\NationalRailEnquriesFeedParser\DataTransferObject\StationAddress;
use Symfony\Component\Validator\Constraints as Assert;

final class Station
{
    /**
     * @var array<int,string>
     */
    private array $address;

    /**
     * @var array<int,string>
     */
    private array $airport;

    /**
     * @var array<string,mixed>
     */
    private array $accessibility;

    /**
     * @Assert\Regex("/^[A-Z]{3}$/")
     */
    private string $crsCode;

    /**
     * @var array<string,mixed>
     */
    private array $fares;

    /**
     * @var array<string,string>
     */
    private array $informationSystems;

    /**
     * @var array<int,string>
     */
    public array $interchange;

    /**
     * @Assert\NotBlank
     */
    private string $name;

    /**
     * @var array<string,mixed>
     */
    private array $passengerServices;

    /**
     * @var array<string,mixed>
     */
    private array $stationAlerts;

    /**
     * @var array<string,mixed>
     */
    public array $stationFacilities;

    /**
     * @var array<string,mixed>
     */
    private array $wiFi;

    public function getAccessiblePublicTelephonesText(): string
    {
        return dot($this->accessibility)->get('AccessiblePublicTelephones.com:Annotation.com:Note');
    }

    public function getAccessibilityHelplineText(): string
    {
        return dot($this->accessibility)->get('Helpline.com:Annotation.com:Note');
    }

    public function getAddress(): StationAddress
    {
        /** @var array<int,string> */
        $addressLines = [
            ...dot($this->address)->get('com:PostalAddress.add:A_5LineAddress.add:Line'),
            dot($this->address)->get('com:PostalAddress.add:A_5LineAddress.add:PostCode'),
        ];

        return new StationAddress(...$addressLines);
    }

    public function getAirportText(): string
    {
        return dot($this->airport)->get('com:Annotation.com:Note');
    }

    public function getAtmMachineLocationText(): string
    {
        return dot($this->stationFacilities)->get('AtmMachine.com:Location.com:Note');
    }

    public function getAssistedTravelText(): ?string
    {
        return dot($this->accessibility)->get('Helpline.com_Annotation.com_Note');
    }

    public function getCarParkName(): string
    {
        return dot($this->interchange)->get('CarPark.Name');
    }

    public function getCarParkOperatorName(): string
    {
        return dot($this->interchange)->get('CarPark.com:OperatorName');
    }

    public function getCrsCode(): string
    {
        return $this->crsCode;
    }

    public function getCycleStorageAnnotationText(): string
    {
        return dot($this->interchange)->get('CycleStorage.Annotation.com:Note');
    }

    public function getCycleStorageLocationText(): string
    {
        return dot($this->interchange)->get('CycleStorage.Location.com:Note');
    }

    public function getFirstClassLoungeText(): string
    {
        return dot($this->stationFacilities)->get('FirstClassLounge.com:Annotation.com:Note');
    }

    public function getInformationServicesOpenText(): ?string
    {
        return dot($this->informationSystems)->get('InformationServicesOpen.com:Annotation.com:Note');
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getNationalKeyToiletsText(): string
    {
        return dot($this->accessibility)->get('NationalKeyToilets.com:Location.com:Note');
    }

    public function getOnwardTravelText(): string
    {
        return dot($this->interchange)->get('OnwardTravel.com:Annotation.com:Note');
    }

    public function getPassengerServicesCustomerServiceText(): string
    {
        return dot($this->passengerServices)->get('CustomerService.com:Annotation.com:Note');
    }

    public function getPostBoxText(): string
    {
        return dot($this->stationFacilities)->get('PostBox.com:Location.com:Note');
    }

    public function getRailReplacementServicesText(): string
    {
        return dot($this->interchange)->get('RailReplacementServices.com:Annotation.com:Note');
    }

    public function getShopsText(): string
    {
        return dot($this->stationFacilities)->get('Shops.com:Annotation.com:Note');
    }

    public function getSmartcardComments(): string
    {
        return dot($this->fares)->get('SmartcardComments.com:Note');
    }

    public function getStaffHelpAvailableText(): string
    {
        return dot($this->accessibility)->get('StaffHelpAvailable.com:Annotation.com:Note');
    }

    public function getStationAlert(): string
    {
        return dot($this->stationAlerts)->get('AlertText');
    }

    public function getStationBuffetText(): string
    {
        return dot($this->stationFacilities)->get('StationBuffet.com:Annotation.com:Note');
    }

    public function getStepFreeAccessText(): string
    {
        return dot($this->accessibility)->get('StepFreeAccess.com:Annotation.com:Note');
    }

    public function getTaxiRankText(): string
    {
        return dot($this->interchange)->get('TaxiRank.com:Annotation.com:Note');
    }

    public function getTicketGatesText(): string
    {
        return dot($this->accessibility)->get('TicketGates.com:Annotation.com:Note');
    }

    public function getTicketOfficeLocationText(): string
    {
        return dot($this->fares)->get('TicketOffice.com:Location.com:Note');
    }

    public function getToiletsLocationText(): string
    {
        return dot($this->stationFacilities)->get('Toilets.com:Location.com:Note');
    }

    public function getWaitingRoomLocationText(): string
    {
        return dot($this->stationFacilities)->get('WaitingRoom.com:Location.com:Note');
    }

    public function getWaitingRoomOpenText(): string
    {
        return dot($this->stationFacilities)->get('WaitingRoom.com:Open.com:Annotation.com:Note');
    }

    public function getWiFiText(): string
    {
        return dot($this->wiFi)->get('com:Annotation.com:Note');
    }

    /**
     * @param array<string,mixed> $values
     */
    public function setAccessibility(array $values): void
    {
        $this->accessibility = $values;
    }

    /**
     * @param array<int,string> $address
     */
    public function setAddress(array $address): void
    {
        $this->address = $address;
    }

    /**
     * @param array<int,string> $value
     */
    public function setAirport(array $value): void
    {
        $this->airport = $value;
    }

    public function setCrsCode(string $crsCode): void
    {
        $this->crsCode = $crsCode;
    }

    /**
     * @param array<string,mixed> $values
     */
    public function setFares(array $values): void
    {
        $this->fares = $values;
    }

    /**
     * @param array<string,mixed> $values
     */
    public function setInformationSystems(array $values): void
    {
        $this->informationSystems = $values;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param array<string,mixed> $values
     */
    public function setPassengerServices(array $values): void
    {
        $this->passengerServices = $values;
    }

    /**
     * @param array<string,mixed> $values
     */
    public function setStationAlerts(array $values): void
    {
        $this->stationAlerts = $values;
    }

    /**
     * @param array<string,mixed> $values
     */
    public function setWiFi(array $values): void
    {
        $this->wiFi = $values;
    }
}
