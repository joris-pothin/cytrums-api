<?php

namespace App\Tests\Entity;

use App\Entity\Accomodation;
use App\Entity\Activity;
use App\Entity\Address;
use App\Entity\City;
use App\Entity\Cost;
use App\Entity\Country;
use App\Entity\Event;
use App\Entity\Transport;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

abstract class EntityTestCase extends TestCase
{
    /**
     * @return Event
     */
    protected function getEvent() : Event
    {
        $event = new Event();
        $event->setTitle('Event 1');
        $event->setDescription('1er evenement créé...');
        $event->setAddress($this->getAddress1());
        $event->setDateBegin(\DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-01 00:00:00'));
        $event->setDateEnd(\DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-03 12:00:00'));

        return $event;
    }

    /**
     * @return Activity
     */
    protected function getActivity() : Activity
    {
        $activity = new Activity();
        $activity->setTitle('Activity 1');
        $activity->setDescription('1ere activité créée...');
        $activity->setAddress($this->getAddress1());
        $activity->setDateBegin(\DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-01 00:00:00'));
        $activity->setDateEnd(\DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-03 12:00:00'));
        $activity->setEvent($this->getEvent());
        $activity->setType('Sport');

        return $activity;
    }

    /**
     * @return Address
     */
    protected function getAddress1() : Address
    {
        $address = new Address();
        $address->setTitle('Address 1');
        $address->setAddress1('9 rue de Test');
        $address->setPostcode('01000');
        $address->setCity($this->getCity());

        return $address;
    }
    /**
     * @return Address
     */
    protected function getAddress2() : Address
    {
        $address = new Address();
        $address->setTitle('Address 2');
        $address->setAddress1('16 rue de Test 2');
        $address->setPostcode('02000');
        $address->setCity($this->getCity());

        return $address;
    }

    /**
     * @return City
     */
    protected function getCity() : City
    {
        $city = new City();
        $city->setName('Ville Test');
        $city->setCode('01000');
        $city->setCountry($this->getCountry());

        return $city;
    }

    /**
     * @return Country
     */
    protected function getCountry() : Country
    {
        $country = new Country();
        $country->setName('France');
        $country->setCode('1');

        return $country;
    }

    /**
     * @return Accomodation
     */
    protected function getAccomodation() : Accomodation
    {
        $accomodation = new Accomodation();
        $accomodation->setTitle('Accomodation1');
        $accomodation->setAddress($this->getAddress1());
        $accomodation->setDateBegin(\DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-01 00:00:00'));
        $accomodation->setDateEnd(\DateTime::createFromFormat('Y-m-d H:i:s', '2021-01-03 12:00:00'));
        $accomodation->setCost($this->getCost1());
        $accomodation->setEvent($this->getEvent());
        $accomodation->addParticipant($this->getUser());

        return $accomodation;
    }

    /**
     * @return Cost
     */
    protected function getCost1() : Cost
    {
        $cost = new Cost();
        $cost->setTitle('Airbnb');
        $cost->setAmount(12.5);
        $cost->setEvent($this->getEvent());

        return $cost;
    }

    /**
     * @return Cost
     */
    protected function getCost2() : Cost
    {
        $cost = new Cost();
        $cost->setTitle('covoiturage');
        $cost->setAmount(10);
        $cost->setEvent($this->getEvent());

        return $cost;
    }

    /**
     * @return Transport
     */
    protected function getTransport() : Transport
    {
        $transport = new Transport();
        $transport->setEvent($this->getEvent());
        $transport->setCost($this->getCost2());
        $transport->setAddressFrom($this->getAddress1());
        $transport->setAddressTo($this->getAddress2());
        $transport->setType('Covoiturage');

        return $transport;
    }

    /**
     * @return User
     */
    protected function getUser() : User
    {
        $user = new User();
        $user->setLastname('Testnom');
        $user->setFirstname('Testprenom');
        $user->setEmail('test@test.com');
        $user->addAddress($this->getAddress1());
        $user->setUsername('test');
        $user->setPassword('O68XKLT0OZuGKJ4Oqp8xleeLZqWHgBXufK6SiUl8R1mo1UbIH9Vhe');

        return $user;
    }
}
