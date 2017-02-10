#!/usr/bin/env php
<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require __DIR__.'/vendor/autoload.php';

use Command\PatternOfTheDayCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Dotenv\Dotenv;

$config = new Dotenv();
$config->load(__DIR__.'/.env');

$command = new PatternOfTheDayCommand();

$application = new Application('patternoftheday', '0.0.1');
$application->add($command);
$application->setDefaultCommand($command->getName());

$application->run();
