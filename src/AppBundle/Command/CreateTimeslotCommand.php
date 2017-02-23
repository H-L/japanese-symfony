<?php
namespace AppBundle\Command;

use AppBundle\Entity\Timeslot;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateTimeslotCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:timeslot:add')
            ->setDescription('Allows tou to create a new Timeslot')
            ->setHelp("Give the parameters and let the app create a new Timeslot")
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $maidRepository = $em->getRepository('AppBundle:Maid');

        $helper = $this->getHelper('question');
        $question = new Question('<fg=yellow>Timeslot start time hour (from 0 to 23) </> : ', 0);
        $question1 = new Question('<fg=yellow>Timeslot start time minute (from 0 to 59) </> : ', 0);
        $question2 = new Question('<fg=yellow>Timeslot end time hour (from 0 to 23)</> : ', 23);
        $question3 = new Question('<fg=yellow>Timeslot end time minute (from 0 to 59)</> : ', 23);
        $question4 = new Question('<fg=yellow>Timeslot day of the week</> : ', 0);
        $question5 = new Question('<fg=yellow>Id of the Maid ?</> :' , null);

        $startTimeHour = intval($helper->ask($input, $output, $question));
        $startTimeMinute = intval($helper->ask($input, $output, $question1));
        $endTimeHour = intval($helper->ask($input, $output, $question2));
        $endTimeMinute = intval($helper->ask($input, $output, $question3));
        $dayOfTheWeek = intval($helper->ask($input, $output, $question4));
        $maidId = $helper->ask($input, $output, $question5);

        $timeslot = new Timeslot();
        $timeslot->setStartHour($startTimeHour);
        $timeslot->setStartMinute($startTimeMinute);
        $timeslot->setEndHour($endTimeHour);
        $timeslot->setEndMinute($endTimeMinute);
        $timeslot->setDayOfWeek($dayOfTheWeek);
        $timeslot->setMaid($maidRepository->find($maidId));

        $em->persist($timeslot);
        $em->flush();

        $output->writeln('<info>Timeslot successfully generated!</info>');
    }
}
