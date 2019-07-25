<?php

namespace spec\Genesis\API\Request\Financial\TravelData;

use Genesis\API\Request\Financial\TravelData\AirlineItineraryLegData;
use PhpSpec\ObjectBehavior;

class AirlineItineraryLegDataSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beConstructedWith('2019-03-03', 'AB', 'C', 'SOF', 'PRG', 0);
    }

    public function it_should_work_with_valid_departure_date()
    {
        $this->shouldNotThrow()->during('setDepartureDate', ['2020-03-03']);
    }

    public function it_should_work_with_valid_carrier_code()
    {
        $this->shouldNotThrow()->during('setCarrierCode', ['AB']);
    }

    public function it_should_work_with_valid_service_class()
    {
        $this->shouldNotThrow()->during('setServiceClass', ['C']);
    }

    public function it_should_work_with_valid_origin_city()
    {
        $this->shouldNotThrow()->during('setOriginCity', ['PRG']);
    }

    public function it_should_work_with_valid_destination_city()
    {
        $this->shouldNotThrow()->during('setDestinationCity', ['SOF']);
    }

    public function it_should_work_with_valid_stopover_code()
    {
        $this->shouldNotThrow()->during('setStopOverCode', ['1']);
    }

    public function it_should_work_with_valid_fare_basis_code()
    {
        $this->shouldNotThrow()->during('setFareBasisCode', ['1234']);
    }

    public function it_should_work_with_valid_flight_number()
    {
        $this->shouldNotThrow()->during('setFlightNumber', ['1234']);
    }

    public function it_should_work_with_valid_departure_time()
    {
        $this->shouldNotThrow()->during('setDepartureTime', ['07:33']);
    }

    public function it_should_work_with_valid_departure_time_segment()
    {
        $this->shouldNotThrow()->during('setDepartureTimeSegment', [AirlineItineraryLegData::DEPARTURE_TIME_SEGMENT_AM]);
    }

    public function it_should_fail_with_invalid_departure_date()
    {
        $this->shouldThrow()->during('setDepartureDate', ['2020-03-03 15:33']);
    }

    public function it_should_fail_with_invalid_carrier_code()
    {
        $this->shouldThrow()->during('setCarrierCode', ['ABC']);
    }

    public function it_should_fail_with_invalid_service_class()
    {
        $this->shouldThrow()->during('setServiceClass', ['CC']);
    }

    public function it_should_fail_with_invalid_origin_city()
    {
        $this->shouldThrow()->during('setOriginCity', ['PRGD']);
    }

    public function it_should_fail_with_invalid_destination_city()
    {
        $this->shouldThrow()->during('setDestinationCity', ['SOFD']);
    }

    public function it_should_fail_with_invalid_stopover_code()
    {
        $this->shouldThrow()->during('setStepoverCode', ['55']);
    }

    public function it_should_fail_with_invalid_fare_basis_code()
    {
        $this->shouldThrow()->during('setFareBasisCode', ['123444444']);
    }

    public function it_should_fail_with_invalid_flight_number()
    {
        $this->shouldThrow()->during('setFlightNumber', ['12344444']);
    }

    public function it_should_fail_with_invalid_departure_time()
    {
        $this->shouldThrow()->during('setDepartureTime', ['07:33:12']);
    }

    public function it_should_fail_with_invalid_departure_time_segment()
    {
        $this->shouldThrow()->during('setDepartureTimeSegment', ['AM']);
    }
}
