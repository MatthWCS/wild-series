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
        for ($i =0; $i < 20; $i++) {
            $episode = new Episode();
            $episode->setTitle($faker);
            $episode->setNumber($episodeInfo['number']);
            $episode->setSynopsis($episodeInfo['synopsis']);

            $episode->setSeason($this->getReference('season1_Barbares'));

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