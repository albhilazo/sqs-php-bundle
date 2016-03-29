<?php

namespace SqsPhpBundle\Queue;




class Queue
{

    private $url;
    private $worker;




    public function __construct(array $queue_parameters)
    {
        $this->url    = $queue_parameters['url'];
        $this->worker = $queue_parameters['worker'];
    }




    public function url()
    {
        return $this->url;
    }




    public function worker()
    {
        return $this->worker;
    }

}
