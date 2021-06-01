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
        $this->db->query("SELECT appointments.id, appointments.date, appointments.time, appointments.month, appointments.day FROM appointments");
        $appointments = $this->db->resultSet();

        if ($this->db->rowCount() > 0){
            return $appointments;
        }
        return false;
    }

    /**
     * Adds appointment to the database
     *
     * @param $data
     * @return bool
     */
    public function addAppointment($data)
    {
        $this->db->query("INSERT INTO appointments (name, lastname, date, time, month, week, day) VALUES (:name, :lastname, :date, :time, :month, :week, :day)");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':lastname', $data['lastname']);
        $this->db->bind(':date', $data['date']);
        $this->db->bind(':time', $data['time']);
        $this->db->bind(':month', $data['monthOfTheYear']);
        $this->db->bind(':week', $data['weekOfTheYear']);
        $this->db->bind(':day', $data['dayOfTheMonth']);

        if ($this->db->execute()){
            return true;
        }else {
            return false;
        }
    }
}