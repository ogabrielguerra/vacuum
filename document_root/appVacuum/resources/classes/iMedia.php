<?php
    interface iMedia{
        function setCategory(string $category) : void;
        function getAllImages() : Array;
        function getAllFeaturedImages() : Array;
        function isFeatured(string $image) : bool;
        function getFeaturedBySlug(string $slug) : string;
        function getImagesExceptFeatured(string $slug) : Array;
    }