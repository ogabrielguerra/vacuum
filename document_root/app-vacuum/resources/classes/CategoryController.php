<?php

    class CategoryController extends Base{

        function __construct(){
            parent::__construct();

            $posts = new Posts(new Media(), new Post());
            $data = $posts->postsCollection;

            //Renders view
            $sitePath = parent::getSitePath();
            $options = array('sitePath' => $sitePath, 'posts' => $data);

            new TwigLoader('pages/category.html', $options);
        }

        function void(){
            //It does nothing. Just to feed the callback for a while
        }
    }