<?php

namespace SqsPhpBundle\Queue;




class Queue
{

    private $region;
    private $url;




    public function __construct(array $queue_parameters)
    {
        $this->region = $queue_parameters['region'];
        $this->url    = $queue_parameters['url'];
    }




    public function region()
    {
        return $this->region;
    }




    public function url()
    {
        return $this->url;
    }

}
