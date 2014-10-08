<?php

namespace spec\Genesis\API\Request\Chargeback;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

require 'spec/Genesis/SpecHelper.php';

class DateRangeSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('Genesis\API\Request\Chargeback\DateRange');
    }

    function it_can_build_stucture()
    {
        $this->setRequestParameters();
        $this->getDocument()->shouldNotBeEmpty();
    }

    function it_should_fail_when_no_parameters()
    {
        $this->shouldThrow('\Genesis\Exceptions\BlankRequiredField')->duringgetDocument();
    }

    function setRequestParameters()
    {
        $faker = \Faker\Factory::create();

        $faker->addProvider(new \Faker\Provider\DateTime($faker));

        $this->setStartDate($faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'));
    }

    public function getMatchers()
    {
        return array(
            'beEmpty' => function($subject) {
                return empty($subject);
            },
        );
    }
}
