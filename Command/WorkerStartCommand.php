<?php

namespace SqsPhpBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;




class WorkerStartCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('sqs:worker:start')
            ->setDescription('Start a worker that will listen to the SQS queue')
        ;
    }




    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $worker = $this->getContainer()->get('sqs_worker');
        $worker->start();
    }

}
