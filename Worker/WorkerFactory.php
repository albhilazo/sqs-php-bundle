<?php

namespace SqsPhpBundle\Worker;

use SqsPhpBundle\Queue\Queue;
use Aws\Sqs\SqsClient;




class WorkerFactory
{

    public function build(Queue $a_queue)
    {
        $client = new SqsClient(array(
            'version' => '2012-11-05',
            'region'  => $a_queue->region()
        ));
        return new Worker($client, $a_queue->url());
    }

}
