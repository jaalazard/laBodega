<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Client;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ClientFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < CountryFixtures::NB_COUNTRY; $i++) {
            $client = new Client();
            $client->setEmail($faker->email());
            $client->setFirstname($faker->firstName());
            $client->setLastname($faker->lastName());
            $client->setCountry($this->getReference(
                'country_' . $faker->numberBetween(0, CountryFixtures::NB_COUNTRY-1)
            ));

            $manager->persist($client);
        }

            $client = new Client();
            $client->setEmail('bidon@bidon.fr');
            $client->setFirstname('Jean-Michel');
            $client->setLastname('Bidon');
            $client->setCountry($this->getReference(
                'country_' . $faker->numberBetween(0, CountryFixtures::NB_COUNTRY-1)
            ));

            $manager->persist($client);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CountryFixtures::class,
        ];
    }
}
