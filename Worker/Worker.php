<?php

namespace SqsPhpBundle\Worker;




class Worker
{

    private $sqs_client;
    private $queue_url;




    public function __construct($an_sqs_client, $a_queue_url)
    {
        $this->sqs_client = $an_sqs_client;
        $this->queue_url  = $a_queue_url;
    }




    public function start()
    {
        var_dump($this->sqs_client);
        var_dump($this->queue_url);
        echo "starting";
    }

}
