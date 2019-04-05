<?
	class Media extends Base implements iMedia{

		private $folders;
		public $folder;
		public $category;

		function __construct(){
		}

		function setCategory(string $category) : void{
		    $this->category = $category;
        }

        function getAllImages() : Array{
		    $imagesCollection = array();
		    foreach($this->folders as $item){
		        //Loop images of each folder
                $images = $this->getImagesBySlug($item);
                foreach($images as $image){
                    array_push($imagesCollection, $image);
                }
            }
            return $imagesCollection;
        }

        function getAllFeaturedImages() : Array{
            $imagesCollection = array();
            foreach($this->folders as $item){
                //Loop images of each folder
                $featuredImage = $this->getFeaturedBySlug($item);
                if(!empty($featuredImage)){
                    $imageData = array($featuredImage, $item, $this->folder);
                    array_push($imagesCollection, $imageData);
                }

            }
            return $imagesCollection;
        }

		function getImagesBySlug(string $slug) : Array{
		    $path = "./posts/".$this->category."/".$slug."/media/";
		    $images = parent::filterData( scandir($path) );
		    return $images;

		}

		function isFeatured(string $image) : bool{
            if(strpos($image, "featured")!==false){
                return true;
            }else{
                return false;
            }
        }

		function getFeaturedBySlug(string $slug) : string{
			$images = $this->getImagesbySlug($slug);
			foreach($images as $image){
				if($this->isFeatured($image))
					return $image;
			}
			return '';
		}

		function getImagesExceptFeatured(string $slug) : Array{

		    $images = $this->getImagesbySlug($slug);
			$newImages = array();
			foreach($images as $image){
				if(strpos($image, "featured")===false){
					array_push($newImages, $image);
				}
			}
			return $newImages;
		}

		function getImagePath() : string{
			$sitePath = parent::getSitePath();
			$postsPath = "/posts/";
			$currentCategory = $this->folder."/";
			$slug = parent::getSlug();
			return $sitePath.$postsPath.$currentCategory.$slug."/media/";

		}
	}

?>