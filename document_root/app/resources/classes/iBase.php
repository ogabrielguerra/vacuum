<?php
    interface iBase{
        function filterData(Array $data) : array;
        function getSitePath() : string;
    }