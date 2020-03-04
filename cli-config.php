<?php

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
require 'bootstrap.php';

// Paths to Entities that we want Doctrine to see
$paths = array(
    "src/db/entitiesNEW"
);

// Tells Doctrine what mode we want
$isDevMode = true;

// Doctrine connection configuration
$dbParams = array(
    'driver' => 'pdo_mysql',
    'host' => 'juinsa_shop_db',
    'user' => 'user',
    'password' => 'password',
    'dbname' => 'juinsa_shop'
);

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
return ConsoleRunner::createHelperSet($entityManager);