<?php
    declare(strict_types=1);
    ob_start();
    require 'bootstrap.php';
    require 'routes.php';
    ob_end_flush();