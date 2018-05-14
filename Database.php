<?php
/**
 * Created by PhpStorm.
 * User: Arafeh
 * Date: 5/14/2018
 * Time: 5:22 PM
 */

include "models/Media.php";

class Database
{
    /** @var mysqli */
    static $connection;

    static function getInstance()
    {
        if (!self::$connection) {
            self::$connection = new mysqli('localhost', 'root', '', 'waves');

        }
        return self::$connection;
    }

    /**
     * @param $content string
     * @param $path string
     * @param $lat double
     * @param $lng double
     * @return bool|mysqli_result
     */
    static function addMedia($content, $path, $lat, $lng)
    {
        $sql = "INSERT INTO media (Content, MediaPath, Lat, Lng) VALUES (
            '{$content}','{$path}',{$lat},{$lng}
        )";
        return self::getInstance()->query($sql);
    }

    /**
     * @return array
     */
    static function getMedias()
    {
        $sql = "SELECT * FROM media where IsDeleted = 0";
        $rows = self::getInstance()->query($sql)->fetch_all(MYSQLI_ASSOC);
        $medias = array_map(function ($assoc) {
            return new Media($assoc['MediaId'], $assoc['Content'], $assoc['MediaPath'], $assoc['Lat'], $assoc['Lng']);
        }, $rows);
        return $medias;
    }

}