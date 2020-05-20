<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PhotoAlbum
 *
 * @author Suharshana DsW
 */
class PhotoAlbum {

    public $id;
    public $title;
    public $image_name;
    public $description;
    public $queue;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`title`,`image_name`,`description`,`queue` FROM `photo_album` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->title = $result['title'];
            $this->image_name = $result['image_name'];
            $this->description = $result['description'];
            $this->queue = $result['queue'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `photo_album` (`title`,`image_name`,`description`,`queue`) VALUES  ('"
                . $this->title . "','"
                . $this->image_name . "', '"
                . $this->description . "', '"
                . $this->queue . "')";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            $last_id = mysql_insert_id();

            return $this->__construct($last_id);
        } else {
            return FALSE;
        }
    }

    public function all() {

        $query = "SELECT * FROM `photo_album` ORDER BY queue ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `photo_album` SET "
                . "`title` ='" . $this->title . "', "
                . "`image_name` ='" . $this->image_name . "', "
                . "`description` ='" . $this->description . "', "
                . "`queue` ='" . $this->queue . "' "
                . "WHERE `id` = '" . $this->id . "'";

        $db = new Database();

        $result = $db->readQuery($query);

        if ($result) {
            return $this->__construct($this->id);
        } else {
            return FALSE;
        }
    }

    public function delete() {

        $this->deletePhotos();

        unlink(Helper::getSitePath() . "upload/photo-album/" . $this->image_name);

        $query = 'DELETE FROM `photo_album` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function deletePhotos() {

        $ALBUM_PHOTOS = new AlbumPhoto(NULL);

        $allPhotos = $ALBUM_PHOTOS->getAlbumPhotosById($this->id);

        foreach ($allPhotos as $photo) {

            $IMG = $ALBUM_PHOTOS->image_name = $photo["image_name"];
            unlink(Helper::getSitePath() . "upload/photo-album/gallery/" . $IMG);
            unlink(Helper::getSitePath() . "upload/photo-album/gallery/thumb/" . $IMG);

            $ALBUM_PHOTOS->id = $photo["id"];
            $ALBUM_PHOTOS->delete();
        }
    }

    public function arrange($key, $img) {
        $query = "UPDATE `photo_album` SET `queue` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

}
