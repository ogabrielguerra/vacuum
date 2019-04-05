<?php
/**
 * Created by PhpStorm.
 * User: gabriel
 * Date: 25/09/18
 * Time: 07:57
 */

class Post extends Base implements iPost{

    public $category;
    public $slug;
    public $featuredImage;
    public $media;
    public $content;
    public $images;

    function __construct(){
        parent::__construct();
    }

    function buildMe(iMedia $media, string $category, string $slug) : void{
        $this->slug = $slug;
        $this->media = $media;
        $this->category = $category;
        $this->loadPostData();

        //After loading Post json data if post_order inexists or is null set a default value
        if($this->post_order=="" || empty($this->post_order)){
            $this->post_order = 99;
        }
        $path = parent::getPostsPath().$this->category.'/'.$this->slug;
        $this->content = file_get_contents($path.'/content.html');
        $this->media->setCategory($category);
        $this->featuredImage = $this->media->getFeaturedBySlug($slug);
        $this->images = $this->media->getImagesExceptFeatured($this->slug);

        unset($this->twig);
    }

    function __clone(){
    }

    function loadPostData() : void{
        $path = parent::getPostsPath().$this->category.'/'.$this->slug;
        $jsonPath = $path."/meta.json";
        //echo $jsonPath;
        try{
            if(!file_exists($jsonPath)){
                throw new Exception('Metadata file not found.');
            }else{
                $json = file_get_contents($jsonPath);
                //Convert json attributes as object attributes
                parent::convertJsonToObjAttributes(json_decode($json, true), $this);
                //var_dump($this);
            }
        }catch(Exception $e){
            //TODO To plug a log component like Monolog
            die($e->getMessage());
        }

            if (!file_exists($path . "/content.html")) {
                $this->content = null;
            }else {
                //$this->content = file_get_contents($path . "/content.html");
            }

    }

    function hasFeaturedImage() : bool{
        if(!empty($this->featuredImage)){
            return true;
        }else{
            return false;
        }
    }

}