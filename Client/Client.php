<?php

namespace SqsPhpBundle\Client;

use Aws\Sqs\SqsClient;




class Client
{

    private $sqs_client;




    public function __construct(SqsClient $an_sqs_client)
    {
        $this->sqs_client = $an_sqs_client;
    }

}
