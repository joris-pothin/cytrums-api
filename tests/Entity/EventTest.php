<?php

namespace App\Tests\Entity;

use App\Entity\Event;

class EventTest extends EntityTestCase
{
    protected Event $event;

    protected function setUp() : void
    {
        $this->event = $this->createMock(Event::class);
        $this->event->method('getTitle')->willReturn('Event 1');
        $this->event->method('getDescription')->willReturn('1er evenement créé...');
        $this->event->method('getAddress')->willReturn($this->getAddress1());
        $this->event->method('getDateBegin')->willReturn(\DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-01 00:00:00'));
        $this->event->method('getDateEnd')->willReturn(\DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-03 12:00:00'));
    }

    public function testGetters(): void
    {
        $expectedResult = $this->getEvent();

        $this->assertEquals($this->event->getTitle(),$expectedResult->getTitle());
        $this->assertEquals($this->event->getDescription(),$expectedResult->getDescription());
        $this->assertEquals($this->event->getAddress(),$expectedResult->getAddress());
        $this->assertEquals($this->event->getDateBegin(),$expectedResult->getDateBegin());
        $this->assertEquals($this->event->getDateEnd(),$expectedResult->getDateEnd());
    }
}
