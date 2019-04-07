<?php

    class TagController extends Base{

        function __construct(){
            parent::__construct();

            $blocks = new Blocks();
            $html = $blocks->portfolioGridByTag($_GET["slug"]);

            //Renders view
            $template = $this->twig->load('pages/category.html');
            $sitePath = parent::getSitePath();
            echo $template->render(array('sitePath'=>$sitePath, 'posts'=>$html));
        }

        function void(){
            //It does nothing. Just to feed the callback for a while
        }
    }