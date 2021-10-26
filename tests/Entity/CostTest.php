<?php

namespace App\Tests\Entity;

use App\Entity\Cost;

class CostTest extends EntityTestCase
{
    protected Cost $cost;

    protected function setUp() : void
    {
        $this->cost = $this->createMock(Cost::class);
        $this->cost->method('getEvent')->willReturn($this->getEvent());
        $this->cost->method('getTitle')->willReturn('Airbnb');
        $this->cost->method('getAmount')->willReturn(12.5);
    }

    public function testGetters(): void
    {
        $expectedResult = $this->getCost1();

        $this->assertEquals($this->cost->getEvent(),$expectedResult->getEvent());
        $this->assertEquals($this->cost->getTitle(),$expectedResult->getTitle());
        $this->assertEquals($this->cost->getAmount(),$expectedResult->getAmount());
    }
}
