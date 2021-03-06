<?php

namespace SqsPhpBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;
use Symfony\Component\Config\FileLocator;




class SqsPhpExtension extends ConfigurableExtension
{

    protected function loadInternal(array $config, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/services')
        );
        $loader->load('services.yml');

        foreach ($config['queues'] as $queue_id => $queue_parameters) {
            $container->setParameter(
                sprintf('sqs_php.queue.%s', $queue_id),
                $queue_parameters
            );
        }
    }

}
