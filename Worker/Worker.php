<?php

namespace SqsPhpBundle\Worker;




class Worker
{

    private $sqs_client;
    private $queue_url;
    private $callable;




    public function __construct($an_sqs_client, $a_queue_url, $a_callable)
    {
        $this->sqs_client = $an_sqs_client;
        $this->queue_url  = $a_queue_url;
        $this->callable   = $a_callable;
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
