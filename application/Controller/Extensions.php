<?php


namespace Controller ;

use Budkit\Event\Event;
use Budkit\Routing\Controller as RouteController;
use Budkit\Dependency\Container as Application;
use Helper\Packagist;


class Extensions extends RouteController{

    /**
     * Extensions constructor.
     *
     * @param Application $application
     * @param Menu $menu
     */
    public function __construct(Application $application)
    {

        parent::__construct($application);

    }


    public function index($format = 'html'){

        //echo "manage extensions";

        //$composer = Packagist::getComposer();
        $installed = Packagist::getInstalledPackages();

        //print_R( $installed );

        $this->view->setData("packages", $installed );
        $this->view->setLayout("admin/canvas/extensions");

    }

}