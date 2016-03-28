<?php

namespace SqsPhpBundle\Worker;

use SqsPhpBundle\Queue\Queue;




class WorkerFactory
{

    public function build(Queue $a_queue)
    {
        return new Worker($a_queue);
    }

}
