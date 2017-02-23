<?php
namespace AppBundle\Command;

use AppBundle\Entity\CharacterTrait;
use AppBundle\Entity\Event;
use AppBundle\Entity\Maid;
use AppBundle\Entity\Rank;
use AppBundle\Entity\Restaurant;
use AppBundle\Entity\Review;
use AppBundle\Entity\Gallery;
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
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');

        $dropCommand = $this->getApplication()->find('doctrine:schema:drop');
        $createCommand = $this->getApplication()->find('doctrine:schema:create');
        $createUserCommand = $this->getApplication()->find('fos:user:create');
        $promoteUserCommand = $this->getApplication()->find('fos:user:promote');
        $initialiseImagesCommand = $this->getApplication()->find('app:initialise:images');

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
        $initialiseImagesArguments = array(
            'command' => 'app:initialise:images',
        );

        $dropInput = new ArrayInput($dropArguments);
        $createInput = new ArrayInput($createArguments);
        $createUserInput = new ArrayInput($userCreateArguments);
        $createUserInput2 = new ArrayInput($userCreateArguments2);
        $promoteUserInput = new ArrayInput($userPromoteArguments);
        $initialiseImagesInput = new ArrayInput($initialiseImagesArguments);

        $dropReturnCode = $dropCommand->run($dropInput, $output);
        $createReturnCode = $createCommand->run($createInput, $output);
        $userCreateReturnCode = $createUserCommand->run($createUserInput, $output);
        $userCreateReturnCode2 = $createUserCommand->run($createUserInput2, $output);
        $userPromoteArguments = $promoteUserCommand->run($promoteUserInput, $output);
        $initialiseImagesArguments = $initialiseImagesCommand->run($initialiseImagesInput, $output);

        $restaurantProfilePicture = $em->getRepository('AppBundle:Image')->find(2);
        $restaurantProfilePicture1 = $em->getRepository('AppBundle:Image')->find(6);

        $restaurantGallery = new Gallery();
        $restaurantGallery->setName('restaurant');

        for ($i = 1; $i <= 10; $i++) {
            $restaurantGallery->addImage($em->getRepository('AppBundle:Image')->find($i));
            $output->writeln('Image'.$i.' added to '.$restaurantGallery->getName());
        }

        $restaurantGallery1 = new Gallery();
        $restaurantGallery1->setName('restaurant1');

        for ($i = 11; $i <= 20; $i++) {
            $restaurantGallery1->addImage($em->getRepository('AppBundle:Image')->find($i));
            $output->writeln('Image'.$i.' added to '.$restaurantGallery1->getName());
        }

        $restaurant = new Restaurant();
        $restaurant->setName('Teishutsu Cafe');
        $restaurant->setAddress('7765 Osaka street');
        $restaurant->setBirthDate(date_create_from_format('j-M-Y', '20-Jan-2010'));
        $restaurant->setDescription('Come and play with us ! It\'s open from monday to friday : 4pm to 2am');
        $restaurant->setEmail('TeishutsuCafe@othome.com');
        $restaurant->setPhone('090-1790-1357');
        $restaurant->setProfilePicture($em->getRepository('AppBundle:Image')->find(1));
        $restaurant->setGallery($restaurantGallery);

        $restaurant1 = new Restaurant();
        $restaurant1->setName('Teishutsu Fluff');
        $restaurant1->setAddress('7765 Hanoi street');
        $restaurant1->setBirthDate(date_create_from_format('j-M-Y', '1-Jan-2005'));

        $restaurant1->setDescription('Little cute restaurant for you ! It\'s open from monday to friday : 4pm to 2am');
        $restaurant1->setEmail('TeishutsuFluff@athome.com');
        $restaurant1->setPhone('090-1790-1358');
        $restaurant1->setProfilePicture($em->getRepository('AppBundle:Image')->find(2));

        $review = new Review();
        $review->setRate(5);
        $review->setComment('This was great !');
        $review->setRestaurant($restaurant);
        $review->setUser($em->getRepository('AppBundle:User')->find(1));

        $review1 = new Review();
        $review1->setRate(1);
        $review1->setComment('This restaurant sucks !');
        $review1->setRestaurant($restaurant1);
        $review1->setUser($em->getRepository('AppBundle:User')->find(1));

        $review2 = new Review();
        $review2->setRate(4);
        $review2->setComment('The maids are very cute, and funny ! I loved it a lot !!');
        $review2->setRestaurant($restaurant);
        $review2->setUser($em->getRepository('AppBundle:User')->find(2));

        $review3 = new Review();
        $review3->setRate(5);
        $review3->setComment('The staff was super-nice, ultra-cute, and let us into their little world. We played games and sung songs when our food came out. It was definitely an experience.');
        $review3->setRestaurant($restaurant);
        $review3->setUser($em->getRepository('AppBundle:User')->find(1));

        $review4 = new Review();
        $review4->setRate(4);
        $review4->setComment('小姐超可爱 还会给饮料施魔法让它变好喝 蛋包饭很好吃 小姐姐超级可爱超级美！服务超棒 ！！！！！！！！！！就是位置因为楼层施工不是很好找，下次一定还会来(｡･ω･｡)ﾉ');
        $review4->setRestaurant($restaurant);
        $review4->setUser($em->getRepository('AppBundle:User')->find(2));

        $characterTrait = new CharacterTrait();
        $characterTrait->setName('Shy');

        $characterTrait1 = new CharacterTrait();
        $characterTrait1->setName('Joyful');

        $characterTrait2 = new CharacterTrait();
        $characterTrait2->setName('Attentive');

        $characterTrait3 = new CharacterTrait();
        $characterTrait3->setName('Benevolent');

        $characterTrait4 = new CharacterTrait();
        $characterTrait4->setName('Coquettish');

        $characterTrait5 = new CharacterTrait();
        $characterTrait5->setName('Delicate');

        $characterTrait6 = new CharacterTrait();
        $characterTrait6->setName('Sweet');

        $characterTrait7 = new CharacterTrait();
        $characterTrait7->setName('Mysterious');

        $characterTrait8 = new CharacterTrait();
        $characterTrait8->setName('Fiery');

        $characterTrait9 = new CharacterTrait();
        $characterTrait9->setName('Playful');

        $characterTrait10 = new CharacterTrait();
        $characterTrait10->setName('Malicious');

        $rank = new Rank();
        $rank->setName('Super Premium');
        $rank->setValue('1');

        $rank1 = new Rank();
        $rank1->setName('First Maid');
        $rank1->setValue('2');

        $maidGallery = new Gallery();
        $maidGallery->setName('maid');

        for ($i = 1; $i <= 10; $i++) {
            $maidGallery->addImage($em->getRepository('AppBundle:Image')->find($i));
            $output->writeln('Image'.$i.' added to '.$maidGallery->getName());
        }

        $maidGallery1 = new Gallery();
        $maidGallery1->setName('maid1');

        for ($i = 11; $i <= 20; $i++) {
            $maidGallery1->addImage($em->getRepository('AppBundle:Image')->find($i));
            $output->writeln('Image'.$i.' added to '.$maidGallery1->getName());
        }

        $rank1 = new Rank();
        $rank1->setName('Apprentice');
        $rank1->setValue('3');

        $rank2 = new Rank();
        $rank2->setName('Maid');
        $rank2->setValue('2');

        $maid = new Maid();
        $maid->setName('Saesen');
        $maid->setLastName('Dragonborn');
        $maid->setAddress('88 abbey road, Vergen');
        $maid->setPhone('+333667887644');
        $maid->setEmail('saskia@supermaid.com');
        $maid->setBirthDate(date_create_from_format('j-M-Y', '12-Feb-1990'));
        $maid->setDescription('I hate everybody');
        $maid->setMaidName('Saskia');
        $maid->setBloodType('A+');
        $maid->setFavoriteThings('Dwarves mostly');
        $maid->setBlogUrl('www.sakia.com');
        $maid->setTwitterUrl('wwww.twitter.com/saskia');

        $maid->setProfilePicture($em->getRepository('AppBundle:Image')->find(3));
        $maid->setRestaurant($restaurant);
        $maid->setCharacterTrait($characterTrait);
        $maid->setRank($rank);
        $output->writeln('Maid created');

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

        $maid1->setProfilePicture($em->getRepository('AppBundle:Image')->find(4));
        $maid1->setRestaurant($restaurant);
        $maid1->setCharacterTrait($characterTrait1);
        $maid1->setRank($rank1);
        $output->writeln('Maid created');

        $maid2 = new Maid();
        $maid2->setName('Yumi');
        $maid2->setLastName('Adachi');
        $maid2->setAddress('156-0052 Tōkyō-to, Kyōdō');
        $maid2->setPhone('+6789246532');
        $maid2->setEmail('hitomi@supermaid.com');
        $maid2->setBirthDate(date_create_from_format('j-M-Y', '5-Oct-1993'));
        $maid2->setDescription('Hi ! bijour');
        $maid2->setMaidName('Hitomi');
        $maid2->setBloodType('En forme de coeur ♪');
        $maid2->setFavoriteThings('Ribbon ☆ ☆ Mono si Zenbu! ');
        $maid2->setBlogUrl('wwww.yumiyumi.overblog');
        $maid2->setTwitterUrl('wwww.twitter.com/hitomi');
        $maid2->setProfilePicture($em->getRepository('AppBundle:Image')->find(5));
        $maid2->setRestaurant($restaurant);
        $maid2->setCharacterTrait($characterTrait4);
        $maid2->setRank($rank2);
        $output->writeln('Maid created');

        $maid3 = new Maid();
        $maid3->setName('Saki');
        $maid3->setLastName('Aibu');
        $maid3->setAddress('156-0052 Tōkyō-to, Kyōdō');
        $maid3->setPhone('+6789246522');
        $maid3->setEmail('chimu@supermaid.com');
        $maid3->setBirthDate(date_create_from_format('j-M-Y', '1-Aug-1993'));
        $maid3->setDescription('salut ca va');
        $maid3->setMaidName('Chimu');
        $maid3->setBloodType('AB');
        $maid3->setFavoriteThings('Les enfants mignons, les paillettes');
        $maid3->setBlogUrl('wwww.chiminu.overblog');
        $maid3->setTwitterUrl('wwww.twitter.com/chimu_aaa');
        $maid3->setProfilePicture($em->getRepository('AppBundle:Image')->find(6));
        $maid3->setRestaurant($restaurant);
        $maid3->setCharacterTrait($characterTrait10);
        $maid3->setRank($rank2);
        $output->writeln('Maid created');

        $maid4 = new Maid();
        $maid4->setName('Rina');
        $maid4->setLastName('Aizawa');
        $maid4->setAddress('156-0055 Tōkyō-to, Kyōdō');
        $maid4->setPhone('+6717846522');
        $maid4->setEmail('eri@supermaid.com');
        $maid4->setBirthDate(date_create_from_format('j-M-Y', '8-Sep-1991'));
        $maid4->setDescription('salut ca va');
        $maid4->setMaidName('Eri');
        $maid4->setBloodType('C+');
        $maid4->setFavoriteThings('Fleurs bleues, les balancoires');
        $maid4->setBlogUrl('wwww.eri.overblog');
        $maid4->setTwitterUrl('wwww.twitter.com/eri');
        $maid4->setProfilePicture($em->getRepository('AppBundle:Image')->find(7));
        $maid4->setRestaurant($restaurant);
        $maid4->setCharacterTrait($characterTrait2);
        $maid4->setRank($rank2);
        $output->writeln('Maid created');

        $maid5 = new Maid();
        $maid5->setName('Kyoko');
        $maid5->setLastName('Aizome');
        $maid5->setAddress('156-1155 Tōkyō-to, Kyōdō');
        $maid5->setPhone('+6157846522');
        $maid5->setEmail('renachi@supermaid.com');
        $maid5->setBirthDate(date_create_from_format('j-M-Y', '12-Mar-1999'));
        $maid5->setDescription('salut ca va');
        $maid5->setMaidName('Renachi');
        $maid5->setBloodType('Something red');
        $maid5->setFavoriteThings('Fleurs bleues, les balancoires');
        $maid5->setBlogUrl('wwww.renachi.overblog');
        $maid5->setTwitterUrl('wwww.twitter.com/renachi');
        $maid5->setProfilePicture($em->getRepository('AppBundle:Image')->find(8));
        $maid5->setRestaurant($restaurant);
        $maid5->setCharacterTrait($characterTrait2);
        $maid5->setRank($rank2);
        $output->writeln('Maid created');

        $maid6 = new Maid();
        $maid6->setName('Sayaka');
        $maid6->setLastName('Akimoto');
        $maid6->setAddress('156-1199 Tōkyō-to, Kyōdō');
        $maid6->setPhone('+6157846500');
        $maid6->setEmail('lafraise@supermaid.com');
        $maid6->setBirthDate(date_create_from_format('j-M-Y', '4-Aug-1999'));
        $maid6->setDescription('salut ca va');
        $maid6->setMaidName('La fraise');
        $maid6->setBloodType('BChromie');
        $maid6->setFavoriteThings('Fleurs bleues, les balancoires');
        $maid6->setBlogUrl('wwww.lafraise.overblog');
        $maid6->setTwitterUrl('wwww.twitter.com/lafraise');
        $maid6->setProfilePicture($em->getRepository('AppBundle:Image')->find(9));
        $maid6->setRestaurant($restaurant);
        $maid6->setCharacterTrait($characterTrait6);
        $maid6->setRank($rank2);

        $maid7 = new Maid();
        $maid7->setName('Yoko');
        $maid7->setLastName('Akino');
        $maid7->setAddress('156-1909 Tōkyō-to, Kyōdō');
        $maid7->setPhone('+6157842370');
        $maid7->setEmail('kanata@supermaid.com');
        $maid7->setBirthDate(date_create_from_format('j-M-Y', '4-Aug-1999'));
        $maid7->setDescription('salut ca va');
        $maid7->setMaidName('Kanata');
        $maid7->setBloodType('Akuna kanata');
        $maid7->setFavoriteThings('Rien du tout');
        $maid7->setBlogUrl('wwww.kanata.overblog');
        $maid7->setTwitterUrl('wwww.twitter.com/kanata');
        $maid7->setProfilePicture($em->getRepository('AppBundle:Image')->find(10));
        $maid7->setRestaurant($restaurant);
        $maid7->setCharacterTrait($characterTrait3);
        $maid7->setRank($rank2);

        $maid8 = new Maid();
        $maid8->setName('Rio');
        $maid8->setLastName('Akisada');
        $maid8->setAddress('156-1909 Tōkyō-to, Kyōdō');
        $maid8->setPhone('+6157842370');
        $maid8->setEmail('shiemi@supermaid.com');
        $maid8->setBirthDate(date_create_from_format('j-M-Y', '4-Aug-1999'));
        $maid8->setDescription('salut ca va');
        $maid8->setMaidName('Shiemi');
        $maid8->setBloodType('A caramba');
        $maid8->setFavoriteThings('Les prunes et les fraises, les coeurs tout ronds');
        $maid8->setBlogUrl('wwww.shiemi.overblog');
        $maid8->setTwitterUrl('wwww.twitter.com/shiemi');
        $maid8->setProfilePicture($em->getRepository('AppBundle:Image')->find(11));
        $maid8->setRestaurant($restaurant);
        $maid8->setCharacterTrait($characterTrait3);
        $maid8->setRank($rank2);

        $review5 = new Review();
        $review5->setRate(1);
        $review5->setComment('Shineeee !');
        $review5->setMaid($maid1);
        $review5->setUser();

        $review6 = new Review();
        $review6->setRate(5);
        $review6->setComment('Daisuki desuuuu');
        $review6->setMaid($maid1);
        //        $review6->setUser(7);

        $review7 = new Review();
        $review7->setRate(3);
        $review7->setComment('I love you ! You are the most beautiful maid in the world !!!');
        $review7->setMaid($maid2);
        //        $review7->setUser(8);

        $event = new Event();
        $event->setName('★ 17 ★ 1st Single "summer time / KOKO RO CARAMEL" released!');
        $event->setDescription('It is almost time for summer !!! Listen to this, well ~ ♪ I am going to enjoy summer ♪ " Summer time" is perfect for the summer when the sun glitteringly shines ♪ I decided this summer to be on my side at any time!');
        $event->setStart(date_create_from_format('Y-m-d H:i:s', '2017-02-28 15:00:00'));
        $event->setEnd(date_create_from_format('Y-m-d H:i:s', '2017-02-28 18:00:00'));
        $event->setRestaurant($restaurant);
        $event->setProfilePicture($em->getRepository('AppBundle:Image')->find(12));

        $event1 = new Event();
        $event1->setName('"Gourmetama × Woo ~ Mu Cafe" Collaboration ★');
        $event1->setDescription('It appeared suddenly at the cute cafe \'smansion, with zero motivation! Although it seemingly is a different combination, Wow ~ Mu cafe signboard menu Tama in favor of "Pi Piyo Piyo yo Hiyoko-san Rice" Somehow very ... ... Yu Moe!? Moe moe house, please hold a maid\'s headband Loose ~, motivated ~ ~ We welcome you!');
        $event1->setStart(date_create_from_format('Y-m-d H:i:s', '2017-02-24 15:00:00'));
        $event1->setEnd(date_create_from_format('Y-m-d H:i:s', '2017-02-24 18:00:00'));
        $event1->setRestaurant($restaurant);
        $event1->setProfilePicture($em->getRepository('AppBundle:Image')->find(13));

        $event2 = new Event();
        $event2->setName('We held a press conference of a new costume of cafe (new maid clothes)!');
        $event2->setDescription('It has proven in ★Paris collection★ and Tokyo collection etc. With fashion designer Keita Maruyama. It is a news conference of new maid clothes completed by collaboration! ★ This new maid outfit that has gained popularity in every direction, in all stores except peach from autumn Maids are going to wear! ★');
        $event2->setStart(date_create_from_format('Y-m-d H:i:s', '2017-02-24 15:00:00'));
        $event2->setEnd(date_create_from_format('Y-m-d H:i:s', '2017-02-24 18:00:00'));
        $event2->setRestaurant($restaurant);
        $event2->setProfilePicture($em->getRepository('AppBundle:Image')->find(14));

        $event3 = new Event();
        $event3->setName('Wow ~ Mu cafe \'s visual book with a worldview of the world (photo collection) "The Maid in Wonder Land" has been completed ☆');
        $event3->setDescription('Have a patronage of chefs, your master, your report is to the lady★ ! Produced by the prominent army archer in the creative industry. ★ It is a fantasy-colored artistic photo album, Pop and unrealistic existence of "maid" existence Expressed in tale tailoring. ★ It has become one book that can fully enjoy the charm of maids to their heart\'s content ♪');
        $event3->setStart(date_create_from_format('Y-m-d H:i:s', '2017-02-24 15:00:00'));
        $event3->setEnd(date_create_from_format('Y-m-d H:i:s', '2017-02-24 18:00:00'));
        $event3->setRestaurant($restaurant);
        $event3->setProfilePicture($em->getRepository('AppBundle:Image')->find(15));

        $event4 = new Event();
        $event4->setName('☆ A new single by "@ Ho - Mu Cafe" by luxury creators of Anison world is completed!');
        $event4->setDescription('Lyrics include voice actor Aya Hirano and "Frozen Dessert" "Summer Color Kiseki" We provide lyrics to theme songs of various animation works Queen Kodama Saori of the anison world , Composition offers music to the popular group "SPHIA" and voice actor Eitori Kitamura. ★ He also worked on composing anime songs such as "The Melancholy of Haruhi Suzumiya" "★Mayo Chiki!★ Currently in charge of Anison, Mr. Akihiko Yamaguchi who is a huge attention composer is in charge. ♪');
        $event4->setStart(date_create_from_format('Y-m-d H:i:s', '2017-02-24 15:00:00'));
        $event4->setEnd(date_create_from_format('Y-m-d H:i:s', '2017-02-24 18:00:00'));
        $event4->setRestaurant($restaurant);
        $event4->setProfilePicture($em->getRepository('AppBundle:Image')->find(16));

        $event5 = new Event();
        $event5->setName('★ Shop exclusive new operation maid will be born ★');
        $event5->setDescription('♪ From April 1st, 2017 (Wednesday) We serve as an operation maid. I look forward to your continued support ★ He always supports a cafe "Operation Made" is, but, A new operation maid will be born this time! As an operation maid dedicated to each shop, For your lady / lady who came home Make your shop more enjoyable and more comfortable We aim to cooperate with the responsible person.');
        $event5->setStart(date_create_from_format('Y-m-d H:i:s', '2017-02-24 15:00:00'));
        $event5->setEnd(date_create_from_format('Y-m-d H:i:s', '2017-02-24 18:00:00'));
        $event5->setRestaurant($restaurant);
        $event5->setProfilePicture($em->getRepository('AppBundle:Image')->find(17));

        $em->persist($em->getRepository('AppBundle:Image')->find(2));
        $em->persist($em->getRepository('AppBundle:Image')->find(2));
        $em->persist($maidGallery);
        $em->persist($maidGallery1);
        $em->persist($restaurantProfilePicture);
        $em->persist($restaurantProfilePicture1);
        $em->persist($restaurantGallery);
        $em->persist($restaurantGallery1);
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
        $em->persist($review2);
        $em->persist($review3);
        $em->persist($review4);
        $em->persist($characterTrait);
        $em->persist($characterTrait1);
        $em->persist($characterTrait2);
        $em->persist($characterTrait3);
        $em->persist($characterTrait4);
        $em->persist($characterTrait5);
        $em->persist($characterTrait6);
        $em->persist($characterTrait7);
        $em->persist($characterTrait8);
        $em->persist($characterTrait9);
        $em->persist($characterTrait10);
        $em->persist($rank);
        $em->persist($rank1);
        $em->persist($rank2);
        $em->persist($maid);
        $em->persist($maid1);
        $em->persist($maid2);
        $em->persist($maid3);
        $em->persist($maid4);
        $em->persist($maid5);
        $em->persist($maid6);
        $em->persist($maid7);
        $em->persist($maid8);
        $em->persist($review5);
        $em->persist($review6);
        $em->persist($review7);
        $em->persist($event);
        $em->persist($event1);
        $em->persist($event2);
        $em->persist($event3);
        $em->persist($event4);
        $em->persist($event5);
        $em->flush();

        $output->writeln('<info> Database successfully generated!</info>');
    }
}
