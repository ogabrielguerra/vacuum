<?php

    class GetThePage extends Base
    {

        private $slug;

        public function __construct(string $slug)
        {

            parent::__construct();
            $this->slug = $slug;
            $this->loadPageData();
        }

        private function loadPageData(): void
        {
            $path = parent::getPagesPath() . '/';
            $jsonPath = $path . $this->slug . ".json";
            $defaultJsonPath = $path . 'default.json';

            try {
                if (file_exists($jsonPath)) {
                    $json = file_get_contents($jsonPath);
                    //Convert json attributes as object attributes
                    parent::convertJsonToObjAttributes(json_decode($json, true), $this);
                } else if (file_exists($defaultJsonPath)) {
                    $json = file_get_contents($defaultJsonPath);
                    //Convert json attributes as object attributes
                    parent::convertJsonToObjAttributes(json_decode($json, true), $this);
                } else {
                    throw new Exception('Metadata file not found.');
                }
            } catch (Exception $e) {
                //TODO To plug a log component like Monolog
                die($e->getMessage());
            }
        }

        private function getPageMetaData(): array
        {
            return $this->metaData;
        }

    }