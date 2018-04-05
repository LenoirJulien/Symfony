<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Filesystem\Filesystem;

class TestCommand extends ContainerAwareCommand
{
    protected static $defaultName = 'test';

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
    	$fs=new Filesystem();
        $io = new SymfonyStyle($input, $output);
        $argument = $input->getArgument('arg1');

        if ($input->getOption('option1')) {

        }
        $root=$this->getContainer()->get('kernel')->getProjectDir();
        $templatePath=$this->getContainer()->get("twig")->getLoader()->getSourceContext("base.html.twig")->getPath();
        $fs->dumpFile("zz.txt", $path);

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');
    }

}
