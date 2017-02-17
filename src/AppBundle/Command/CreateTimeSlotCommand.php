<?php
namespace AppBundle\Command;

use AppBundle\Entity\TimeSlot;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateTimeSlotCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:timeSlot:add')
            ->setDescription('Allows tou to create a new TimeSlot')
            ->setHelp("Give the parameters and let the app create a new TimeSlot")
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $maidRepository = $em->getRepository('AppBundle:Maid');
        
        $helper = $this->getHelper('question');
        $question = new Question('<fg=yellow>TimeSlot start time hour (from 0 to 23) </> : ', 0);
        $question1 = new Question('<fg=yellow>TimeSlot start time minute (from 0 to 59) </> : ', 0);
        $question2 = new Question('<fg=yellow>TimeSlot end time hour (from 0 to 23)</> : ', 23);
        $question3 = new Question('<fg=yellow>TimeSlot end time minute (from 0 to 59)</> : ', 23);
        $question4 = new Question('<fg=yellow>TimeSlot day of the week</> : ', 0);
        $question5 = new Question('<fg=yellow>Id of the Maid ?</> :' , null);

        $startTimeHour = intval($helper->ask($input, $output, $question));
        $startTimeMinute = intval($helper->ask($input, $output, $question1));
        $endTimeHour = intval($helper->ask($input, $output, $question2));
        $endTimeMinute = intval($helper->ask($input, $output, $question3));
        $dayOfTheWeek = intval($helper->ask($input, $output, $question4));
        $maidId = $helper->ask($input, $output, $question5);

        $timeSlot = new TimeSlot();
        $timeSlot->setStartTime([$startTimeHour, $startTimeMinute]);
        $timeSlot->setEndTime([$endTimeHour, $endTimeMinute]);
        $timeSlot->setDayOfWeek($dayOfTheWeek);
        $timeSlot->setMaid($maidRepository->find($maidId));

        $em->persist($timeSlot);
        $em->flush();

        $output->writeln('<info>TimeSlot successfully generated!</info>');
    }
}
