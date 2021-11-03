<?php

namespace App\Tests\Entity;

use App\Entity\Country;

class CountryTest extends EntityTestCase
{
    protected Country $country;

    protected function setUp() : void
    {
        $this->country = $this->createMock(Country::class);
        $this->country->method('getCode')->willReturn('1');
        $this->country->method('getName')->willReturn('France');
    }

    public function testGetters(): void
    {
        $expectedResult = $this->getCountry();

        $this->assertEquals($this->country->getCode(),$expectedResult->getCode());
        $this->assertEquals($this->country->getName(),$expectedResult->getName());
    }
}
