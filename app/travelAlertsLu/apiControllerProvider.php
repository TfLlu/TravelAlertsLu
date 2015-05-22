<?php

  namespace travelAlertsLu;

  use Silex\Application;
  use Silex\ControllerProviderInterface;

  class apiControllerProvider implements ControllerProviderInterface {

    public function connect ( Application $app ) {

      $ctr = $app['controllers_factory'];

      $ctr->get( '/', function( Application $app ) {

        //echo '<pre>';

        $lineIssues = ScrapeHelpers::getData( $app );

        //echo json_encode( $ );

        //$storage = StorageHelpers::saveIssues( $app, $lineIssues );

        return $app->json( $lineIssues );

      });

      return $ctr;

    }

  }