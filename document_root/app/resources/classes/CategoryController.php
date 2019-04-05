<?php

    class CategoryController extends Base{

        function __construct(){
            parent::__construct();

            $posts = new Posts(new Media(), new Post());
            $data = $posts->postsCollection;

            //Renders view
            $template = $this->twig->load('pages/categories.html');
            $sitePath = parent::getSitePath();
            echo $template->render(array('sitePath'=>$sitePath, 'posts'=>$data));
        }

        function void(){
            //It does nothing. Just to feed the callback for a while
        }
    }