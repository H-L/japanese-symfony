<?php
namespace AppBundle\Command;

use AppBundle\Entity\CharacterTrait;
use AppBundle\Entity\Event;
use AppBundle\Entity\Maid;
use AppBundle\Entity\Rank;
use AppBundle\Entity\Restaurant;
use AppBundle\Entity\Review;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\DependencyInjection\Tests\A;

class InitialiseDBCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:initialise:db')
            ->setDescription('Allows tou to create a new Maid')
            ->setHelp("Give the parameters and let the app create a new Maid");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $dropCommand = $this->getApplication()->find('doctrine:schema:drop');
        $createCommand = $this->getApplication()->find('doctrine:schema:create');
        $createUserCommand = $this->getApplication()->find('fos:user:create');
        $promoteUserCommand = $this->getApplication()->find('fos:user:promote');

        $dropArguments = array(
            'command' => 'doctrine:schema:drop',
            '--force'  => true,
        );
        $createArguments = array(
            'command' => 'doctrine:schema:create',
        );
        $userCreateArguments = array(
            'command' => 'fos:user:create',
            'username' => 'testUser',
            'email' => 'test@user.com',
            'password'=> 'testpass'
        );
        $userCreateArguments2 = array(
            'command' => 'fos:user:create',
            'username' => 'adminUser',
            'email' => 'admin@user.com',
            'password'=> 'adminpass'
        );
        $userPromoteArguments = array(
            'command' => 'fos:user:promote',
            'username' => 'adminUser',
            'role' => 'ROLE_ADMIN'
        );

        $dropInput = new ArrayInput($dropArguments);
        $createInput = new ArrayInput($createArguments);
        $createUserInput = new ArrayInput($userCreateArguments);
        $createUserInput2 = new ArrayInput($userCreateArguments2);
        $promoteUserInput = new ArrayInput($userPromoteArguments);

        $dropReturnCode = $dropCommand->run($dropInput, $output);
        $createReturnCode = $createCommand->run($createInput, $output);
        $userCreateReturnCode = $createUserCommand->run($createUserInput, $output);
        $userCreateReturnCode2 = $createUserCommand->run($createUserInput2, $output);
        $userPromoteArguments = $promoteUserCommand->run($promoteUserInput, $output);

        $restaurant = new Restaurant();
        $restaurant->setName('Teishutsu Cafe');
        $restaurant->setAddress('7765 Osaka street');
        $restaurant->setBirthDate(date_create_from_format('j-M-Y', '20-Jan-2010'));
        $restaurant->setDescription('Come and play with us ! It\'s open from monday to friday : 4pm to 2am');
        $restaurant->setEmail('TeishutsuCafe@othome.com');
        $restaurant->setPhone('090-1790-1357');
        $restaurant->setProfilePicture('resto.jpg');

        $restaurant1 = new Restaurant();
        $restaurant1->setName('Teishutsu Fluff');
        $restaurant1->setAddress('7765 Hanoi street');
        $restaurant1->setBirthDate(date_create_from_format('j-M-Y', '1-Jan-2005'));
        $restaurant1->setDescription('Little cute restaurant for you ! It\'s open from monday to friday : 4pm to 2am');
        $restaurant1->setEmail('TeishutsuFluff@athome.com');
        $restaurant1->setPhone('090-1790-1358');
        $restaurant1->setProfilePicture('resto.jpg');

        $review = new Review();
        $review->setRate(5);
        $review->setComment('This was great !');
        $review->setRestaurant($restaurant);
//        $review->setUser(1);

        $review1 = new Review();
        $review1->setRate(1);
        $review1->setComment('This restaurant sucks !');
        $review1->setRestaurant($restaurant1);
//        $review1->setUser(2);

        $characterTrait = new CharacterTrait();
        $characterTrait->setName('Shy');

        $characterTrait1 = new CharacterTrait();
        $characterTrait1->setName('Joyful');

        $rank = new Rank();
        $rank->setName('Super Premium');
        $rank->setValue('1');

        $rank1 = new Rank();
        $rank1->setName('First Maid');
        $rank1->setValue('2');

        $maid = new Maid();
        $maid->setName('Saesenthessis');
        $maid->setLastName('Dragonborn');
        $maid->setAddress('88 abbey road, Vergen');
        $maid->setPhone('+333667887644');
        $maid->setEmail('saskia@dragonslayer.com');
        $maid->setBirthDate(date_create_from_format('j-M-Y', '12-Feb-1990'));
        $maid->setDescription('I hate everybody');
        $maid->setMaidName('Saskia');
        $maid->setBloodType('A+');
        $maid->setFavoriteThings('Dwarves mostly');
        $maid->setBlogUrl('www.sakia.com');
        $maid->setTwitterUrl('wwww.twitter.com/saskia');
        $maid->setProfilePicture('Chimu480.jpg');
        $maid->setRestaurant($restaurant);
        $maid->setCharacterTrait($characterTrait);
        $maid->setRank($rank);

        $maid1 = new Maid();
        $maid1->setName('Katy');
        $maid1->setLastName('MoshiMoshi');
        $maid1->setAddress('66 Kanto street, Kanto');
        $maid1->setPhone('+6789986532');
        $maid1->setEmail('katy@supermaid.com');
        $maid1->setBirthDate(date_create_from_format('j-M-Y', '15-Jan-1997'));
        $maid1->setDescription('I love cats ★ and dogs ★ and food ★');
        $maid1->setMaidName('KawaiiKAT');
        $maid1->setBloodType('AB');
        $maid1->setFavoriteThings('Cats, dogs, food');
        $maid1->setBlogUrl('wwww.kawaiikat.overblog');
        $maid1->setTwitterUrl('wwww.twitter.com/kawaiikat');
        $maid1->setProfilePicture('Chimu480.jpg');
        $maid1->setRestaurant($restaurant);
        $maid1->setCharacterTrait($characterTrait1);
        $maid1->setRank($rank1);

        $review2 = new Review();
        $review2->setRate(1);
        $review2->setComment('Shineeee !');
        $review2->setMaid($maid1);
//        $review2->setUser(1);

        $review3 = new Review();
        $review3->setRate(5);
        $review3->setComment('Daisuki desuuuu');
        $review3->setMaid($maid1);
//        $review3->setUser(2);

        $event = new Event();
        $event->setName('★ 17 ★ 1st Single "summer time / KOKO RO CARAMEL" released!');
        $event->setDescription('It is almost time for summer !!! Listen to this, well ~ ♪ I am going to enjoy summer ♪ " Summer time" is perfect for the summer when the sun glitteringly shines ♪ I decided this summer to be on my side at any time!');
        $event->setStart(date_create_from_format('Y-m-d H:i:s', '2017-02-28 15:00:00'));
        $event->setEnd(date_create_from_format('Y-m-d H:i:s', '2017-02-28 18:00:00'));
        $event->setRestaurant($restaurant);
        $event->setProfilePicture('event.jpg');

        $event1 = new Event();
        $event1->setName('"Gourmetama × Woo ~ Mu Cafe" Collaboration ★');
        $event1->setDescription('It appeared suddenly at the cute cafe \'smansion, with zero motivation! Although it seemingly is a different combination, Wow ~ Mu cafe signboard menu Tama in favor of "Pi Piyo Piyo yo Hiyoko-san Rice" Somehow very ... ... Yu Moe!? Moe moe house, please hold a maid\'s headband Loose ~, motivated ~ ~ We welcome you!');
        $event1->setStart(date_create_from_format('Y-m-d H:i:s', '2017-02-24 15:00:00'));
        $event1->setEnd(date_create_from_format('Y-m-d H:i:s', '2017-02-24 18:00:00'));
        $event1->setRestaurant($restaurant);
        $event1->setProfilePicture('event.jpg');

        $event2 = new Event();
        $event2->setName('We held a press conference of a new costume of cafe (new maid clothes)!');
        $event2->setDescription('It has proven in ★Paris collection★ and Tokyo collection etc. With fashion designer Keita Maruyama. It is a news conference of new maid clothes completed by collaboration! ★ This new maid outfit that has gained popularity in every direction, in all stores except peach from autumn Maids are going to wear! ★');
        $event2->setStart(date_create_from_format('Y-m-d H:i:s', '2017-02-24 15:00:00'));
        $event2->setEnd(date_create_from_format('Y-m-d H:i:s', '2017-02-24 18:00:00'));
        $event2->setRestaurant($restaurant);
        $event2->setProfilePicture('event.jpg');

        $event3 = new Event();
        $event3->setName('Wow ~ Mu cafe \'s visual book with a worldview of the world (photo collection) "The Maid in Wonder Land" has been completed ☆');
        $event3->setDescription('Have a patronage of chefs, your master, your report is to the lady★ ! Produced by the prominent army archer in the creative industry. ★ It is a fantasy-colored artistic photo album, Pop and unrealistic existence of "maid" existence Expressed in tale tailoring. ★ It has become one book that can fully enjoy the charm of maids to their heart\'s content ♪');
        $event3->setStart(date_create_from_format('Y-m-d H:i:s', '2017-02-24 15:00:00'));
        $event3->setEnd(date_create_from_format('Y-m-d H:i:s', '2017-02-24 18:00:00'));
        $event3->setRestaurant($restaurant);
        $event3->setProfilePicture('event.jpg');

        $event4 = new Event();
        $event4->setName('☆ A new single by "@ Ho - Mu Cafe" by luxury creators of Anison world is completed!');
        $event4->setDescription('Lyrics include voice actor Aya Hirano and "Frozen Dessert" "Summer Color Kiseki" We provide lyrics to theme songs of various animation works Queen Kodama Saori of the anison world , Composition offers music to the popular group "SPHIA" and voice actor Eitori Kitamura. ★ He also worked on composing anime songs such as "The Melancholy of Haruhi Suzumiya" "★Mayo Chiki!★ Currently in charge of Anison, Mr. Akihiko Yamaguchi who is a huge attention composer is in charge. ♪');
        $event4->setStart(date_create_from_format('Y-m-d H:i:s', '2017-02-24 15:00:00'));
        $event4->setEnd(date_create_from_format('Y-m-d H:i:s', '2017-02-24 18:00:00'));
        $event4->setRestaurant($restaurant);
        $event4->setProfilePicture('event.jpg');

        $event5 = new Event();
        $event5->setName('★ Shop exclusive new operation maid will be born ★');
        $event5->setDescription('♪ From April 1st, 2017 (Wednesday) We serve as an operation maid. I look forward to your continued support ★ He always supports a cafe "Operation Made" is, but, A new operation maid will be born this time! As an operation maid dedicated to each shop, For your lady / lady who came home Make your shop more enjoyable and more comfortable We aim to cooperate with the responsible person.');
        $event5->setStart(date_create_from_format('Y-m-d H:i:s', '2017-02-24 15:00:00'));
        $event5->setEnd(date_create_from_format('Y-m-d H:i:s', '2017-02-24 18:00:00'));
        $event5->setRestaurant($restaurant);
        $event5->setProfilePicture('event.jpg');

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $em->persist($restaurant);
        $em->persist($restaurant1);
        $em->persist($event);
        $em->persist($event1);
        $em->persist($event2);
        $em->persist($event3);
        $em->persist($event4);
        $em->persist($event5);
        $em->persist($review);
        $em->persist($review1);
        $em->persist($characterTrait);
        $em->persist($characterTrait1);
        $em->persist($rank);
        $em->persist($rank1);
        $em->persist($maid);
        $em->persist($maid1);
        $em->persist($review2);
        $em->persist($review3);
        $em->flush();

        $output->writeln('<info> Database successfully generated!</info>');
    }
}

