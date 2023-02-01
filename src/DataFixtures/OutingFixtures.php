<?php

namespace App\DataFixtures;

use App\Entity\Outing;
use Faker\Factory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OutingFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $outing = new Outing();
        $outing->setDescription('C\'est un voluntery sortie');
        $outing->setFile('eco.php');
        $outing->setDateTime('now');
        $manager->persist($outing);
        $manager->flush();
    }
}
