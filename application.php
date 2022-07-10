#!/usr/bin/env php
<?php

if (version_compare(PHP_VERSION, '7.1.0', '<')) {
    echo 'Please use php version 7.1 or higher. Your version is: ' . PHP_VERSION . "\n";
    exit;
}

require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Console\Application;
use ElementGenerator\Command\CsvJsonConverterCommand;

$command = new CsvJsonConverterCommand();
$application = new Application();
$application->add($command);
$application->setDefaultCommand($command->getName(), true);
$application->run();
