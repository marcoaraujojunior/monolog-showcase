<?php
require_once('bootstrap.php');

use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Processor\GitProcessor;
use Monolog\Processor\MemoryUsageProcessor;
use Monolog\Processor\MemoryPeakUsageProcessor;
use Monolog\Processor\ProcessIdProcessor;
use Monolog\Handler\SlackHandler;

$logger = new Logger('Showcase');

$logger->pushHandler(new StreamHandler(__DIR__.'/log/test.log', Logger::DEBUG));
$logger->pushHandler(new BrowserConsoleHandler());
$logger->pushHandler(new SlackHandler('xoxp-51779102419-51819647030-51840190226-c3cb4ad87e', '#log'));

$logger->addDebug('Detailed debug information.', ['debug' => 100]);

$logger->addInfo('Interesting events. Examples: User logs in, SQL logs.', ['info' => 200]);

$logger->addNotice('Normal but significant events.', ['notice' => 250]);

$logger->addWarning(
    'Exceptional occurrences that are not errors. ' .
    'Examples: Use of deprecated APIs, poor use of an API, ' .
    'undesirable things that are not necessarily wrong.',
    ['warning' => 300]
);

$logger->addError(
    'Runtime errors that do not require immediate action ' .
    'but should typically be logged and monitored.',
    ['error' => 400]
);

$logger->addCritical(
    'Critical conditions. Example: Application component unavailable, unexpected exception.',
    ['critical' => 500]
);

$logger->addAlert(
    'Action must be taken immediately. ' .
    'Example: Entire website down, database unavailable, etc. ' . 
    'This should trigger the SMS alerts and wake you up.',
    ['alert' => 550]
);

$logger->addEmergency('Emergency: system is unusable.', ['emergency' => 600]);

$logger = new Logger('Showtime');
$logger->pushHandler(new StreamHandler(__DIR__.'/log/test.log', Logger::ERROR));
$logger->pushHandler(new BrowserConsoleHandler(Logger::DEBUG));
$logger->pushProcessor(new GitProcessor(Logger::ERROR));
$logger->pushProcessor(new MemoryUsageProcessor(Logger::ERROR));
$logger->pushProcessor(new MemoryPeakUsageProcessor(Logger::ERROR));
$logger->pushProcessor(new ProcessIdProcessor(Logger::ERROR));
$logger->addDebug(
    'Detailed debug information.',
    ['debug' => 100, 'message' => 'It shall not show']
);
$logger->addError(
    'Error found, please follow monitoring',
    ['message' => 'You could show any additional information here']
);

