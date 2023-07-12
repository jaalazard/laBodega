<?php

namespace App\DataFixtures;

use App\Entity\Color;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ColorFixtures extends Fixture
{
    public const COLORS = ['rouge', 'jaune', 'vert'];
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i<count(self::COLORS); $i++){
        $color = new Color();
        $color->setName(self::COLORS[$i]);
        $this->addReference('color_' . $i, $color);

        $manager->persist($color);
        }
        $manager->flush();
    }
}
