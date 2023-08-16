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
    public const COUNTRIES = ['AF', 'AX', 'AL', 'DZ', 'AS', 'AD', 'AO', 'AI', 'AQ', 'AG', 'AR', 'AM', 'AW', 'AU', 'AT', 'AZ', 'BS', 'BH', 'BD', 'BB', 'BY', 'BE', 'BZ', 'BJ', 'BM', 'BT', 'BO', 'BA', 'BW', 'BV', 'BR', 'IO', 'BN', 'BG', 'BF', 'BI', 'KH', 'CM', 'CA', 'CV', 'KY', 'CF', 'TD', 'CL', 'CN', 'CX', 'CC', 'CO', 'KM', 'CG', 'CD', 'CK', 'CR', 'CI', 'HR', 'CU', 'CY', 'CZ', 'DK', 'DJ', 'DM', 'DO', 'EC', 'EG', 'SV', 'GQ', 'ER', 'EE', 'ET', 'FK', 'FO', 'FJ', 'FI', 'FR', 'GF', 'PF', 'TF', 'GA', 'GM', 'GE', 'DE', 'GH', 'GI', 'GR', 'GL', 'GD', 'GP', 'GU', 'GT', 'GG', 'GN', 'GW', 'GY', 'HT', 'HM', 'VA', 'HN', 'HK', 'HU', 'IS', 'IN', 'ID', 'IR', 'IQ', 'IE', 'IM', 'IL', 'IT', 'JM', 'JP', 'JE', 'JO', 'KZ', 'KE', 'KI', 'KR', 'KW', 'KG', 'LA', 'LV', 'LB', 'LS', 'LR', 'LY', 'LI', 'LT', 'LU', 'MO', 'MK', 'MG', 'MW', 'MY', 'MV', 'ML', 'MT', 'MH', 'MQ', 'MR', 'MU', 'YT', 'MX', 'FM', 'MD', 'MC', 'MN', 'ME', 'MS', 'MA', 'MZ', 'MM', 'NA', 'NR', 'NP', 'NL', 'AN', 'NC', 'NZ', 'NI', 'NE', 'NG', 'NU', 'NF', 'MP', 'NO', 'OM', 'PK', 'PW', 'PS', 'PA', 'PG', 'PY', 'PE', 'PH', 'PN', 'PL', 'PT', 'PR', 'QA', 'RE', 'RO', 'RU', 'RW', 'BL', 'SH', 'KN', 'LC', 'MF', 'PM', 'VC', 'WS', 'SM', 'ST', 'SA', 'SN', 'RS', 'SC', 'SL', 'SG', 'SK', 'SI', 'SB', 'SO', 'ZA', 'GS', 'ES', 'LK', 'SD', 'SR', 'SJ', 'SZ', 'SE', 'CH', 'SY', 'TW', 'TJ', 'TZ', 'TH', 'TL', 'TG', 'TK', 'TO', 'TT', 'TN', 'TR', 'TM', 'TC', 'TV', 'UG', 'UA', 'AE', 'GB', 'US', 'UM', 'UY', 'UZ', 'VU', 'VE', 'VN', 'VG', 'VI', 'WF', 'EH', 'YE', 'ZM', 'ZW'];
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
            $pimento->setCountry(self::COUNTRIES[$faker->numberBetween(0, count(SELF::COUNTRIES)-1)]);
            $pimento->setDescription($faker->text(200, 500));
            $pimento->setStock($faker->numberBetween(0, 50));
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
