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

$app->get('/', function (Request $request) {
    $base = $request->getScheme().'://'.$request->getHost();
$body = array (
  'message' => 'Annotator Store API',
  'links' => 
  array (
    'profile' => 
    array (
      'read' => 
      array (
        'url' => $base.'/profile',
        'method' => 'GET',
        'desc' => 'Fetch the user\'s profile',
      ),
      'update' => 
      array (
        'url' => 'https://hypothes.is/api/profile',
        'method' => 'PATCH',
        'desc' => 'Update a user\'s preferences',
      ),
    ),
    'search' => 
    array (
      'url' => 'https://hypothes.is/api/search',
      'method' => 'GET',
      'desc' => 'Search for annotations',
    ),
    'group' => 
    array (
      'member' => 
      array (
        'delete' => 
        array (
          'url' => 'https://hypothes.is/api/groups/:pubid/members/:user',
          'method' => 'DELETE',
          'desc' => 'Remove the current user from a group.',
        ),
      ),
    ),
    'annotation' => 
    array (
      'hide' => 
      array (
        'url' => 'https://hypothes.is/api/annotations/:id/hide',
        'method' => 'PUT',
        'desc' => 'Hide an annotation as a group moderator.',
      ),
      'unhide' => 
      array (
        'url' => 'https://hypothes.is/api/annotations/:id/hide',
        'method' => 'DELETE',
        'desc' => 'Unhide an annotation as a group moderator.',
      ),
      'read' => 
      array (
        'url' => 'https://hypothes.is/api/annotations/:id',
        'method' => 'GET',
        'desc' => 'Fetch an annotation',
      ),
      'create' => 
      array (
        'url' => 'https://hypothes.is/api/annotations',
        'method' => 'POST',
        'desc' => 'Create an annotation',
      ),
      'update' => 
      array (
        'url' => 'https://hypothes.is/api/annotations/:id',
        'method' => 'PATCH',
        'desc' => 'Update an annotation',
      ),
      'flag' => 
      array (
        'url' => 'https://hypothes.is/api/annotations/:id/flag',
        'method' => 'PUT',
        'desc' => 'Flag an annotation for review.',
      ),
      'delete' => 
      array (
        'url' => 'https://hypothes.is/api/annotations/:id',
        'method' => 'DELETE',
        'desc' => 'Delete an annotation',
      ),
    ),
    'links' => 
    array (
      'url' => 'https://hypothes.is/api/links',
      'method' => 'GET',
      'desc' => 'URL templates for generating URLs for HTML pages',
    ),
  ),
);
    return new JsonResponse($body);
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
