<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;

class FindOneEmployeeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:employee:find')
            ->setDescription('list employees')
            ->setHelp("Displays employees")
            ->addArgument('id', InputArgument::REQUIRED, 'The The id of the employee you want to find.')
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $employeeRepository = $em->getRepository('AppBundle:Employee');
        $employee = $employeeRepository->find($input->getArgument('id'));

        $output->writeln([
            '<info>'.$employee->getName().'</info>',
            '<info>============</info>',
        ]);

        $output->writeln('<info>* id :'.$employee->getId().'</info>');
        $output->writeln('<info>* name :'.$employee->getName().'</info>');
        $output->writeln('<info>* last name :'.$employee->getLastName().'</info>');

        $timeSlots = $employee->getTimeSlots();
        foreach ($timeSlots as $timeSlot) {
            $output->writeln('<info>* TimeSlot : '.$timeSlot->getStartTime()[0].' '.$timeSlot->getEndTime()[0].' day : '.$timeSlot->getDayOfWeek().'</info>');
        }
    }
}
