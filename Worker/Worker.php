<?php

namespace SqsPhpBundle\Worker;

use SqsPhpBundle\Queue\Queue;




class Worker
{

    private $region;
    private $queue_url;




    public function __construct(Queue $a_queue)
    {
        $this->region    = $a_queue->region();
        $this->queue_url = $a_queue->url();
    }




    public function start()
    {
        echo "starting";
    }

}
