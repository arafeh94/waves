<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 5/14/2018
 * Time: 5:27 PM
 */

class Media
{
    public $MediaId;
    public $Content;
    public $MediaPath;
    public $Lat;
    public $Lng;

    public function __construct($id, $content, $path, $lat, $lng)
    {
        $this->MediaId = (int)$id;
        $this->Content = $content;
        $this->MediaPath = $path;
        $this->Lat = (double)$lat;
        $this->Lng = (double)$lng;
    }

}