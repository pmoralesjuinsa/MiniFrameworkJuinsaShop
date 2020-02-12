<?php
require_once dirname(__DIR__).'/vendor/autoload.php';
use Juinsa\Kernel;
use Kint;

$kernel = new Kernel();
Kint::dump($kernel);