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
        $employeeRepository = $em->getRepository('AppBundle:Employee');
        
        $helper = $this->getHelper('question');
        $question = new Question('<fg=yellow>TimeSlot start time [ [0, 0, 0] ] </> : ', [0, 0]);
        $question1 = new Question('<fg=yellow>TimeSlot end time [ [23, 59, 59] ]</> : ', [23, 59]);
        $question2 = new Question('<fg=yellow>TimeSlot day of the week</> : ', 0);
        $question3 = new Question('<fg=yellow>Id of the Employee ?</> :' , null);

        $startTime = $helper->ask($input, $output, $question);
        $endTime = $helper->ask($input, $output, $question1);
        $dayOfTheWeek = $helper->ask($input, $output, $question2);
        $employeeId = $helper->ask($input, $output, $question3);

        $timeSlot = new TimeSlot();
        $timeSlot->setStartTime($startTime);
        $timeSlot->setEndTime($endTime);
        $timeSlot->setDayOfWeek($dayOfTheWeek);
        $timeSlot->setEmployee($employeeRepository->find($employeeId));
        
        $em->persist($timeSlot);
        $em->flush();

        $output->writeln('<info>TimeSlot successfully generated!</info>');
    }

}