<?php
namespace AppBundle\Command;

use AppBundle\Entity\Restaurant;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

class CreateRestaurantCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('app:restaurant:add')
            ->setDescription('Allows tou to create a new Restaurant')
            ->setHelp("Give the parameters and let the app create a new Restaurant")
        ;
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $helper = $this->getHelper('question');
        $question = new Question('<fg=yellow>Restaurant Name</> : ');
        $name = $helper->ask($input, $output, $question);
        $restaurant = new Restaurant();
        $restaurant->setName($name);

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $em->persist($restaurant);
        $em->flush();

        $output->writeln('<info>Restaurant '.$name.' successfully generated!</info>');
    }

}
