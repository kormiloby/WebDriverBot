<?php
ini_set('max_execution_time', 300);

require_once(__DIR__ . '/vendor/autoload.php');

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Chrome\ChromeOptions;
use Facebook\WebDriver\WebDriverBy as By;

$host = 'http://localhost:4444/wd/hub';

$options = new ChromeOptions();
$options->addArguments(array(
	'--headless',
	'--window-size=1280x800',
	'--disable-gpu',
	'--no-sandbox',
	'--browserSessionReuse'
));

$capabilities = DesiredCapabilities::chrome();
$capabilities->setCapability(ChromeOptions::CAPABILITY, $options);

$driver = RemoteWebDriver::create($host, $capabilities);
echo "session ID = ", $driver->getSessionID();
$status = $driver->getStatus();

$driver->get("http://www.instagram.com");

sleep(4);

$input = $driver->findElements(By::cssSelector("input"));

sleep(3);

$input[0]->sendKeys(["value" => "kormilo@tut.by"]);
$input[1]->sendKeys(["value" => "1qazxsw2"]);
// var_dump($test);

$button = $driver->findElements(By::cssSelector('button[type="submit"]'));
// var_dump(count($button));
$button[0]->click();
sleep(4);

$div = $driver->findElements(By::cssSelector(".cmbtv button"));
// var_dump($div);
$div[0]->click();
sleep(5);
$driver->takeScreenshot('screenshot.png');
