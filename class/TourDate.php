<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of tour_dates
 *
 * @author Suharshana DsW
 */
class TourDate {

    public $id;
    public $tour;
    public $title;
    public $image_name;
    public $description;
    public $queue;

    public function __construct($id) {
        if ($id) {

            $query = "SELECT `id`,`tour`,`title`,`image_name`,`description`,`queue` FROM `tour_date` WHERE `id`=" . $id;

            $db = new Database();

            $result = mysql_fetch_array($db->readQuery($query));

            $this->id = $result['id'];
            $this->tour = $result['tour'];
            $this->title = $result['title'];
            $this->image_name = $result['image_name'];
            $this->description = $result['description'];
            $this->queue = $result['queue'];

            return $this;
        }
    }

    public function create() {

        $query = "INSERT INTO `tour_date` (`tour`,`title`,`image_name`,`description`,`queue`) VALUES  ('"
                . $this->tour . "','"
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

        $query = "SELECT * FROM `tour_date` ORDER BY queue ASC";
        $db = new Database();
        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }

        return $array_res;
    }

    public function update() {

        $query = "UPDATE  `tour_date` SET "
                . "`tour` ='" . $this->tour . "', "
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

        $this->deleteDatesPhotos();

        $query = 'DELETE FROM `tour_date` WHERE id="' . $this->id . '"';

        $db = new Database();

        return $db->readQuery($query);
    }

    public function deleteDatesPhotos() {

        $TOUR_DATE_PHOTOS = new TourDatePhoto(NULL);

        $allPhotos = $TOUR_DATE_PHOTOS->getTourDatePhotosById($this->id);

        foreach ($allPhotos as $photo) {

            $IMG = $TOUR_DATE_PHOTOS->image_name = $photo["image_name"];
            unlink(Helper::getSitePath() . "upload/tour-package/date/gallery/" . $IMG);
            unlink(Helper::getSitePath() . "upload/tour-package/date/gallery/thumb/" . $IMG);

            $TOUR_DATE_PHOTOS->id = $photo["id"];
            $TOUR_DATE_PHOTOS->delete();
        }
    }

    public function getTourDatesById($tour) {

        $query = "SELECT * FROM `tour_date` WHERE `tour`= $tour ORDER BY queue ASC";

        $db = new Database();

        $result = $db->readQuery($query);
        $array_res = array();

        while ($row = mysql_fetch_array($result)) {
            array_push($array_res, $row);
        }
        return $array_res;
    }

    public function arrange($key, $img) {
        $query = "UPDATE `tour_date` SET `queue` = '" . $key . "'  WHERE id = '" . $img . "'";
        $db = new Database();
        $result = $db->readQuery($query);
        return $result;
    }

}
