<?
	class Posts extends Base{

	    public $map;
		public $categories;
		public $categoriesContent;
		public $postsCollection = array();
		public $media;
		private $postPrototype;
		
		function __construct(iMedia $media, iPost $post){
            parent::__construct();
			$this->media = $media;
            $this->postPrototype = new $post();
            $this->setCategories();
            $this->loadAllPosts();
		}

		function loadAllPosts() : void{
            $map = array();

            //Loop through each category, defined in the dir structure
            foreach($this->getCategories() as $category){

                //$pathToPost = parent::getPostsPath().$category."/";
                $pathToPost = './posts/'.$category."/";
                $this->categoriesContent = parent::filterData(scandir($pathToPost));

                //Init a temp array to be cleared and used at each iteration
                $arrayTemp = array();

                //Loop through content in each category
                foreach($this->categoriesContent as $post){
                    $postObj = $this->getPost($post, $category);
                    array_push($this->postsCollection, $postObj);
                    //Insert posts into array
                    array_push($arrayTemp, $post);
                }

                usort($this->postsCollection, function($a, $b) {
                    return (int)$a->post_order > (int)$b->post_order;
                });

                $mapItem = array(
                    array($category),
                    $arrayTemp
                );

                //Finalize array map
                array_push($map, $mapItem);
                //Pass to Base Object (parent)

            }
            $this->map = $map;
        }

		function setCategories() : void{
			$this->categories = parent::filterData( scandir(parent::getPostsPath()) );
		}

		function getCategories() : array{
			return $this->categories;
		}

        function getPostsWithFeaturedImage(): array
        {
		    $postsList = array();
		    foreach($this->postsCollection as $post){

		        if($post->hasFeaturedImage()) {
                    array_push($postsList, $post);
                }
            }
            return $postsList;
        }

        function getCategory(string $key, array $map) : string{
            foreach ($map as $posts){
                foreach ($posts as $post){
                    foreach ($post as $item){
                        if($key==$item)
                            return $posts[0][0];
                    }
                }
            }
            return '';
        }

		function getPost(string $slug, $category='') : Post {
            $post = clone $this->postPrototype;

            //If category is empty, them get the category. Otherwise use the passed category
            if($category=='')
                $category = $this->getCategory($slug, $this->map);

            $post->buildMe($this->media, $category, $slug);
            return $post;
		}

		function getLastNPosts(int $n=5)
        {
            $posts = array_slice($this->postsCollection, 0, $n);
            return $posts;
        }

		function getSpecificPosts(Array $list){
		    $postsList = array();
            foreach($this->postsCollection as $post){
                $slug = $post->slug;
                if(in_array($slug, $list)){
                    array_push($postsList, $post);
                }
            }

            //var_dump($postsList);

            usort($postsList, function($a, $b) {
                return (int)$a->post_order > (int)$b->post_order;
            });

            return $postsList;
        }



        function getPostsByTag(string $tag) : array{
		    $postsList = array();
            foreach($this->postsCollection as $post){
                $cleanTags = trim(strtolower($post->post_tags));
                //Remove blank space in json
                $cleanTags = str_replace (', ', ',', $cleanTags);
                $cleanTags = $this->removeSpecialChars($cleanTags);
                $tags = array_map('trim', explode(',', $cleanTags));
                //print_r($tags);
                if(in_array($tag, $tags, FALSE)){
                    array_push($postsList, $post);
                }
            }
            //var_dump($postsList);
            return $postsList;
        }

        function getPostsByCategory(string $category) : array{
            $postsList = array();
            foreach($this->postsCollection as $post){
                if($post->category == $category)
                    array_push($postsList, $post);
            }
            return $postsList;
        }
	}