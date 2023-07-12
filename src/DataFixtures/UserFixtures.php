<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < CountryFixtures::NB_COUNTRY; $i++) {
            $user = new User();
            $user->setEmail($faker->email());
            $user->setFirstname($faker->firstName());
            $user->setLastname($faker->lastName());
            $user->setCountry($this->getReference(
                'country_' . $faker->numberBetween(0, CountryFixtures::NB_COUNTRY-1)
            ));

            $manager->persist($user);
        }

            $user = new User();
            $user->setEmail('bidon@bidon.fr');
            $user->setFirstname('Jean-Michel');
            $user->setLastname('Bidon');
            $user->setCountry($this->getReference(
                'country_' . $faker->numberBetween(0, CountryFixtures::NB_COUNTRY-1)
            ));

            $manager->persist($user);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CountryFixtures::class,
        ];
    }
}
