<?php
namespace AppBundle\Command;

use AppBundle\Entity\Employee;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateEmployeeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:employee:add')
            ->setDescription('Allows tou to create a new Employee')
            ->setHelp("Give the parameters and let the app create a new Employee");
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question('<fg=yellow>Employee name</> : ');
        $question1 = new Question('<fg=yellow>Employee address</> : ');
        $question2 = new Question('<fg=yellow>Employee phone</> : ');
        $question3 = new Question('<fg=yellow>Employee email</> : ');
        $question4 = new Question('<fg=yellow>Employee birthdate (j-M-Y)</> : ');
        $question5 = new Question('<fg=yellow>Employee description [null]</> : ', null);
        $question6 = new Question('<fg=yellow>Is the Employee a Maid ? [false]</> : ', false);
        $question12 = new Question('<fg=yellow>Employee last name </> : ', false);

        $name = $helper->ask($input, $output, $question);
        $lastname = $helper->ask($input, $output, $question12);
        $date = $helper->ask($input, $output, $question4);
        $birthdate = date_create_from_format('j-M-Y', $date);
        $address = $helper->ask($input, $output, $question1);
        $phone = $helper->ask($input, $output, $question2);
        $email = $helper->ask($input, $output, $question3);
        $description = $helper->ask($input, $output, $question5);
        $isMaid = $helper->ask($input, $output, $question6);

        $employee = new Employee();

        if ($isMaid == true) {
            $question7 = new Question('<fg=yellow>Maid nickname [Maid]</> : ', 'Maid');
            $question8 = new Question('<fg=yellow>Maid bloodtype[AB]</> : ', 'AB');
            $question9 = new Question('<fg=yellow>Maid favorite things[Cats, POP Music.]</> : ', 'Cats, POP Music.');
            $question10 = new Question('<fg=yellow>Maid blog url[wwww.blog.com]</> : ', 'wwww.blog.com');
            $question11 = new Question('<fg=yellow>Maid twitter url [wwww.twitter.com/maid]</> : ', 'wwww.twitter.com/maid');

            $maidName = $helper->ask($input, $output, $question7);
            $bloodType = $helper->ask($input, $output, $question8);
            $favoriteThings = $helper->ask($input, $output, $question9);
            $blogUrl = $helper->ask($input, $output, $question10);
            $twitterUrl = $helper->ask($input, $output, $question11);

            $employee->setMaidName($maidName);
            $employee->setBloodType($bloodType);
            $employee->setFavoriteThings($favoriteThings);
            $employee->setBlogUrl($blogUrl);
            $employee->setTwitterUrl($twitterUrl);
        }

        $employee->setName($name);
        $employee->setLastName($lastname);
        $employee->setAddress($address);
        $employee->setPhone($phone);
        $employee->setEmail($email);
        $employee->setBirthDate($birthdate);
        $employee->setDescription($description);

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $em->persist($employee);
        $em->flush();

        $output->writeln('<info>Employee '.$name.' successfully generated!</info>');
    }
}

