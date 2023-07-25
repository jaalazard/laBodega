<?php

namespace App\DataFixtures;

use App\Entity\Strength;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StrengthFixtures extends Fixture
{
    public const SCOVILLE = [16000000000, 5300000000, 16000000, 15000000, 9200000, 9100000, 8600000, 2000000, 5300000, 3180000, 2480000, 2200000, 2009231, 1953986, 1800000, 1598227, 1359000, 1176182, 1067286, 1041427, 855000, 800000, 700000, 500000, 425000, 325000, 300000, 255000, 160000, 150000, 100000, 60000, 50000, 30000, 16000, 10000, 8000, 7000, 5000, 4500, 3000, 2500, 1500, 1200, 1000, 600, 500, 100, 0];
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i<count(self::SCOVILLE); $i++){
        $strength = new Strength();
        $strength->setPower(self::SCOVILLE[$i]);
        $this->addReference('strength_' . $i, $strength);

        $manager->persist($strength);
        }
        $manager->flush();
    }
}
