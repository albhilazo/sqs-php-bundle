<?php

namespace SqsPhpBundle\Worker;




class Worker
{

    public function start(array $a_queue)
    {
        var_dump($a_queue);
        echo "starting";
    }

}
