<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProgramFixtures extends Fixture implements DependentFixtureInterface
{
    const PROGRAMS = [
            [
                'title' => 'Walking Dead',
                'synopsis' => 'Un groupe de survivants doit rester soudé face à une apocalypse zombie.',
                'category' => 'category_Action',
            ],
            [
                'title' => 'Barbares',
                'synopsis' => "Et si Rome n'était pas invincible ? En l'an 9 après J.-C. en Germanie,
                 une armée avec à sa tête un ancien soldat romain décide de s'élever contre la puissance
                  de l'Empire.",
                'category' => 'category_Action',
            ],
            [
                'title' => "Perdus dans l'espace",
                'synopsis' => "Espérant une vie meilleure, ils ont quitté la Terre... pour une série de calamités
                 cosmiques, de créatures hostiles et de technologies extraterrestres perfides. Danger!",
                'category' => 'category_Aventure',
            ],
            [
                'title' => "Stranger Things",
                'synopsis' => "Quand un jeune garçon disparaît, une petite ville découvre une affaire mystérieuse,
                 des expériences secrètes, des forces surnaturelles terrifiantes... et une fillette.",
                'category' => 'category_Horreur',
            ],
            [
                'title' => "Peaky Blinders",
                'synopsis' => "Dans cette série historique réaliste, un jeune chef de la pègre se bat pour garder
                 le pouvoir et échapper au policier qui essaie de le coincer.",
                'category' => 'category_Action',
            ],
            [
                'title' => "S.W.A.T.",
                'synopsis' => "Dans sa ville natale de Los Angeles, un sergent est nommé à la tête d'une unité
                 d'élite pour désamorcer la tension qui règne au sein de sa communauté.",
                'category' => 'category_Action',
            ],
            [
                'title' => "Vikings",
                'synopsis' => "Lassé par les pillages, ce guerrier ambitieux vogue vers l'ouest à la recherche
                 de terres inconnues, de pouvoir et de gloire, et marque ainsi le début de l'ère viking.",
                'category' => 'category_Aventure',
            ],
        ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $program => [$title, $synopsis, $category]) {
            $program = new Program();
            $program->setTitle($title);
            $program->setSynopsis($synopsis);
            $program->setCategory($this->getReference($category));
            $manager->persist($program);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            CategoryFixtures::class,
        ];
    }
}
