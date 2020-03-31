<?php

require 'appVacuum/resources/classes/iBase.php';
require 'appVacuum/resources/classes/Base.php';

use PHPUnit\Framework\TestCase;

// TODO: Enhance tests

class VacuumTest extends TestCase
{
    public $pathToPosts;
    public $pathToPages;

    function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->init();
    }

    function init()
    {
        $this->pathToPosts = 'public_html/posts/';
        $this->pathToPages = 'public_html/pages/';
        $this->base = new Base('appVacuum');
    }

    function testIfPostsDirectoryExists()
    {
        $this->assertDirectoryExists($this->pathToPosts);
    }

    function testIfPagesDirectoryExists()
    {
        $this->assertDirectoryExists($this->pathToPages);
    }

    function testIfDataIsBeingFiltered()
    {
        $this->init();


        $data = $this->base->filterData(scandir($this->pathToPosts));

        if ($this->assertIsArray($data)) {
            $elements = array('..', '.', '.DS_Store');

            $result = empty(array_intersect($elements, $data));
            $this->assertTrue($result);
        }
    }

    function testDashToSpace()
    {
        $string = 'string-with-dashes-i-am';
        $newString = $this->base->dashToSpace($string);
        $this->assertEquals('string with dashes i am', $newString);
    }

    function removeSpecialChars()
    {
        $string = 'uma maçã é símbolo de um mundo vão';
        $newString = $this->base->removeSpecialChars($string);
        $this->assertEquals('uma maça e simbolo de um mundo vao', $newString);
    }
}