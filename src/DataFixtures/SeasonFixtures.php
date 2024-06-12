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

        for ($i = 0; $i < 5; $i++) {
            $season = new Season();
            $season->setNumber($faker->numberBetween(1,8));
            $season->setYear($faker->year());
            $season->setDescription($faker->paragraphs(4, true));
            $season->setProgram($this->getReference('program_' . $faker->numberBetween(1,10)));

            $manager->persist($season);
            $this->addReference('season_' . $i, $season);
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