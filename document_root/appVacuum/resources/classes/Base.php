<?php

class Base implements iBase
{

    /*
     * Initialize loading all folders and converting to post objects
     */
    public $sitePath;
    public $postsPath;
    public $pagesPath;

    public function __construct($envPath = '../appVacuum/')
    {
        $dotenv = Dotenv\Dotenv::createImmutable($envPath);
        $dotenv->load();

        $this->sitePath = getenv('APP_PATH');
        $this->postsPath = "./posts/";
        $this->pagesPath = "./pages/";
    }

    public function filterData(array $data): array
    {
        $newData = array_diff($data, array('..', '.', '.DS_Store'));
        $newData = array_values($newData);
        sort($newData);
        return $newData;
    }

    public function spaceToDash(string $str): string
    {
        if (strpos($str, " ") !== false)
            $str = str_replace(' ', '-', $str);
        return $str;
    }

    public function dashToSpace(string $str): string
    {
        if (strpos($str, "-") !== false)
            $str = str_replace('-', ' ', $str);
        return $str;
    }

    public function cleanString(string $str): string
    {
        return preg_replace('/[^A-Za-z0-9]/', '', $str);
    }

    public function removeSpecialChars($myString)
    {
        $badChars = array("á", "é", "ç", "ã", "ó", "à", "ê", "í", "ô", "ú", "â", "'", " ");
        $goodChars = array("a", "e", "c", "a", "o", "a", "e", "i", "o", "u", "a", "", "-");
        $size = count($badChars);

        for ($i = 0; $i < $size; $i++) {
            $pos = strpos($myString, $badChars[$i]);
            if ($pos == true) {
                $myNewString = str_replace($badChars[$i], $goodChars[$i], $myString);
                $myString = $myNewString;
            }
        }
        return $myString;
    }

    function getSitePath(): string
    {
        return $this->sitePath;
    }

    function getPostsPath(): string
    {
        return $this->postsPath;
    }

    function getPagesPath(): string
    {
        return $this->pagesPath;
    }

    function getSlug(): bool
    {
        if (isset($_GET["slug"]) && !empty($_GET["slug"])) {
            $slug = $_GET["slug"];
            $slug = $this->removeSpecialChars($slug);
            return $slug;
        } else {
            return false;
        }
    }

    function convertJsonToObjAttributes($json, $object)
    {
        $keys = array_keys((array)$json);
        $jsonSize = count($json);
        for ($i = 0; $i < $jsonSize; $i++)
            $object->{$keys[$i]} = $json[$keys[$i]];

        return $object;
    }

}