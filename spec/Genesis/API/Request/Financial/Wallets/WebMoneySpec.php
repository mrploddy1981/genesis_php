<?php

namespace spec\Genesis\API\Request\Financial\Wallets;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class WebMoneySpec extends ObjectBehavior
{
    public function it_is_initializable()
    {
        $this->shouldHaveType('Genesis\API\Request\Financial\Wallets\WebMoney');
    }

    public function it_can_build_structure()
    {
        $this->setRequestParameters();
        $this->getDocument()->shouldNotBeEmpty();
    }

    public function it_should_fail_when_no_parameters()
    {
        $this->shouldThrow()->during('getDocument');
    }

    public function it_should_fail_when_payout_transaction_without_cust_account_id()
    {
        $this->setRequestParameters();
        $this->setIsPayout(true);
        $this->shouldThrow()->during('getDocument');
    }

    public function it_should_fail_when_payout_transaction_without_billing_country()
    {
        $this->setRequestParameters();
        $this->setBillingCountry(null);
        $this->shouldThrow()->during('getDocument');
    }

    public function it_should_build_payout_structure()
    {
        $faker = $this->getFaker();

        $this->setRequestParameters();
        $this->setIsPayout(true);
        $this->setCustomerAccountId($faker->userName);
        $this->getDocument()->shouldNotBeEmpty();
    }

    protected function setRequestParameters()
    {
        $faker = $this->getFaker();

        $this->setTransactionId($faker->numberBetween(1, PHP_INT_MAX));

        $this->setUsage('Genesis Automated PHP Request');
        $this->setRemoteIp($faker->ipv4);

        $this->setCurrency(
            $faker->randomElement(
                \Genesis\Utils\Currency::getList()
            )
        );
        $this->setAmount($faker->numberBetween(1, PHP_INT_MAX));

        $this->setCustomerEmail($faker->email);

        $this->setReturnSuccessUrl($faker->url);
        $this->setReturnFailureUrl($faker->url);

        $this->setBillingCountry(
            $faker->randomElement(
                \Genesis\Utils\Country::getList()
            )
        );
    }

    protected function getFaker()
    {
        $faker = \Faker\Factory::create();

        $faker->addProvider(new \Faker\Provider\en_US\Person($faker));
        $faker->addProvider(new \Faker\Provider\Payment($faker));
        $faker->addProvider(new \Faker\Provider\en_US\Address($faker));
        $faker->addProvider(new \Faker\Provider\en_US\PhoneNumber($faker));
        $faker->addProvider(new \Faker\Provider\Internet($faker));

        return $faker;
    }

    public function getMatchers()
    {
        return array(
            'beEmpty'       => function ($subject) {
                return empty($subject);
            },
            'contain'       => function ($subject, $arg) {
                return (stripos($subject, $arg) !== false);
            },
        );
    }
}
