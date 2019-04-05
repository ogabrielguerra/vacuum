<?php

    //Workaround for correct routes functioning
    $uri = '/public_html';

    //In the case url doesn't point to root, prepare the url
    //if($uri!="/")
        $_SERVER['REQUEST_URI'] = substr($_SERVER['REQUEST_URI'], (strlen($uri)));
    /* *** */

    $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
        /* HOME */
        $r->addRoute('GET', '/', 'HomeController');

        /* Generic route for Pages */
        $r->addRoute('GET', '/{name}', 'PageController');

        /* Posts */
        $r->addRoute('GET', '/item/{slug}', 'PortfolioController');
        $r->addRoute('GET', '/tag/{slug}', 'TagController');
        $r->addRoute('GET', '/categories/{slug}', 'CategoryController');

        /* Routes for contact features */
        $r->addRoute('GET', '/{name}/{status}', 'PageController');
        $r->addRoute('POST', '/contactDo', 'ContactController');
        /* *** */
    });

    // Fetch method and URI from somewhere
    $httpMethod = $_SERVER['REQUEST_METHOD'];
    $uri = $_SERVER['REQUEST_URI'];

    // Strip query string (?foo=bar) and decode URI
    if (false !== $pos = strpos($uri, '?'))
        $uri = substr($uri, 0, $pos);

    $uri = rawurldecode($uri);
    $routeInfo = $dispatcher->dispatch($httpMethod, $uri);


    switch ($routeInfo[0]) {
        case FastRoute\Dispatcher::NOT_FOUND:
            // ... 404 Not Found
            //die();
            break;

        case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
            $allowedMethods = $routeInfo[1];
            // ... 405 Method Not Allowed
            break;

        case FastRoute\Dispatcher::FOUND:


            if($routeInfo[1]== 'HomeController'){
                //It's home!
                new HomeController($twig);

            }else if($routeInfo[1]== 'PageController'){
                // We are pages. Treat us as special items
                //Just create a view with the same name
                //example /about will call about.html in templates/pages dir
                //die();
                new PageController($routeInfo);

            }else{
                //Process all the others controllers
                $class = new $routeInfo[1]();
                call_user_func_array(array($class, 'void'), array());
            }

    }
