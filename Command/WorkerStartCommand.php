<?php

namespace SqsPhpBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use SqsPhpBundle\Queue\Queue;




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

        $queue_id = $input->getArgument('queue_id');
        $queue_parameters = $container->getParameter(
            sprintf('sqs_php.queue.%s', $queue_id)
        );
        $queue = new Queue($queue_parameters);

        $worker = $container->get('sqs_php.worker');
        $worker->start($queue);
    }

}
