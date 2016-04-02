# sqs-php-bundle

A Symfony3 bundle to help using [Amazon SQS](https://aws.amazon.com/sqs) queues in PHP.


## Installation

Add and require the bundle repository in your Symfony application's `composer.json`.

```json
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/albhilazo/sqs-php-bundle"
    }
],
"require": {
    "albhilazo/sqs-php-bundle": "dev-master"
},
```

Update your dependencies.

```shell
$ composer update
```


## Configuration

First, enable the bundle in the `app/AppKernel.php` file.

```php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new SqsPhpBundle\SqsPhpBundle(),
        );

        // ...
    }

    // ...
}
```

Then, add the bundle configuration in the `app/config/config.yml`.

```yml
sqs_php:
    queues:
        <queue_id>:  # An id of your choice, for example "db_queue"
            url: "%sqs_url%"  # required
            worker: ['<worker_class_path>', '<worker_static_method_to_call>']  # only to receive
```

The `queues` node accepts a list of queue configurations, each identified by a unique string.
The configuration will change based on how the queue will be used in the application.
If the application will be sending messages to the queue, only the `url` parameter is needed.
If it will receive messages from the queue, the configuration must also specify a **static** worker callable that will be called with the received data.

The `url` configuration should be set using the application's parameters (`"%sqs_url%"`), which will be defined in the `app/config/parameters.yml` file.
Here you can also declare an AWS region parameter that will default to `eu-west-1` if not specified.

**It is strongly recommended that the `app/config/parameters.yml` file is not tracked in your repository. This way your configuration values won't be shared.**

```yml
parameters:
    sqs_php.region: <your_aws_region>
    sqs_url: <your_sqs_queue_url>
```

### Configuration example

The following example shows the configuration for an application that receives messages from `foo_queue` and sends to `bar_queue`.
The `AppBundle\Services\GetMessage::get($message)` method will be called with the message's contents as its first argument.

```yml
# app/config/parameters.yml
parameters:
    sqs_php.region: eu-west-1
    sqs_foo_url: https://sqs.eu-west-1.amazonaws.com/0123456789/example_queue_foo
    sqs_bar_url: https://sqs.eu-west-1.amazonaws.com/0123456789/example_queue_bar

# app/config/config.yml
sqs_php:
    queues:
        foo_queue:
            url: "%sqs_foo_url%"
            worker: ['AppBundle\Services\GetMessage', 'get']
        bar_queue:
            url: "%sqs_bar_url%"
```

### AWS credentials

As [recommended by Amazon](http://docs.aws.amazon.com/aws-sdk-php/v2/guide/credentials.html#credential-profiles), the bundle does not need any AWS credentials configuration.
Instead, the AWS SDK uses a credentials file placed at the home directory: `~/.aws/credentials`.

This ensures that your credentials won't be included in any project or repository.

Check the [official documentation](https://aws.amazon.com/documentation/iam) for more details on how to get your credentials file.


## Usage

### Send message

The bundle uses the [Symfony Service Container](http://symfony.com/doc/current/book/service_container.html) to provide the SQS client that will send the message.

```php
$sqs_php_client = $container->get('sqs_php.client');
$sqs_php_client->send(<queue_id>, <message_content>);
```

The `send` method accepts anything but PHP objects as the message content, from strings to associative arrays.

Following the previous configuration example:

```php
$sqs_php_client = $container->get('sqs_php.client');
$sqs_php_client->send('bar_queue', array( "foo" => "bar" ));
```

### Receive message

To receive messages, the `sqs:worker:start` Symfony command is provided.

```shell
$ bin/console sqs:worker:start <queue_id>
```

To start a worker listening to the `foo_queue` whe would execute:

```shell
$ bin/console sqs:worker:start foo_queue
```

And as previously explained, each received message would be passed to the `AppBundle\Services\GetMessage::get($message)` method.
