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
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get('settings');
            $loggerSettings = $settings['logger'];
            $logger = new Logger($loggerSettings['name']);
            
            $processor = new UidProcessor();
            $logger->pushProcessor($processor);
            
            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);
            
            return $logger;
        },
        'db1' => function (ContainerInterface $c) {
            $db1Settings = $c->get('settings')['db1'];
            $pdo = new PDO('mysql:host=' . $db1Settings['host'] . ';dbname=' . $db1Settings['dbname'],
                $db1Settings['user'], $db1Settings['pass']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $pdo;
        },
        'db2' => function (ContainerInterface $c) {
            $db2Settings = $c->get('settings')['db2'];
            $pdo = new PDO('mysql:host=' . $db2Settings['host'] . ';dbname=' . $db2Settings['dbname'],
                $db2Settings['user'], $db2Settings['pass']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            return $pdo;
        },
    
    ]);
};
