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
                'title' => 'Barbares',
                'synopsis' => "Et si Rome n'était pas invincible ? En l'an 9 après J.-C. en Germanie,
                 une armée avec à sa tête un ancien soldat romain décide de s'élever contre la puissance
                  de l'Empire.",
                'category' => 'category_Action',
            ],
            [
                'title' => "S.W.A.T.",
                'synopsis' => "Dans sa ville natale de Los Angeles, un sergent est nommé à la tête d'une unité
                 d'élite pour désamorcer la tension qui règne au sein de sa communauté.",
                'category' => 'category_Action',
            ],
            [
                'title' => "Peaky Blinders",
                'synopsis' => "Dans cette série historique réaliste, un jeune chef de la pègre se bat pour garder
                 le pouvoir et échapper au policier qui essaie de le coincer.",
                'category' => 'category_Action',
            ],
            [
                'title' => "Frontier",
                'synopsis' => "Cette série dramatique d'époque créée par Rob et Peter Blackie met en vedette
                 Jason Momoa et Landon Liboiron.",
                'category' => 'category_Action',
            ],
            [
                'title' => "Happy!",
                'synopsis' => "Un ex-flic alcoolique devenu tueur croit perdre la tête quand une licorne animée qu'il
                 est le seul à voir le pousse à sauver une fillette enlevée par le père Noël.",
                'category' => 'category_Action',
            ],
            [
                'title' => "Perdus dans l'espace",
                'synopsis' => "Espérant une vie meilleure, ils ont quitté la Terre... pour une série de calamités
                 cosmiques, de créatures hostiles et de technologies extraterrestres perfides. Danger!",
                'category' => 'category_Aventure',
            ],
            [
                'title' => "Vikings",
                'synopsis' => "Lassé par les pillages, ce guerrier ambitieux vogue vers l'ouest à la recherche
                 de terres inconnues, de pouvoir et de gloire, et marque ainsi le début de l'ère viking.",
                'category' => 'category_Aventure',
            ],
            [
                'title' => "Preacher",
                'synopsis' => "Des anges, des démons, des vampires, des cow-boys et une secte religieuse secrète
                 se heurtent à un révérend du Texas doté de pouvoirs surnaturels qui cherche à trouver Dieu.",
                'category' => 'category_Aventure',
            ],
            [
                'title' => "The Witcher",
                'synopsis' => "Véritable succès planétaire, ce récit épique sur fond de monstres, de magie et
                 de destinée.",
                'category' => 'category_Aventure',
            ],
            [
                'title' => "Gotham",
                'synopsis' => "Tout le monde connaît le commissaire Gordon, qui a pu faire sa place malgré la
                 corruption de Gotham City. GOTHAM est l'histoire originelle des pires brigands et des justiciers
                  de DC Comics.",
                'category' => 'category_Aventure',
            ],
            [
                'title' => "Demon Slayer",
                'synopsis' => "Tanjiro se lance dans un périlleux voyage pour venger sa famille massacrée par
                 un démon et délivrer sa sœur d'un mauvais sort.",
                'category' => 'category_Animation',
            ],
            [
                'title' => "The Seven Deadly Sins",
                'synopsis' => "Quand son royaume est renversé par des tyrans, une princesse écartée du trône cherche
                 à se rapprocher d'une bande de chevaliers surpuissants pour récupérer son fief.",
                'category' => 'category_Animation',
            ],
            [
                'title' => "L'Attaque des Titans",
                'synopsis' => "Témoin du massacre de sa ville natale, le jeune Eren Yeager décide de prendre sa
                 revanche et de tuer les géants qui menacent d'exterminer l'humanité.",
                'category' => 'category_Animation',
            ],
            [
                'title' => "Jojo's",
                'synopsis' => "Plusieurs générations de la famille Joestar, toutes affublées 
                du même surnom, affrontent des méchants surnaturels à différentes époques.",
                'category' => 'category_Animation',
            ],
            [
                'title' => "Castelvania",
                'synopsis' => "Cette série dark fantasy d'action créée par Warren Ellis s'inspire du jeu vidéo
                 du même nom de Konami.",
                'category' => 'category_Animation',
            ],
            [
                'title' => "Dirk Gently",
                'synopsis' => "Dirk, détective amateur et excentrique, et Todd, son réticent assistant, enquêtent
                 à l'aveuglette sur de mystérieuses affaires surnaturelles, périlleuses et embrouillées.",
                'category' => 'category_Fantastique',
            ],
            [
                'title' => "Dark",
                'synopsis' => "Mystères et machiavélisme sont au rendez-vous dans cette série de science-fiction
                 hypnotique.",
                'category' => 'category_Fantastique',
            ],
            [
                'title' => "Black Mirror",
                'synopsis' => "Libérez votre imagination et plongez dans cette série d'anthologie délirante.
                 Dans Black Mirror, vous ne savez jamais ce qui vous attend... un peu comme dans la vraie vie.",
                'category' => 'category_Fantastique',
            ],
            [
                'title' => "Sweet Tooth",
                'synopsis' => "Élevé dans une cabane isolée, le jeune Gus découvre les dangers inhérents à son
                 identité hybride mi-garçon, mi-cerf, lors d'un périple à travers une Amérique post-apocalyptique.",
                'category' => 'category_Fantastique',
            ],
            [
                'title' => "Shadow and Bone",
                'synopsis' => "Une jeune cartographe découvre qu'elle possède un rare pouvoir qui pourrait changer
                 le sort du monde. Suivra-t-elle sa destinée ou succombera-t-elle aux ténèbres ?",
                'category' => 'category_Fantastique',
            ],
            [
                'title' => "Stranger Things",
                'synopsis' => "Quand un jeune garçon disparaît, une petite ville découvre une affaire mystérieuse,
                 des expériences secrètes, des forces surnaturelles terrifiantes... et une fillette.",
                'category' => 'category_Horreur',
            ],
            [
                'title' => 'Walking Dead',
                'synopsis' => 'Un groupe de survivants doit rester soudé face à une apocalypse zombie.',
                'category' => 'category_Horreur',
            ],
            [
                'title' => 'The Haunting of Hill House',
                'synopsis' => 'Durant l’été 1992, Hugh et Olivia Crain s’installent avec leurs cinq enfants
                 dans le manoir de Hill House. Mais des événements paranormaux et des pertes ... ',
                'category' => 'category_Horreur',
            ],
            [
                'title' => 'The Last Of Us',
                'synopsis' => "Quand le monde tel que vous le connaissiez n'existe plus, quand la ligne entre le bien
                 et le mal devient floue, quand la mort se manifeste au quotidien, jusqu'où iriez-vous pour survivre ?
                  Pour Joel, la survie est une préoccupation quotidienne qu'il gère à sa manière. Mais quand son chemin
                   croise celui d'Ellie, leur voyage à travers ce qui reste des États-Unis va mettre à rude épreuve
                    leur humanité et leur volonté de survivre.",
                'category' => 'category_Horreur',
            ],
            [
                'title' => 'The Originals',
                'synopsis' => 'Le vampire originel Klaus fait son retour au Vieux Carré, un quartier français de la
                 Nouvelle Orléans. Dans cette ville qu’il a aidé à construire quelques siècles plus tôt, il y retrouve
                  son ancien protégé, le diabolique et charismatique Marcel. Dans l’espoir d’aider son jeune frère à
                   trouver la rédemption, Elijah est contraint de s’allier avec des ennemis de Marcel...',
                'category' => 'category_Horreur',
            ],
        ];
    public function load(ObjectManager $manager)
    {
        foreach (self::PROGRAMS as $programCategory) {
            $program = new Program();
            $program->setTitle($programCategory['title']);
            $program->setSynopsis($programCategory['synopsis']);
            $program->setCategory($this->getReference($programCategory['category']));
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
