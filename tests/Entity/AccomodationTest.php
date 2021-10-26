<?php

namespace App\Tests\Entity;

use App\Entity\Accomodation;
use Doctrine\Common\Collections\ArrayCollection;

class AccomodationTest extends EntityTestCase
{
    protected Accomodation $accomodation;

    protected function setUp() : void
    {
        $users = new ArrayCollection();
        $users->add($this->getUser());

        $this->accomodation = $this->createMock(Accomodation::class);
        $this->accomodation->method('getTitle')->willReturn('Accomodation1');
        $this->accomodation->method('getEvent')->willReturn($this->getEvent());
        $this->accomodation->method('getAddress')->willReturn($this->getAddress1());
        $this->accomodation->method('getDateBegin')->willReturn(\DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-01 00:00:00'));
        $this->accomodation->method('getDateEnd')->willReturn(\DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-03 12:00:00'));
        $this->accomodation->method('getCost')->willReturn($this->getCost1());
        $this->accomodation->method('getParticipants')->willReturn($users);
    }

    public function testGetters(): void
    {
        $expectedResult = $this->getAccomodation();

        $this->assertEquals($this->accomodation->getTitle(),$expectedResult->getTitle());
        $this->assertEquals($this->accomodation->getEvent(),$expectedResult->getEvent());
        $this->assertEquals($this->accomodation->getAddress(),$expectedResult->getAddress());
        $this->assertEquals($this->accomodation->getDateBegin(),$expectedResult->getDateBegin());
        $this->assertEquals($this->accomodation->getDateEnd(),$expectedResult->getDateEnd());
        $this->assertEquals($this->accomodation->getCost(),$expectedResult->getCost());
        $this->assertEquals($this->accomodation->getParticipants(),$expectedResult->getParticipants());
    }
}
