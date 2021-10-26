<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EventFixtures extends Fixture
{
    public const EVENT_REFERENCE = 'event1';

    public function load(ObjectManager $manager): void
    {
        /** @var Address $address */
        $address = $this->getReference(AddressFixtures::ADDRESS_REFERENCE);

        $event = new Event();
        $event->setTitle(self::EVENT_REFERENCE);
        $event->setDescription('1er evenement créé...');
        $event->setAddress($address);
        $event->setDateBegin(\DateTime::createFromFormat('Y-m-d H:i:s', strtotime('2021-01-01 00:00:00')));
        $event->setDateEnd(\DateTime::createFromFormat('Y-m-d H:i:s', strtotime('2021-01-03 12:00:00')));
        $manager->persist($event);

        $manager->flush();

        $this->addReference(self::EVENT_REFERENCE, $event);
    }
}
