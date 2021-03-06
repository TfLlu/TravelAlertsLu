<?php

namespace travelAlertsLu;

use Silex\Application;
use Silex\ControllerProviderInterface;

class apiControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $ctr = $app['controllers_factory'];

        $ctr->get('/', function () use ($app) {

            return $app->redirect('/api/current/');

        });

        $ctr->get('/list/', function () use ($app) {

            return $app->json(Issues::getList($app));

        });

        $ctr->get('/issues/', function () use ($app) {

            return $app->json(Issues::getAll($app));

        });

        $ctr->get('/issues/line/{line}/', function ($line) use ($app) {

            $line = str_replace('line_', '', $line);

            return $app->json(Issues::getByLine($app, $line));

        });

        $ctr->get('/issues/tweet/{tweetId}', function ($tweetId) use ($app) {

            return $app->json(Issues::getIssueByTweet($app, $tweetId));

        });

        $ctr->get('/debug/tweet/{tweetId}', function ($tweetId) use ($app) {
            return $app['twig']->render(
            'debug.twig',
            array(
                'issue' => Issues::getIssueByTweet($app, $tweetId),
                )
            );
        });

        $ctr->get('/tweets/', function () use ($app) {

            return $app->json(Twitter::getAll($app));

        });

        $ctr->get('/current/', function (Application $app) {

            return $app->json(Issues::getCurrent());

        });

        $ctr->get('/departures/{lat}/{long}/{stations}/{departures}', function ($lat, $long, $stations, $departures) use ($app) {

            return $app->json(Mobiliteit::getDepartures($app, $lat, $long, $stations, $departures));

        });

        return $ctr;
    }
}
