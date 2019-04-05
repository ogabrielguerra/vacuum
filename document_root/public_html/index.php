<?php

    declare(strict_types=1);
    ob_start();

    /*
    $a = new stdClass();
    $a->title = "A";
    $a->order = 1;

    $b = new stdClass();
    $b->title = "B";
    $b->order = 3;

    $c = new stdClass();
    $c->title = "C";
    $c->order = 2;

    $list = array($b, $a, $c);

    usort($list, function($a, $b) {
        return (int)$a->order > (int)$b->order;
    });

    //var_dump($list);
    */

    require 'bootstrap.php';
    require 'routes.php';
    ob_end_flush();









