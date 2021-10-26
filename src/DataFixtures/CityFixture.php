<?php

namespace App\DataFixtures;

use App\Entity\City;
use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CityFixture extends Fixture
{
    public const CITY_REFERENCE = 'City Test';

    public function load(ObjectManager $manager): void
    {
        /** @var Country $country */
        $country = $this->getReference(CountryFixture::COUNTRY_REFERENCE);

        $city = new City();
        $city->setName(self::CITY_REFERENCE);
        $city->setCode('1000');
        $city->setCountry($country);
        $manager->persist($city);

        $manager->flush();
        $this->addReference(self::CITY_REFERENCE, $city);
    }
}
