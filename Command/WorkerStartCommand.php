<?php

namespace SqsPhpBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;




class WorkerStartCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('sqs:worker:start')
            ->setDescription('Start a worker that will listen to the SQS queue')
            ->addArgument(
                'queue_id',
                InputArgument::REQUIRED,
                'Queue ID specified in app config'
            )
        ;
    }




    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $container = $this->getContainer();

        $worker   = $container->get('sqs_worker');
        $queues   = $container->getParameter('sqs_php.queues');
        $queue_id = $input->getArgument('queue_id');

        $worker->start($queues[$queue_id]);
    }

}
