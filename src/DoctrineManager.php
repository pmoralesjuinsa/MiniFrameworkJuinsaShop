<?php


namespace Juinsa;


use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Setup;
use Juinsa\config\Config;

class DoctrineManager
{
    public EntityManager $em;

    public function __construct()
    {
        $dbConfig = Config::getDB();
        $paths = [
            dirname(__DIR__ . '/db/entities'),
            dirname(__DIR__ . 'db/repositories')
        ];

        $isDevmode = true;

        $config = Setup::createAnnotationMetadataConfiguration($paths, $isDevmode, null, null, false);
        AnnotationRegistry::registerLoader('class_exists');;
        $this->em = EntityManager::create($dbConfig, $config);
    }
}