<?php

namespace App\DataFixtures;

use App\Entity\Country;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;


class CountryFixtures extends Fixture
{
    public const NB_COUNTRY = 196;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < self::NB_COUNTRY; $i++) {
            $country = new Country();
            $country->setName($faker->country());
            $this->addReference('country_' . $i, $country);

            $manager->persist($country);
        }
        $manager->flush();
    }
}
