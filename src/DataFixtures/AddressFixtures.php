<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\City;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AddressFixtures extends Fixture
{
    public const ADDRESS_REFERENCE = 'address1';

    public function load(ObjectManager $manager): void
    {
        /** @var City $city */
        $city = $this->getReference(CityFixture::CITY_REFERENCE);

        $address = new Address();
        $address->setTitle(self::ADDRESS_REFERENCE);
        $address->setAddress1('9 rue de Test');
        $address->setPostcode('01000');
        $address->setCity($city);
        $manager->persist($address);

        $manager->flush();
        $this->addReference(self::ADDRESS_REFERENCE, $address);
    }
}
