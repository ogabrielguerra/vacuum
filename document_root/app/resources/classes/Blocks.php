<?php

    class Blocks{

        function __construct()
        {
            $this->media = new Media();
            $this->posts = new Posts($this->media, new Post());
            $this->view = new View();
        }

        function portfolioGrid() : string
        {
            //Get all posts with featured images
            $posts = $this->posts->getPostsWithFeaturedImage();

            //Return a collection of "Post" objects and delivers to View
            return $this->view->homeFeaturedImages($posts);
        }

        function getSpecific(Array $list)
        {
            $selectedPosts = $this->posts->getSpecificPosts( $list );
            return $this->view->homeFeaturedImages($selectedPosts);
        }

        function portfolioGridByTag(string $slug) : string
        {
            //Get all posts with featured images
            $posts = $this->posts->getPostsByTag($slug);
            //Return a collection of "Post" objects and delivers to View
            return $this->view->homeFeaturedImages($posts);
        }

        function portfolioGridByCategory(string $slug) : string
        {
            //Get all posts with featured images
            $posts = $this->posts->getPostsByCategory($slug);
            //Return a collection of "Post" objects and delivers to View
            return $this->view->homeFeaturedImages($posts);
        }

    }