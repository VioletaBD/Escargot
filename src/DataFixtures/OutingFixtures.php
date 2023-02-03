<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Outing;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\Filesystem\Filesystem;

class OutingFixtures extends Fixture
{
    private Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        $this->filesystem = $filesystem;
    }
    
    public function load(ObjectManager $manager): void
    {
        $this->filesystem->remove(__DIR__ . '/../../public/uploads/outingImages/');
        $this->filesystem->mkdir(__DIR__ . '/../../public/uploads/outingImages/');

        copy(
            './src/DataFixtures/outingImages/action.jpg',
            __DIR__ . '/../../public/uploads/outingImages/action.jpg'
        );

        $outing = new Outing();
        $outing->setDescription('C\'est un voluntery sortie');
        $outing->setOutingName('action.jpg');
        $manager->persist($outing);
        $manager->flush();
    }
}
