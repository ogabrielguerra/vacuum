<?php

    class GetThePost extends Base{

        function __construct(){
            parent::__construct();
            //Structuring obj data
            $posts = new Posts(new Media(), new Post());
            $view = new View();

            $post = $posts->getPost($_GET["slug"]);

            $html = $view->printPostImages($post);
            $tagsList = $view->listTags($post->post_tags);
            $sitePath = parent::getSitePath();

            $posts = new Posts(new Media(), new Post());
            $data = $posts->postsCollection;

            $renderOptions = array(
                'metaTitle' => $post->meta_title,
                'metaDescription' => $post->meta_description,
                'tags' => $post->post_tags,
            );

            //Rendering view/Twig
            // Case as a landing page

            if($post->is_landing_page==true){

                $page = 'pages/post-item-with-content.html';
                $post->content = str_replace('{{listTags}}', $tagsList, $post->content);

                $options = array(
                    'posts'=>$data,
                    'meta'=>$renderOptions,
                    'sitePath' => $sitePath,
                    'category' => $post->category,
                    'title' => $post->post_title,
                    'images' => $html,
                    'about' => $post->post_about,
                    'tagsList' => $tagsList,
                    'html' => $post->content,
                    'slug' => $post->slug
                );

            }else {
            // Case default

                $page = 'pages/post-item.html';

                $options = array(
                    'posts'=>$posts->postsCollection,
                    'sitePath' => $sitePath,
                    'meta'=>$renderOptions,
                    'tagsList' => $tagsList,
                    'category' => $post->category,
                    'title' => $post->post_title,
                    'images' => $html,
                    'about' => $post->post_about,
                    'html' => $post->content,
                    'slug' => $post->slug
                );
            }

            new TwigLoader($page, $options);
        }
    }