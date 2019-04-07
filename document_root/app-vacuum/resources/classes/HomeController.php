<?php

    class HomeController extends Base implements iHome{
        function __construct() {
            parent::__construct();

            //Get default meta
            $gtp = new GetThePage("default");
            $renderOptions = array(
                'metaTitle' => $gtp->meta_title,
                'metaDescription' => $gtp->meta_description,
                'tags' => $gtp->tags
            );

            //Renders template
            $page = 'home.html';
            $options = array(
                'sitePath' => $this->sitePath,
                'posts' => '',
                'meta' => $renderOptions
            );
            new TwigLoader($page, $options);

        }
    }
