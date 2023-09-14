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
    public array $address;

    /**
     * @var array<string,mixed>
     */
    public array $accessibility = [];

    /**
     * @Assert\Regex("/^[A-Z]{3}$/")
     */
    public string $crsCode;

    /**
     * @var array<string,mixed>
     */
    public array $fares = [];

    /**
     * @var array<string,string>
     */
    public array $informationSystems = [];

    /**
     * @var array<int,string>
     */
    public array $interchange = [];

    /**
     * @Assert\NotBlank
     */
    public string $name;

    /**
     * @var array<string,mixed>
     */
    public array $passengerServices = [];

    /**
     * @var array<string,mixed>
     */
    public array $stationAlerts = [];

    /**
     * @var array<string,mixed>
     */
    public array $stationFacilities = [];

    /**
     * @var array<string,mixed>
     */
    public array $wiFi;

    public function getAccessiblePublicTelephonesText(): ?string
    {
        return dot($this->accessibility)->get('AccessiblePublicTelephones.com:Annotation.com:Note');
    }

    public function getAccessibilityHelplineText(): ?string
    {
        return dot($this->accessibility)->get('Helpline.com:Annotation.com:Note');
    }

    public function getAddress(): StationAddress
    {
        $lines = dot($this->address)->get('com:PostalAddress.add:A_5LineAddress.add:Line');

        // Some 5-line addresses have only four lines (including the postcode).
        // If this is the case, add a blank line so there is the expected number of lines.
        if (count($lines) === 3) {
            $lines[] = null;
        }

        /** @var array<int,string> */
        $addressLines = [
            ...$lines,
            dot($this->address)->get('com:PostalAddress.add:A_5LineAddress.add:PostCode'),
        ];

        return new StationAddress(...$addressLines);
    }

    public function getAirportText(): ?string
    {
        return dot($this->interchange)->get('Airport.com:Annotation.com:Note');
    }

    public function getAtmMachineLocationText(): ?string
    {
        return dot($this->stationFacilities)->get('AtmMachine.com:Location.com:Note');
    }

    public function getAssistedTravelText(): ?string
    {
        return dot($this->accessibility)->get('Helpline.com_Annotation.com_Note');
    }

    public function getCarParkName(): ?string
    {
        return dot($this->interchange)->get('CarPark.Name');
    }

    public function getCarParkOperatorName(): ?string
    {
        return dot($this->interchange)->get('CarPark.com:OperatorName');
    }

    public function getCrsCode(): string
    {
        return $this->crsCode;
    }

    public function getCycleStorageAnnotationText(): ?string
    {
        return dot($this->interchange)->get('CycleStorage.Annotation.com:Note');
    }

    public function getCycleStorageLocationText(): ?string
    {
        return dot($this->interchange)->get('CycleStorage.Location.com:Note');
    }

    public function getFirstClassLoungeText(): ?string
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

    public function getNationalKeyToiletsText(): ?string
    {
        return dot($this->accessibility)->get('NationalKeyToilets.com:Location.com:Note');
    }

    public function getOnwardTravelText(): ?string
    {
        return dot($this->interchange)->get('OnwardTravel.com:Annotation.com:Note');
    }

    public function getPostcode(): string
    {
        return $this->getAddress()->postcode;
    }

    public function getPassengerServicesCustomerServiceText(): ?string
    {
        return dot($this->passengerServices)->get('CustomerService.com:Annotation.com:Note');
    }

    public function getPostBoxText(): ?string
    {
        return dot($this->stationFacilities)->get('PostBox.com:Location.com:Note');
    }

    public function getRailReplacementServicesText(): ?string
    {
        return dot($this->interchange)->get('RailReplacementServices.com:Annotation.com:Note');
    }

    public function getShopsText(): ?string
    {
        return dot($this->stationFacilities)->get('Shops.com:Annotation.com:Note');
    }

    public function getSmartcardComments(): ?string
    {
        return dot($this->fares)->get('SmartcardComments.com:Note');
    }

    public function getStaffHelpAvailableText(): ?string
    {
        return dot($this->accessibility)->get('StaffHelpAvailable.com:Annotation.com:Note');
    }

    public function getStationAlert(): ?string
    {
        return dot($this->stationAlerts)->get('AlertText');
    }

    public function getStationBuffetText(): ?string
    {
        return dot($this->stationFacilities)->get('StationBuffet.com:Annotation.com:Note');
    }

    public function getStepFreeAccessText(): ?string
    {
        return dot($this->accessibility)->get('StepFreeAccess.com:Annotation.com:Note');
    }

    public function getTaxiRankText(): ?string
    {
        return dot($this->interchange)->get('TaxiRank.com:Annotation.com:Note');
    }

    public function getTicketGatesText(): ?string
    {
        return dot($this->accessibility)->get('TicketGates.com:Annotation.com:Note');
    }

    public function getTicketOfficeLocationText(): ?string
    {
        return dot($this->fares)->get('TicketOffice.com:Location.com:Note');
    }

    public function getToiletsLocationText(): ?string
    {
        return dot($this->stationFacilities)->get('Toilets.com:Location.com:Note');
    }

    public function getWaitingRoomLocationText(): ?string
    {
        return dot($this->stationFacilities)->get('WaitingRoom.com:Location.com:Note');
    }

    public function getWaitingRoomOpenText(): ?string
    {
        return dot($this->stationFacilities)->get('WaitingRoom.com:Open.com:Annotation.com:Note');
    }

    public function getWiFiText(): ?string
    {
        return dot($this->stationFacilities)->get('WiFi.com:Annotation.com:Note');
    }

    public function getClosingTime(string $day): string
    {
        $openTimes = dot($this->fares)->get('TicketOffice.com:Open.com:DayAndTimeAvailability');

        $openTimesForDay = array_values(array_filter($openTimes, function (array $openTime) use ($day): bool {
            return array_key_exists(key: "com:{$day}", array: $openTime['com:DayTypes']);
        }));

        $endTime = dot($openTimesForDay)->get('0.com:OpeningHours.com:OpenPeriod.com:EndTime');

        return substr(string: $endTime, offset: 0, length: 5);
    }
}
