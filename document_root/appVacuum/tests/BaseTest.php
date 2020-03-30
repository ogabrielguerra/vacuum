<?php

require 'appVacuum/resources/classes/iBase.php';
require 'appVacuum/resources/classes/Base.php';
// use app_vaccum\

// echo getcwd();

use PHPUnit\Framework\TestCase;

class TestBase extends TestCase
{
    public $pathToPosts;
    public $pathToPages;

    function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->init();
        $this->testIfPostsDirectoryExists();
    }

    function init(){
        $this->pathToPosts = 'public_html/posts/';
        $this->pathToPages = 'public_html/pages/';
    }

    function testIfPostsDirectoryExists(){
        $this->assertDirectoryExists($this->pathToPosts);
    }

    function testIfPagesDirectoryExists(){
        $this->assertDirectoryExists($this->pathToPages);
    }

    function testIfDataIsBeingFiltered(){
        $this->init();
        $base = new Base();

        $data = $base->filterData( scandir($this->pathToPosts) );

        if($this->assertIsArray($data)){
            $elements = array('..', '.', '.DS_Store');
            
            $result = empty(array_intersect($elements, $data));
            $this->assertTrue($result);
        }
    }

    // function testJsonToObjectConversion(){
        
    // }

    // function testFilterData(){
        
    // }
}