<?php

use React\EventLoop\Factory;

require __DIR__ . '/../vendor/autoload.php';

$loop = Factory::create();
$client = new React\HttpClient\Client($loop);

$socket = new \React\Socket\Server('0.0.0.0:8080', $loop);
$server = new React\Http\Server(function (Psr\Http\Message\ServerRequestInterface $request) {
    return new React\Http\Response(
        200,
        array('Content-Type' => 'text/plain'),
        "Hello World! Server #2\n"
    );
});
$server->listen($socket);

echo 'Listening on ' . str_replace('tls:', 'https:', $socket->getAddress()) . PHP_EOL;

$loop->run();