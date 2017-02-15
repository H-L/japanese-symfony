<?php
namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListEmployeesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:employee:list')
            ->setDescription('list employees')
            ->setHelp("Displays employees")
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $employeeRepository = $em->getRepository('AppBundle:Employee');
        $employees = $employeeRepository->find(1);

        var_dump($employees);
        die;
        $output->writeln([
            '<info>Employees</info>',
            '<info>============</info>',
        ]);
        foreach ($employees as $type) {
            $output->writeln('<info>* '.$type->getName().'</info>');
        }
    }

}