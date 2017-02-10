#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

use Fourxxi\Command\PatternOfTheDayCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Dotenv\Dotenv;

$config = new Dotenv();
$config->load(__DIR__.'/.env');

$command = new PatternOfTheDayCommand();

$application = new Application('patternoftheday', '0.0.1');
$application->add($command);
$application->setDefaultCommand($command->getName());

$application->run();
