<?php
ini_set('max_execution_time', 300);

require_once(__DIR__ . '/vendor/autoload.php');

use Facebook\WebDriver\Remote\HttpCommandExecutor;
use Facebook\WebDriver\Remote\WebDriverCommand;
use Facebook\WebDriver\Remote\DriverCommand;
use Facebook\WebDriver\Remote\RemoteStatus;

$selenium_server_url = 'http://localhost:4444/wd/hub';
$timeout_in_ms = 30000;

$executor = new HttpCommandExecutor($selenium_server_url, null, null);
$executor->setConnectionTimeout($timeout_in_ms);

$command = new WebDriverCommand(
    null,
    DriverCommand::STATUS,
    []
);

$status = RemoteStatus::createFromResponse($executor->execute($command)->getValue());
var_dump($status->getMeta()["nodes"][0]["sessions"]);
