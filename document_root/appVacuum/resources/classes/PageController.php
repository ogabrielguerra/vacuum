<?php

    class PageController extends Base implements iPage
    {

        function __construct(array $routeInfo)
        {

            parent::__construct();
            
            $page = $routeInfo[2]["name"];
            $gtp = new GetThePage($page);

            //Does the requested page really exists? If not, redirect
            $file = './../appVacuum/resources/templates/pages/' . $page . '.html';
            if (!is_file($file)) {
                //header("Location: /");
                die('No file found');
            }

            $sitePath = parent::getSitePath();
            $posts = new Posts(new Media(), new Post());

            $renderOptions = array(
                'metaTitle' => $gtp->meta_title,
                'metaDescription' => $gtp->meta_description,
                'tags' => $gtp->tags
            );

            //Data is an Array
            $data = $posts->postsCollection;

            //This page uses some kind notification?
            $status = null;
            if ( isset($_GET["status"]) && !empty($_GET["status"])){
                $status = $_GET["status"];
            }

            $page = 'pages/' . $page . '.html';

            $options = array(
                'meta'=>$renderOptions,
                'posts'=>$data,
                'status'=>$status,
                'sitePath'=>$sitePath,
                'slug'=>$page
            );

            new TwigLoader($page, $options);

        }
    }