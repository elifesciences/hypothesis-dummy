<?php

use eLife\Ping\Silex\PingControllerProvider;
use Silex\Application;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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
        'url' => $base.'/profile',
        'method' => 'PATCH',
        'desc' => 'Update a user\'s preferences',
      ),
    ),
    'search' => 
    array (
      'url' => $base.'/search',
      'method' => 'GET',
      'desc' => 'Search for annotations',
    ),
    'group' => 
    array (
      'member' => 
      array (
        'delete' => 
        array (
          'url' => $base.'/groups/:pubid/members/:user',
          'method' => 'DELETE',
          'desc' => 'Remove the current user from a group.',
        ),
      ),
    ),
    'annotation' => 
    array (
      'hide' => 
      array (
        'url' => $base.'/annotations/:id/hide',
        'method' => 'PUT',
        'desc' => 'Hide an annotation as a group moderator.',
      ),
      'unhide' => 
      array (
        'url' => $base.'/annotations/:id/hide',
        'method' => 'DELETE',
        'desc' => 'Unhide an annotation as a group moderator.',
      ),
      'read' => 
      array (
        'url' => $base.'/annotations/:id',
        'method' => 'GET',
        'desc' => 'Fetch an annotation',
      ),
      'create' => 
      array (
        'url' => $base.'/annotations',
        'method' => 'POST',
        'desc' => 'Create an annotation',
      ),
      'update' => 
      array (
        'url' => $base.'/annotations/:id',
        'method' => 'PATCH',
        'desc' => 'Update an annotation',
      ),
      'flag' => 
      array (
        'url' => $base.'/annotations/:id/flag',
        'method' => 'PUT',
        'desc' => 'Flag an annotation for review.',
      ),
      'delete' => 
      array (
        'url' => $base.'/annotations/:id',
        'method' => 'DELETE',
        'desc' => 'Delete an annotation',
      ),
    ),
    'links' => 
    array (
      'url' => $base.'/links',
      'method' => 'GET',
      'desc' => 'URL templates for generating URLs for HTML pages',
    ),
  ),
);
    return new JsonResponse($body);
});

$app->get('/links', function (Request $request) {
    // hardcoded for the moment
    $body = '{"account.settings": "https://hypothes.is/account/settings", "forgot-password": "https://hypothes.is/forgot-password", "groups.new": "https://hypothes.is/groups/new", "help": "https://hypothes.is/docs/help", "oauth.authorize": "https://hypothes.is/oauth/authorize", "oauth.revoke": "https://hypothes.is/oauth/revoke", "search.tag": "https://hypothes.is/search?q=tag:\":tag\"", "signup": "https://hypothes.is/signup", "user": "https://hypothes.is/u/:user"}';
    return new Response($body);
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
