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

$app->post('/token', function (Request $request) {
    return new JsonResponse([
        'access_token' => 'access_token_generated',
        'token_type' => 'Bearer',
        'expires_in' => 3600.0,
        'refresh_token' => 'refresh_token_generated',
    ]);
});

$app->get('/search', function (Request $request) {
    $rows = [
        [
            'permissions' => [
                'read' => [
                    'group:__world__',
                ],
            ],
            'id' => 'K8YIKPrMEeew46PspufAQg',
            'document' => [
                'title' => [
                    '5a25fe175305ef0018a03499',
                ],
            ],
            'hidden' => false,
            'user' => 'acct:jamescdavis@hypothes.is',
            'user_info' => [
                'display_name' => 'James C. Davis',
            ],
            'flagged' => false,
            'updated' => '2018-01-16T14:47:27.138496+00:00',
            'group' => '__world__',
            'target' => [
                [
                    'selector' => [
                        [
                            'value' => 'pageContainer3',
                            'type' => 'FragmentSelector',
                            'conformsTo' => 'https://tools.ietf.org/html/rfc3236',
                        ],
                        [
                            'endOffset' => 44,
                            'startOffset' => 23,
                            'type' => 'RangeSelector',
                            'startContainer' => '/div[1]/div[2]/div[4]/div[1]/div[3]/div[2]/div[10]',
                            'endContainer' => '/div[1]/div[2]/div[4]/div[1]/div[3]/div[2]/div[10]',
                        ],
                        [
                            'start' => 4951,
                            'end' => 4972,
                            'type' => 'TextPositionSelector',
                        ],
                        [
                            'suffix' => '.An   unstructured   triangular ',
                            'type' => 'TextQuoteSelector',
                            'prefix' => 'the studyof coastal oceanic and ',
                            'exact' => 'estuarine circulation',
                        ],
                    ],
                    'source' => 'http://localhost:7778/render?url=http://192.168.168.167:7777/v1/resources/m74kv/providers/osfstorage/5a25fe175305ef0018a03499?direct&mode=render&initialWidth=766',
                ],
            ],
            'links' => [
                'incontext' => 'https://hyp.is/K8YIKPrMEeew46PspufAQg/localhost:7778/render?url=http://192.168.168.167:7777/v1/resources/m74kv/providers/osfstorage/5a25fe175305ef0018a03499?direct&mode=render&initialWidth=766',
                'html' => 'https://hypothes.is/a/K8YIKPrMEeew46PspufAQg',
                'json' => 'https://hypothes.is/api/annotations/K8YIKPrMEeew46PspufAQg',
            ],
            'tags' => [],
            'text' => 'what is this?',
            'created' => '2018-01-16T14:47:27.138496+00:00',
            'uri' => 'http://localhost:7778/render?url=http://192.168.168.167:7777/v1/resources/m74kv/providers/osfstorage/5a25fe175305ef0018a03499?direct&mode=render&initialWidth=766',
        ],
        [
            'permissions' => [
                'read' => [
                    'group:__world__',
                ],
            ],
            'id' => 'aqxiIvrLEeeMEJcpAien5A',
            'document' => [
                'title' => [
                    'Doing Business 2015 => Going Beyond Efficiency',
                ],
            ],
            'hidden' => false,
            'user' => 'acct:mhader@hypothes.is',
            'user_info' => [
                'display_name' => null,
            ],
            'flagged' => false,
            'updated' => '2018-01-16T14:42:03.224701+00:00',
            'group' => '__world__',
            'target' => [
                [
                    'selector' => [
                        [
                            'endOffset' => 105,
                            'startOffset' => 9,
                            'type' => 'RangeSelector',
                            'startContainer' => '/p[4]',
                            'endContainer' => '/p[4]',
                        ],
                        [
                            'start' => 377,
                            'end' => 473,
                            'type' => 'TextPositionSelector',
                        ],
                        [
                            'suffix' => 'and customized economy and regio',
                            'type' => 'TextQuoteSelector',
                            'prefix' => "doingbusiness.org/data\nReportsAc",
                            'exact' => 'cess to Doing Business reports as well as subnational and regional reports, reform case studies ',
                        ],
                    ],
                    'source' => 'http://mhader:18080/readerepub/doi/epub/10.1596/978-1-4648-0351-2/ops/xhtml/fm01.html',
                ],
            ],
            'links' => [
                'incontext' => 'https://hyp.is/aqxiIvrLEeeMEJcpAien5A/mhader:18080/readerepub/doi/epub/10.1596/978-1-4648-0351-2/ops/xhtml/fm01.html',
                'html' => 'https://hypothes.is/a/aqxiIvrLEeeMEJcpAien5A',
                'json' => 'https://hypothes.is/api/annotations/aqxiIvrLEeeMEJcpAien5A',
            ],
            'tags' => [],
            'text' => 'tyjtj',
            'created' => '2018-01-16T14:42:03.224701+00:00',
            'uri' => 'http://mhader:18080/readerepub/doi/epub/10.1596/978-1-4648-0351-2/ops/xhtml/fm01.html',
        ],
    ];

    if ($request->headers->get('Authorization')) {
        $rows[] = [
            'permissions' => [
                'delete' => [
                    'acct:imitlks8@elifesciences.org',
                ],
                'update' => [
                    'acct:imitlks8@elifesciences.org',
                ],
                'admin' => [
                    'acct:imitlks8@elifesciences.org',
                ],
                'read' => [
                    'group:__world__',
                ],
            ],
            'id' => '4eJEnNXwEee-anvHeyu2NQ',
            'document' => [
                'title' => [
                    'The running costs of eLife 2.0',
                ],
            ],
            'hidden' => false,
            'user' => 'acct:imitlks8@elifesciences.org',
            'user_info' => [
                'display_name' => 'Paul Shannon',
            ],
            'flagged' => false,
            'updated' => '2017-12-05T12:13:36.283133+00:00',
            'group' => 'imRGyeeV',
            'target' => [
                [
                    'selector' => [
                        [
                            'endOffset' => 211,
                            'startOffset' => 0,
                            'type' => 'RangeSelector',
                            'startContainer' => '/div[1]/div[2]/main[1]/div[3]/div[1]/div[1]/section[12]/div[1]/p[2]',
                            'endContainer' => '/div[1]/div[2]/main[1]/div[3]/div[1]/div[1]/section[12]/div[1]/p[2]',
                        ],
                        [
                            'start' => 20345,
                            'end' => 20556,
                            'type' => 'TextPositionSelector',
                        ],
                        [
                            'suffix' => ' Unfortunately, you have to add ',
                            'type' => 'TextQuoteSelector',
                            'prefix' => 't => p.shannon@elifesciences.org.\n',
                            'exact' => 'We’ll endeavour to make our data more accurate and timely by utilising cost tagging in AWS, so that we can expose figures directly from AWS Cost Explorer for those interested in future running costs as we scale.',
                        ],
                    ],
                    'source' => 'https://elifesciences.org/labs/85a7155a/the-running-costs-of-elife-2-0',
                ],
            ],
            'links' => [
                'incontext' => 'https://hyp.is/4eJEnNXwEee-anvHeyu2NQ/elifesciences.org/labs/85a7155a/the-running-costs-of-elife-2-0',
                'json' => 'https://hypothes.is/api/annotations/4eJEnNXwEee-anvHeyu2NQ',
            ],
            'tags' => [],
            'text' => 'As mentioned in this post, we wanted to look at ways to easily tag the cost data in AWS so that we could provide simple updates on changing costs.\n\nHelpfully we found that amending the tagging in the deployment scripts means you can port across these to the Cost Explorer. The result is that tagged costs are available for anyone using Continuum too, and I can produce graphs like this for November\'s data:\n\n![November AWS Costs for eLife 2.0](https://imgur.com/download/tiHtmGc)\n\n[Full image link](https://photos.app.goo.gl/t7ZzLE0uNNbdSwur1)\n\nYou can see that the cost per month for Computing (on demand), Database and Storage as shown here is $900 which is similar to previous months.',
            'created' => '2017-11-30T17:07:01.575981+00:00',
            'uri' => 'https://elifesciences.org/labs/85a7155a/the-running-costs-of-elife-2-0',
        ];
    }

    return new JsonResponse([
        'total' => count($rows),
        'rows' => $rows,
    ]);
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
