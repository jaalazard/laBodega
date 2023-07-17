<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\DataFixtures\ColorFixtures;
use App\DataFixtures\StrengthFixtures;
use App\Entity\Pimento;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class PimentoFixtures extends Fixture implements DependentFixtureInterface
{
    public const PIMENTOS = ['Piment doux', 'Paprika doux', 'Pimenton de la Vera', 'Piment d\'Anaheim', 'Piment Niora', 'Sauce Tabasco', 'Verte poblano', 'Piment d\'Espelette', 'Piment Rocotillo', 'Sauce sriracha', 'Piment Chimayo', 'Piment jalapeño', 'Chipotle', 'Piment cheveux d\'ange', 'Piment anneaux de feu', 'Paprika fort', 'Piment Pili Pili', 'Hungarian Hot Wax', 'Poivre Noir', 'Poivre Blanc', 'Piment Cascabel', 'Piment serrano', 'Hari Mirchi', 'Piment d\'Alep', 'Piment oiseau', 'Harissa', 'Piment de Cayenne', 'Piment pequin', 'Piment Thaï Hot', 'Wiri wiri', 'Piment Malagueta', 'Piment Chiltepin', 'Piment Tabasco', 'Piment d\'Amazonie', 'Pepper X', 'Dragon\'s Breath', 'Carolina Reaper', 'Red Savina', 'Piment habanero', 'Piment Scotch bonnet', 'Piment rocoto', 'Jamaican Hot Pepper', 'Bulgarian carrot', 'Piment Fatalii', 'Piment Datil'];
    public function load(ObjectManager $manager): void
    {

        $faker = Factory::create('fr_FR');

        for ($i = 0; $i < count(self::PIMENTOS); $i++) {
            $pimento = new Pimento();
            $pimento->setName(self::PIMENTOS[$i]);
            $pimento->setStrength($this->getReference('strength_' . $faker->numberBetween(0, count(StrengthFixtures::SCOVILLE) - 1)));
            $pimento->setColor($this->getReference(
                'color_' . $faker->numberBetween(0, count(ColorFixtures::COLORS) - 1)
            ));
            $pimento->setPrice($faker->numberBetween(10, 1000));
            $pimento->setCountry($this->getReference(
                'country_' . $faker->numberBetween(0, count(CountryFixtures::COUNTRIES)-1)));
            $pimento->setDescription($faker->text(200, 500));
            $manager->persist($pimento);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ColorFixtures::class,
            StrengthFixtures::class,
        ];
    }
}
