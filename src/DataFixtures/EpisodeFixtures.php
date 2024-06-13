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
        $reference = 0;
        $faker = Factory::create();
        for ($i = 1; $i <= 50; $i++) {
            for ($j =1; $j <= 10; $j++) {
            $episode = new Episode();
            $episode->setTitle($faker->words(5, true));
            $episode->setNumber($j);
            $episode->setSynopsis($faker->paragraph(2));

            $episode->setSeason($this->getReference('season_' . $reference));

            $manager->persist($episode);
            }
            $reference++;
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