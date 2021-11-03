<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CountryFixture extends Fixture
{
    public const COUNTRY_REFERENCE = 'France';

    public function load(ObjectManager $manager): void
    {
        $country = new Country();
        $country->setName(self::COUNTRY_REFERENCE);
        $country->setCode('1');
        $manager->persist($country);

        $manager->flush();
        $this->addReference(self::COUNTRY_REFERENCE, $country);
    }
}
