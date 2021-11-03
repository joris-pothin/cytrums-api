<?php

namespace App\Tests\Entity;

use App\Entity\Transport;

class TransportTest extends EntityTestCase
{
    protected Transport $transport;

    protected function setUp() : void
    {
        $this->transport = $this->createMock(Transport::class);
        $this->transport->method('getEvent')->willReturn($this->getEvent());
        $this->transport->method('getAddressFrom')->willReturn($this->getAddress1());
        $this->transport->method('getAddressTo')->willReturn($this->getAddress2());
        $this->transport->method('getCost')->willReturn($this->getCost2());
        $this->transport->method('getType')->willReturn('Covoiturage');
    }

    public function testGetters(): void
    {
        $expectedResult = $this->getTransport();

        $this->assertEquals($this->transport->getEvent(),$expectedResult->getEvent());
        $this->assertEquals($this->transport->getAddressFrom(),$expectedResult->getAddressFrom());
        $this->assertEquals($this->transport->getAddressTo(),$expectedResult->getAddressTo());
        $this->assertEquals($this->transport->getCost(),$expectedResult->getCost());
        $this->assertEquals($this->transport->getType(),$expectedResult->getType());
    }
}
