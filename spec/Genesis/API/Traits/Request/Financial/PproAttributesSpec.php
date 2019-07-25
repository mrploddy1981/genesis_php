<?php

namespace spec\Genesis\API\Traits\Request\Financial;

use PhpSpec\ObjectBehavior;

class PproAttributesSpec extends ObjectBehavior
{
    public function let()
    {
        $this->beAnInstanceOf('spec\Genesis\API\Stubs\Traits\Request\Financial\PproAttributesStub');
    }

    public function it_should_set_consumer_reference_correctly()
    {
        $this->shouldNotThrow()->during(
            'setConsumerReference',
            [str_repeat('8', $this->object->getWrappedObject()->getMaxConsumerReferenceLen())]
        );
    }

    public function it_should_set_national_id_correctly()
    {
        $this->shouldNotThrow()->during(
            'setNationalId',
            [str_repeat('8', $this->object->getWrappedObject()->getNationalIdLen())]
        );
    }

    public function it_should_set_birth_date_correctly()
    {
        $this->shouldNotThrow()->during(
            'setBirthDate',
            ['31-11-1999']
        );
    }

    public function it_should_fail_when_consumer_reference_is_invalid()
    {
        $this->shouldThrow()->during(
            'setConsumerReference',
            [str_repeat('8', $this->object->getWrappedObject()->getMaxConsumerReferenceLen() + 1)]
        );
    }

    public function it_should_fail_when_national_id_is_invalid()
    {
        $this->shouldThrow()->during(
            'setNationalId',
            [str_repeat('8', $this->object->getWrappedObject()->getNationalIdLen() + 1)]
        );
    }

    public function it_should_fail_when_birth_date_is_invalid()
    {
        $this->shouldThrow()->during(
            'setBirthDate',
            ['30.10.1999']
        );
    }
}