<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\String\Slugger\SluggerInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface
{
    private SluggerInterface $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    public function load(ObjectManager $manager): void
    {
        $reference = 0;
        $faker = Factory::create();
        for ($i = 1; $i <= 50; $i++) {
            for ($j =1; $j <= 10; $j++) {
            $episode = new Episode();
            $episode->setTitle($faker->words(5, true));
            $episode->setNumber($j);
            $episode->setSynopsis($faker->paragraph(2));
            $episode->setDuration($faker->numberBetween(10,120));

            $slug = $this->slugger->slug($episode->getTitle());
            $episode->setSlug($slug);

            $episode->setSeason($this->getReference('season_' . $reference));

            $manager->persist($episode);
            }
            $reference++;
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            SeasonFixtures::class
        ];
    }
}