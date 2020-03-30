<?php


class TwigLoader
{
    private $twigInst;

    function __construct(String $page, $options)
    {
        //Twig loader and environment.
        $loader = new Twig_Loader_Filesystem('../appVacuum/resources/templates');
        $twigInstance = new Twig_Environment($loader, array(
            'debug' => true
        ));

        $this->twigInst = $twigInstance;
        $this->renderPage($page, $options);
    }

    public function loadPage(String $page)
    {
        return $this->twigInst->load($page);
    }

    public function renderPage(String $page, Array $options)
    {
        $template = $this->loadPage($page);
        echo $template->render($options);
    }

    public function getTwigInstance()
    {
        return $this->twigInst;
    }
}