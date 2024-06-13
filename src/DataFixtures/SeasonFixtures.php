<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class SeasonFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        $reference = 0;
        for ($i = 1; $i <= 10; $i++) {
            for ($j = 1; $j <= 5; $j++) {
            $season = new Season();
            $season->setNumber($j);
            $season->setYear(2020);
            $season->setDescription($faker->paragraph(2));
            $season->setProgram($this->getReference('program_' . $i));

            $manager->persist($season);
            $this->addReference('season_' . $reference, $season);
            $reference++;
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            ProgramFixtures::class
        ];
    }
}