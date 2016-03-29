<?php

namespace SqsPhpBundle\Worker;

use SqsPhpBundle\Queue\Queue;
use Aws\Sqs\SqsClient;




class Worker
{

    private $sqs_client;
    private $queue_url;
    private $callable;




    public function __construct(SqsClient $an_sqs_client, Queue $a_queue)
    {
        $this->sqs_client = $an_sqs_client;
        $this->queue_url  = $a_queue->url();
        $this->callable   = $a_queue->worker();
    }




    public function start()
    {
        while (true) {
            $this->fetchMessage();
        }
    }




    private function fetchMessage()
    {
        $result = $this->sqs_client->receiveMessage(array(
            'QueueUrl' => $this->queue_url,
        ));

        if (!$result->hasKey('Messages')) {
            return;
        }

        $all_messages = $result->get('Messages');
        foreach ($all_messages as $message) {
            call_user_func($this->callable, $message['Body']);
        }
    }

}
