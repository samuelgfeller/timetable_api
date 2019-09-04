<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c)
        {
            $settings = $c->get('settings');
            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);
        
            $processor = new UidProcessor();
            $logger->pushProcessor($processor);
        
            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);
        
            return $logger;
        },
        PDO::class => function (ContainerInterface $c) {
            $dbSettings = $c->get('settings')['db'];
            $dsn = 'mysql:host=' . $dbSettings['host'] . ';dbname=' . $dbSettings['dbname'];
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => false,
            ];
            return new PDO($dsn, $dbSettings['user'], $dbSettings['pass'], $options);
        },
    ]);
};
