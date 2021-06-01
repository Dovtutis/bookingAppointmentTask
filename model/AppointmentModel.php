<?php


namespace app\model;

use app\core\Database;
use app\core\Application;

/**
 * This model will handle SQL query's for appointments.
 *
 * Class CommentsModel
 * @package app\model
 */
class AppointmentModel
{
    private $db;

    public function __construct()
    {
        $this->db = Application::$app->db;
    }

    /**
     * Returns all appointments from database.
     *
     * @return array|false
     */
    public function getAppointments()
    {

    }

    /**
     * Adds appointment to the database
     *
     * @param $data
     * @return bool
     */
    public function addAppointment($data)
    {
        $this->db->query("INSERT INTO appointments (name, lastname, day, time, week) VALUES (:name, :lastname, :day, :time, :week)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':day', $data['day']);
        $this->db->bind(':time', $data['time']);
        $this->db->bind(':week', $data['weekOfTheYear']);

        if ($this->db->execute()){
            return true;
        }else {
            return false;
        }
    }
}