<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        for ($i =0; $i < 10; $i++) {
            $episode = new Episode();
            $episode->setTitle($faker->words(5, true));
            $episode->setNumber($faker->numberBetween(1,10));
            $episode->setSynopsis($faker->paragraph(4, true));

            $episode->setSeason($this->getReference('season_' . $faker->numberBetween(1,5)));

            $manager->persist($episode);

        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            SeasonFixtures::class
        ];
    }
}