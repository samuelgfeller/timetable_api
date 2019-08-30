<?php


use Psr\Container\ContainerInterface;

class LocationService
{
    private $container;
    
    public function __construct(ContainerInterface $container) {
        $this->container = $container;
    }
}
