<?php

namespace App\Tests\Entity;

use App\Entity\City;

class CityTest extends EntityTestCase
{
    protected City $city;

    protected function setUp() : void
    {
        $this->city = $this->createMock(City::class);
        $this->city->method('getCode')->willReturn('01000');
        $this->city->method('getName')->willReturn('Ville Test');
        $this->city->method('getCountry')->willReturn($this->getCountry());
    }

    public function testGetters(): void
    {
        $expectedResult = $this->getCity();

        $this->assertEquals($this->city->getCode(),$expectedResult->getCode());
        $this->assertEquals($this->city->getName(),$expectedResult->getName());
        $this->assertEquals($this->city->getCountry(),$expectedResult->getCountry());
    }
}
