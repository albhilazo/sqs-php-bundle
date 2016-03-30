<?php

namespace SqsPhpBundle\Client;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerAwareTrait;
use Aws\Sqs\SqsClient;




class Client implements ContainerAwareInterface
{

    use ContainerAwareTrait;




    private $sqs_client;




    public function __construct(SqsClient $an_sqs_client)
    {
        $this->sqs_client = $an_sqs_client;
    }




    public function send($a_queue_id, $a_message)
    {
        $queue_parameters = $this->container->getParameter(
            sprintf('sqs_php.queue.%s', $a_queue_id)
        );

        $this->sqs_client->sendMessage(array(
            'QueueUrl'    => $queue_parameters['url'],
            'MessageBody' => $this->serializeMessage($a_message)
        ));
    }




    protected function serializeMessage($a_message)
    {
        return json_encode($a_message);
    }

}
