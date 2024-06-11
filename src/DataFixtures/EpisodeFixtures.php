<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    const EPISODES = [
        [
            'title' => 'title1',
            'number' => 1,
            'synopsis' => "Blablabla",
        ],
        [
            'title' => 'title2',
            'number' => 2,
            'synopsis' => "Blablabla",
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::EPISODES as $episodeInfo) {
            $episode = new Episode();
            $episode->setTitle($episodeInfo['title']);
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