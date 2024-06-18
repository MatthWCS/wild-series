<?php

namespace App\DataFixtures;

use App\Entity\Actor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class ActorFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        for ($i = 1; $i <= 10; $i++) {
            $actor = new Actor();
            $actor->setName($faker->name());
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween(1, 10)));
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween(1, 10)));
            $actor->addProgram($this->getReference('program_' . $faker->numberBetween(1, 10)));

            $manager->persist($actor);
            $this->addReference('actor_' . $i, $actor);
        }
        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ProgramFixtures::class];
    }
}