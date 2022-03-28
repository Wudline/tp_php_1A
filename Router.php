<?php

    namespace Routes;

    class Router
    {
        // Variables
        private $app;
        private $cns;

        /**
         * Constructeur
         *
         * @param $app
         * @param $cns (controller namespace)
         */

        public function __construct($app, $cns)
        {
            $this->app = $app;
            $this->cns = $cns;
        }

        /**
         * Appel méthode
         *
         * @param $method
         * @param $url
         * @param $action
         * 
         * @return
         */

        private function call($method, $url, $action)
        {
            return $this->app->$method($url, function() use ($action) 
            {
                $action = explode('@', $action);

                if (count($action) == 1)
                {
                    $CtrlName = $this->cns . ($action[0] == '' ? 'DefaultController' : ucfirst($action[0]) . 'Controller');
                    $MethName = 'indexAction';
                }
                else if (count($action) == 2)
                {
                    $CtrlName = $this->cns . ($action[0] == '' ? 'DefaultController' : ucfirst($action[0]) . 'Controller');
                    $MethName = $action[1] == '' ? 'indexAction' : $action[1] . 'Action';
                }

                $controller = new $CtrlName($this->app);

                call_user_func_array(array($controller, $MethName), func_get_args());
            });
        }

        /**
         * Méthode GET
         *
         * @param $url
         * @param $action
         *
         * @return
         */

        public function get($url, $action)
        {
            return $this->call('get', $url, $action);
        }

        /**
         * Méthode POST
         *
         * @param $url
         * @param $action
         *
         * @return
         */

        public function post($url, $action)
        {
            return $this->call('post', $url, $action);
        }

        /**
         * Génération des routes
         *
         * @param $routes
         */

        public function generateRoutes($routes)
        {
            if (is_array($routes))
            {
                foreach ($routes as $groupName => $routesList)
                {
                    if (   !isset($routesList['url']) 
                        || !isset($routesList['method']) 
                        || !isset($routesList['action'])
                    ){
                        $this->app->group('/' . $groupName, function() use ($routesList) {
                            $this->generateRoutes($routesList);
                        });
                    }
                    else
                    {
                        if ( isset($routesList['conditions']) 
                            && count($routesList['method']) > 0
                        ){
                            $this->call($routesList['method'], $routesList['url'], $routesList['action'])
                            ->name($groupName)
                            ->conditions($routesList['conditions']);
                        }      
                        else
                        {
                            $this->call($routesList['method'], $routesList['url'], $routesList['action'])
                            ->name($groupName);
                        }
                    }
                }
            }
        }
    }

?>