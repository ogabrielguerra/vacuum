<?php

interface iPost {
    function __construct();
    function buildMe(iMedia $media, string $category, string $slug) : void;
    public function hasFeaturedImage() : bool;
}