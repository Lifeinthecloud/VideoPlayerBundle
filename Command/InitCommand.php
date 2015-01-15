<?php

namespace Lifeinthecloud\VideoPlayerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\HttpFoundation\Request;

class InitCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('lifeinthecloud:video:init')
            ->setDescription('Init video server player')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $em = $this->getContainer()->get('doctrine')->getManager();

        $list_site = $em->getRepository('PrecomModel:Site')->findAll();
        
        $this->getContainer()->enterScope('request');
        $this->getContainer()->set('request', new Request(), 'request');

        $nb = 0;
        foreach($list_site as $site) {
            if($generateur->genereSite($site->getId())) {
                $nb++;
            }
        }

        $output->writeln('Nombre de site généré : '.$nb);
    }
}