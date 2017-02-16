<?php
namespace AppBundle\Command;

use AppBundle\Entity\Maid;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\ArrayInput;

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
        $dropArguments = array(
            'command' => 'doctrine:schema:drop',
            '--force'  => true,
        );
        $createArguments = array(
            'command' => 'doctrine:schema:create',
        );
        $dropInput = new ArrayInput($dropArguments);
        $createInput = new ArrayInput($createArguments);
        $dropReturnCode = $dropCommand->run($dropInput, $output);
        $createReturnCode = $createCommand->run($createInput, $output);

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

        $maid1 = new Maid();
        $maid1->setName('Katy');
        $maid1->setLastName('MoshiMoshi');
        $maid1->setAddress('66 Kanto street, Kanto');
        $maid1->setPhone('+6789986532');
        $maid1->setEmail('katy@supermaid.com');
        $maid1->setBirthDate(date_create_from_format('j-M-Y', '15-Jan-1997'));
        $maid1->setDescription('I love cats and dogs and food');
        $maid1->setMaidName('KawaiiKAT');
        $maid1->setBloodType('AB');
        $maid1->setFavoriteThings('Cats, dogs, food');
        $maid1->setBlogUrl('wwww.kawaiikat.overblog');
        $maid1->setTwitterUrl('wwww.twitter.com/kawaiikat');

        $em = $this->getContainer()->get('doctrine.orm.entity_manager');
        $em->persist($maid);
        $em->persist($maid1);
        $em->flush();

        $output->writeln('<info> Maids successfully generated!</info>');
    }
}

