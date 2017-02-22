<?php
namespace AppBundle\Command;

use AppBundle\Entity\Maid;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateMaidCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:maid:add')
            ->setDescription('Allows tou to create a new Maid')
            ->setHelp("Give the parameters and let the app create a new Maid");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question('<fg=yellow>Maid name</> : ');
        $question1 = new Question('<fg=yellow>Maid address</> : ');
        $question2 = new Question('<fg=yellow>Maid phone</> : ');
        $question3 = new Question('<fg=yellow>Maid email</> : ');
        $question4 = new Question('<fg=yellow>Maid birthdate (j-M-Y)</> : ');
        $question5 = new Question('<fg=yellow>Maid description [null]</> : ', null);
        $question12 = new Question('<fg=yellow>Maid last name </> : ', false);
        $question7 = new Question('<fg=yellow>Maid nickname [Maid]</> : ', 'Maid');
        $question8 = new Question('<fg=yellow>Maid bloodtype[AB]</> : ', 'AB');
        $question9 = new Question('<fg=yellow>Maid favorite things[Cats, POP Music.]</> : ', 'Cats, POP Music.');
        $question10 = new Question('<fg=yellow>Maid blog url[wwww.blog.com]</> : ', 'wwww.blog.com');
        $question11 = new Question('<fg=yellow>Maid twitter url [wwww.twitter.com/maid]</> : ', 'wwww.twitter.com/maid');

        $name = $helper->ask($input, $output, $question);
        $lastname = $helper->ask($input, $output, $question12);
        $date = $helper->ask($input, $output, $question4);
        $birthdate = date_create_from_format('j-M-Y', $date);
        $address = $helper->ask($input, $output, $question1);
        $phone = $helper->ask($input, $output, $question2);
        $email = $helper->ask($input, $output, $question3);
        $description = $helper->ask($input, $output, $question5);

        $maid = new Maid();
        $maidName = $helper->ask($input, $output, $question7);
        $bloodType = $helper->ask($input, $output, $question8);
        $favoriteThings = $helper->ask($input, $output, $question9);
        $blogUrl = $helper->ask($input, $output, $question10);
        $twitterUrl = $helper->ask($input, $output, $question11);

        $maid->setName($name);
        $maid->setLastName($lastname);
        $maid->setAddress($address);
        $maid->setPhone($phone);
        $maid->setEmail($email);
        $maid->setBirthDate($birthdate);
        $maid->setDescription($description);
        $maid->setMaidName($maidName);
        $maid->setBloodType($bloodType);
        $maid->setFavoriteThings($favoriteThings);
        $maid->setBlogUrl($blogUrl);
        $maid->setTwitterUrl($twitterUrl);
        $maid->setProfilePicture('Chimu480.jpg');


        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $em->persist($maid);
        $em->flush();

        $output->writeln('<info>Maid '.$name.' successfully generated!</info>');
    }
}

