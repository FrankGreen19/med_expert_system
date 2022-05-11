<?php


namespace App\Service;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


class AmqpService
{
    const QUEUE_NAME = 'med_test_queue';
    const EXCHANGE_NAME = 'med_test_exchange';

    public static function publishMessage($messageBody)
    {
        try {
            $message = self::createMessage($messageBody);

            $connection = new AMQPStreamConnection($_ENV['AMQP_HOST'],
                $_ENV['AMQP_PORT'],
                $_ENV['AMQP_USER'],
                $_ENV['AMQP_PASSWORD']);
            $channel = $connection->channel(); //тут живут все методы АПИ

            $channel->exchange_declare(self::EXCHANGE_NAME, 'fanout', false,
                true, false);
            $channel->queue_declare(self::QUEUE_NAME, false, true, false, false);
            $channel->queue_bind(self::QUEUE_NAME, self::EXCHANGE_NAME);

            $channel->basic_publish($message, self::EXCHANGE_NAME);

            $channel->close();
            $connection->close();
        } catch (\Exception $exception) {
            //@todo logs
        }
    }

    public static function createMessage($messageBody): AMQPMessage
    {
        return new AMQPMessage(
            $messageBody,
            ['delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]
        );
    }
}