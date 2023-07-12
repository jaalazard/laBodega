<?php

namespace App\DataFixtures;

use App\Entity\Strength;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StrengthFixtures extends Fixture
{
    public const SCOVILLE = ['16000000000', '5300000000', '16000000', '15000000', '9200000', '9100000', '8600000', '2000000 - 5300000', '3180000', '2480000', '1400000 - 2200000', '1200000 - 2009231', '923889 - 1953986', '900000 - 1800000', '1463700', '1000000 - 1598227', '661451 - 1598227', '1359000', '1067286 - 1176182', '855000 - 1041427', '800000', '425000 - 700000', '255000 - 500000', '150000 - 325000', '100000 - 300000', '100000 - 160000', '50000 - 100000', '30000 - 60000', '30000 - 50000', '10000 - 30000', '5000 - 16000', '5000 - 10000', '7000 - 8000', '4500 - 5000', '2500 - 8000', '2500 - 5000', '1000 - 3000','1000 - 1500', '500 -2500', '600 - 1200', '100 - 500', '0 - 100'];
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i<count(self::SCOVILLE); $i++){
        $strength = new Strength();
        $strength->setName(self::SCOVILLE[$i]);
        $this->addReference('strength_' . $i, $strength);

        $manager->persist($strength);
        }
        $manager->flush();
    }
}
