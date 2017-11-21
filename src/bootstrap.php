<?php

use eLife\Ping\Silex\PingControllerProvider;
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

require_once __DIR__.'/../vendor/autoload.php';

$app = new Application();
$app->register(new PingControllerProvider());


$app->post('/users', function (Request $request) {
    $body = json_decode($request->getContent(), true);

    return new JsonResponse(array_merge(
        $body,
        [
            'userid' => 'hypothesis-id-'.$body['username'],
        ]
    ));
});

// TODO: is there anything available from an elife library?
$app->error(function (Throwable $e) {
    if ($e instanceof HttpExceptionInterface) {
        $status = $e->getStatusCode();
    } else {
        $status = 500;
    }

    return new JsonResponse(
        [
            'message' => $e->getMessage(),
        ],
        $status
    );
});

return $app;
