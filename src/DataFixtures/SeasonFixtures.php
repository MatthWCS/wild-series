<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $season = new Season();
        $season->setNumber(1);
        $season->setYear(2000);
        $season->setDescription("");

        $season->setProgram($this->getReference('program_Barbares'));
        $this->addReference('season1_Barbares', $season);
        $manager->persist($season);

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class
        ];
    }
}