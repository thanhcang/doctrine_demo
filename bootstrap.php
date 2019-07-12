<?php
require_once "vendor/autoload.php";

use Doctrine\Common\Annotations\AnnotationReader;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$paths     = [__DIR__ . '/src/'];
$isDevMode = false;

// the connection configuration
$dbParams = [
    'driver'   => 'pdo_mysql',
    'user'     => 'root',
    'password' => '12345678',
    'dbname'   => 'doctrine',
];

$cache = new \Doctrine\Common\Cache\ArrayCache();

$reader = new AnnotationReader();
$driver = new \Doctrine\ORM\Mapping\Driver\AnnotationDriver($reader, $paths);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$config->setMetadataCacheImpl( $cache );
$config->setQueryCacheImpl( $cache );
$config->setMetadataDriverImpl( $driver );

//$config        = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
