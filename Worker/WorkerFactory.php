<?php

namespace SqsPhpBundle\Worker;

use SqsPhpBundle\Queue\Queue;
use Aws\Sqs\SqsClient;




class WorkerFactory
{

    private $sqs_client;




    public function __construct(SqsClient $an_sqs_client)
    {
        $this->sqs_client = $an_sqs_client;
    }




    public function build(Queue $a_queue)
    {
        return new Worker($this->sqs_client, $a_queue);
    }

}
