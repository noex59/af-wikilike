<?php

namespace App\DataFixtures;

use App\Entity\Exemple;
use App\Entity\Technologie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $technologie1 = new Technologie();
        $technologie1->setLibelle("CSS");

        $manager->persist($technologie1);

        $technologie2 = new Technologie();
        $technologie2->setLibelle("Symfony");

        $manager->persist($technologie2);

        $technologie3 = new Technologie();
        $technologie3->setLibelle("Wordpress");

        $manager->persist($technologie3);


        $exemple = new Exemple();
        $exemple->setTitre("Exemple code css");
        $exemple->setCode(".container{
            margin: 0 auto;
        }");
        $exemple->setCreatedAt(new \DateTimeImmutable());
        $exemple->addTechnology($technologie1);

        $manager->persist($exemple);

        $exemple = new Exemple();
        $exemple->setTitre("Exemple code symfony");
        $exemple->setCode('class AppFixtures extends Fixture
        {
            public function load(ObjectManager $manager)
            {
                $technologie = new Technologie();
                $technologie->setLibelle(\"CSS\");
        
                $manager->persist($technologie);
        
        
                $manager->flush();
            }
        }');
        $exemple->setCreatedAt(new \DateTimeImmutable());
        $exemple->addTechnology($technologie2);

        $manager->persist($exemple);

        $exemple = new Exemple();
        $exemple->setTitre("Exemple code wordpress");
        $exemple->setCode("get_option('OPTION_NAME')");
        $exemple->setCreatedAt(new \DateTimeImmutable());
        $exemple->addTechnology($technologie3);

        $manager->persist($exemple);


        $manager->flush();
    }
}