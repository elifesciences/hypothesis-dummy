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

$app->post('/token', function (Request $request) {
    $body = '{"access_token": "5768-ABCDEFGHIJ-123456789102_1111111111111111111", "token_type": "Bearer", "expires_in": 3600.0, "refresh_token": "1234-AAAAAA_A_1111111111111111111111111111111111"}';
    return new Response($body);
});

$app->get('/profile', function (Request $request) {
    $body = '{"user_info": {"display_name": "Giorgio Sironi"}, "preferences": {}, "groups": [{"public": true, "name": "eLIFE", "id": "imRGyeeV"}], "userid": "acct:m8nl1gze@elifesciences.org", "authority": "elifesciences.org", "features": {"api_render_user_info": true, "filter_highlights": false, "overlay_highlighter": false, "embed_cachebuster": false, "client_display_names": false}}';
    return new Response($body);
});

$app->get('/search', function (Request $request) {
    $body = '{"rows": [], "total": 0, "replies": []}';
    return new Response($body);
});

$app->post('/annotations', function (Request $request) {
    $body = '{"updated": "2017-12-07T14:34:41.949708+00:00", "group": "imRGyeeV", "target": [{"source": "https://elifesciences.org/articles/32493", "selector": [{"conformsTo": "https://tools.ietf.org/html/rfc3236", "type": "FragmentSelector", "value": "s1"}, {"type": "RangeSelector", "startContainer": "/div[1]/div[2]/main[1]/div[3]/div[1]/div[1]/div[2]/section[2]/div[1]/p[5]", "endContainer": "/div[1]/div[2]/main[1]/div[3]/div[1]/div[1]/div[2]/section[2]/div[1]/p[5]", "startOffset": 571, "endOffset": 577}, {"start": 12301, "end": 12307, "type": "TextPositionSelector"}, {"type": "TextQuoteSelector", "prefix": " 2007; Rigort et al., 2012). We ", "exact": "imaged", "suffix": " Golgi stacks within the native "}]}], "links": {"json": "https://hypothes.is/api/annotations/w02dfNtbEeeShxcmUm1Vzg", "html": "https://hypothes.is/a/w02dfNtbEeeShxcmUm1Vzg", "incontext": "https://hyp.is/w02dfNtbEeeShxcmUm1Vzg/elifesciences.org/articles/32493"}, "tags": [], "text": "took image of", "created": "2017-12-07T14:34:41.949708+00:00", "uri": "https://elifesciences.org/articles/32493", "flagged": false, "user_info": {"display_name": "Giorgio Sironi"}, "user": "acct:m8nl1gze@elifesciences.org", "hidden": false, "document": {"title": ["The structure of the COPI coat determined within the cell"]}, "id": "w02dfNtbEeeShxcmUm1Vzg", "permissions": {"read": ["acct:m8nl1gze@elifesciences.org"], "admin": ["acct:m8nl1gze@elifesciences.org"], "update": ["acct:m8nl1gze@elifesciences.org"], "delete": ["acct:m8nl1gze@elifesciences.org"]}}';
    return new Response($body);
});


$app->get('/hypothesis', function (Request $request) {
    return new Response(file_get_contents(__DIR__.'/../hypothesis.js'));
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
