<?php

use PHPUnit\Framework\TestCase;


class VacuumTest extends TestCase
{
    public $pathToPosts;
    public $pathToPages;

    function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        new BaseTest();
    }




}