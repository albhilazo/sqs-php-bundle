<?php

namespace SqsPhpBundle\Queue;




class Queue
{

    private $region;
    private $url;
    private $worker;




    public function __construct(array $queue_parameters)
    {
        $this->region = $queue_parameters['region'];
        $this->url    = $queue_parameters['url'];
        $this->worker = $queue_parameters['worker'];
    }




    public function region()
    {
        return $this->region;
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
