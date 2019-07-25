<?php

namespace spec\Genesis\API\Request\Financial\Cards;

use Genesis\API\Request\Financial\Cards\Authorize3D;
use PhpSpec\ObjectBehavior;
use spec\SharedExamples\Genesis\API\Request\RequestExamples;

class Authorize3DSpec extends ObjectBehavior
{
    use RequestExamples;

    public function it_is_initializable()
    {
        $this->shouldHaveType(Authorize3D::class);
    }

    public function it_should_fail_when_missing_required_params()
    {
        $this->testMissingRequiredParameters([
            'card_holder',
            'card_number'
        ]);
    }

    public function it_should_fail_when_missing_cc_holder_last_name_parameter()
    {
        $this->setRequestParameters();
        $this->setCardHolder('First');

        $this->shouldThrow(
            $this->getExpectedFieldValueException('card_holder')
        )->during('getDocument');
    }

    public function it_should_fail_when_invalid_cc_holder_parameter()
    {
        $this->setRequestParameters();
        $this->setCardHolder('First$% Last');

        $this->shouldThrow(
            $this->getExpectedFieldValueException('card_holder')
        )->during('getDocument');
    }

    public function it_can_set_cc_holder_parameter_with_special_chars()
    {
        $this->setRequestParameters();
        $this->setCardHolder('Müller O\'Conner');

        $this->getDocument()->shouldNotBeEmpty();
    }

    public function it_should_fail_when_unsupported_currency_parameter()
    {
        $this->setRequestParameters();
        $this->setCurrency('ABC');

        $this->shouldThrow()->during('getDocument');
    }

    protected function setRequestParameters()
    {
        $faker = $this->getFaker();

        $this->setTransactionId($faker->numberBetween(1, PHP_INT_MAX));
        $this->setCurrency(
            $faker->randomElement(
                \Genesis\Utils\Currency::getList()
            )
        );
        $this->setAmount($faker->numberBetween(1, PHP_INT_MAX));
        $this->setUsage('Genesis PHP Client Automated Request');
        $this->setRemoteIp($faker->ipv4);
        $this->setCardHolder($faker->name);
        $this->setCardNumber('4200000000000000');
        $this->setCvv(sprintf("%03s", $faker->numberBetween(1, 999)));
        $this->setExpirationMonth($faker->numberBetween(1, 12));
        $this->setExpirationYear($faker->numberBetween(date('Y'), 2020));
        $this->setCustomerEmail($faker->email);
        $this->setCustomerPhone($faker->phoneNumber);
        $this->setBillingFirstName($faker->firstName);
        $this->setBillingLastName($faker->lastName);
        $this->setBillingAddress1($faker->streetAddress);
        $this->setBillingZipCode($faker->postcode);
        $this->setBillingCity($faker->city);
        $this->setBillingState($faker->state);
        $this->setBillingCountry($faker->countryCode);
        $this->setNotificationUrl($faker->url);
        $this->setReturnSuccessUrl($faker->url);
        $this->setReturnFailureUrl($faker->url);
    }
}
