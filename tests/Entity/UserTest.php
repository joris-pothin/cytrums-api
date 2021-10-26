<?php

namespace App\Tests\Entity;

use App\Entity\User;
use Doctrine\Common\Collections\ArrayCollection;

class UserTest extends EntityTestCase
{
    protected User $user;

    protected function setUp() : void
    {
        $address = $this->getAddress1();
        $address->setAddressUser($this->getUser());
        $addresses = new ArrayCollection();
        $addresses->add($address);

        $this->user = $this->createMock(User::class);
        $this->user->method('getLastname')->willReturn('Testnom');
        $this->user->method('getFirstname')->willReturn('Testprenom');
        $this->user->method('getAddresses')->willReturn($addresses);
        $this->user->method('getUserIdentifier')->willReturn('test');
        $this->user->method('getPassword')->willReturn('O68XKLT0OZuGKJ4Oqp8xleeLZqWHgBXufK6SiUl8R1mo1UbIH9Vhe');
        $this->user->method('getEmail')->willReturn('test@test.com');
    }

    public function testGetters(): void
    {
        $expectedResult = $this->getUser();

        $this->assertEquals($this->user->getUserIdentifier(),$expectedResult->getUserIdentifier());
        $this->assertEquals($this->user->getPassword(),$expectedResult->getPassword());
        $this->assertEquals($this->user->getAddresses(),$expectedResult->getAddresses());
        $this->assertEquals($this->user->getEmail(),$expectedResult->getEmail());
        $this->assertEquals($this->user->getFirstname(),$expectedResult->getFirstname());
        $this->assertEquals($this->user->getLastname(),$expectedResult->getLastname());
    }
}
