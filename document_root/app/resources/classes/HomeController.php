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
            $template = $this->twig->load('home.html');
            $sitePath = parent::getSitePath();
            echo $template->render(array('sitePath'=>$sitePath, 'posts'=>$html , 'meta'=>$renderOptions));
        }
    }
