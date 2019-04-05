<?
	class View extends Base {

	    private $basePath;

		function __construct(){
            parent::__construct();
            $this->basePath = parent::getSitePath().parent::getPostsPath();
            $this->basePath = str_replace('./', '', $this->basePath);
		} 

		function showStatus(string $st) : void{
			echo '<div>'.$st.'</div>';
		}

		function listItens(Array $data, bool $withLinks) : void{

			$list = '<ul>';
			foreach ($data as $item) {
				if($withLinks)
					$list .= '<li><a href="'.$item.'" title="'.$item.'">'.$item.'</a></li>';
				else
					$list .= '<li>'.$item.'</li>';
			}
			$list .= '</ul>';
			echo $list;
		}

		function printPostImages(Post $post) : string{
		    $output= '';
			foreach ($post->images as $image) {
                $imageSrc = $this->getFullImagePath($post->category, $post->slug, $image);
			    $output .= '<img src="'.$imageSrc.'" />';
			}
			return $output;
		}

		function getFullImagePath($category, $slug, $image) : string{
            //$imagePath = $this->basePath."/".$category."/".$slug."/media/".$image;
            $imagePath = "posts/".$category."/".$slug."/media/".$image;
            return $imagePath;
        }

        function homeFeaturedImages(array $posts) : string{
            $listaCases = '';

            foreach ($posts as $post) {
                /*
                 * Do your magic
                 */
            }

            return $listaCases;
        }

        public function listTags(string $tagsList) : string{

            $tagsList = array_map('trim', explode(',', $tagsList));
            $output = '<ul class="widget-tag">';
            foreach ($tagsList as $item) {
                $tag = parent::spaceToDash($item);
                $cleanTags = strtolower(parent::removeSpecialChars($tag));
                $output .= '<li><a href="'.parent::getSitePath().'tag/'.$cleanTags.'">'.parent::dashToSpace($tag).'</a></li>';
            }
            $output .= '</ul>';
            return $output;
        }
	}
?>
