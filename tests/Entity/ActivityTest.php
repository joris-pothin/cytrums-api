<?php

namespace App\Tests\Entity;

use App\Entity\Activity;

class ActivityTest extends EntityTestCase
{
    protected Activity $activity;

    protected function setUp() : void
    {
        $this->activity = $this->createMock(Activity::class);
        $this->activity->method('getTitle')->willReturn('Activity 1');
        $this->activity->method('getDescription')->willReturn('1ere activité créée...');
        $this->activity->method('getAddress')->willReturn($this->getAddress1());
        $this->activity->method('getDateBegin')->willReturn(\DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-01 00:00:00'));
        $this->activity->method('getDateEnd')->willReturn(\DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-03 12:00:00'));
        $this->activity->method('getEvent')->willReturn($this->getEvent());
        $this->activity->method('getType')->willReturn('Sport');
    }

    public function testGetters(): void
    {
        $expectedResult = $this->getActivity();

        $this->assertEquals($this->activity->getTitle(),$expectedResult->getTitle());
        $this->assertEquals($this->activity->getDescription(),$expectedResult->getDescription());
        $this->assertEquals($this->activity->getAddress(),$expectedResult->getAddress());
        $this->assertEquals($this->activity->getDateBegin(),$expectedResult->getDateBegin());
        $this->assertEquals($this->activity->getDateEnd(),$expectedResult->getDateEnd());
        $this->assertEquals($this->activity->getEvent(),$expectedResult->getEvent());
        $this->assertEquals($this->activity->getType(),$expectedResult->getType());
    }
}
