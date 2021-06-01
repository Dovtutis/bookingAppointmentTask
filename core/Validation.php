<?php


namespace app\core;


class Validation
{
    private $db;

    public function __construct()
    {
        $this->db = Application::$app->db;
    }

    /**
     * Checks if every array value is empty
     * @param array $arr
     * @return bool
     */
    public function ifEmptyArray($arr)
    {
        foreach ($arr as $value){
            if (!empty($value)) return false;
        }
        return true;
    }

    /**
     * Checks if given field is empty. Returns given message if empty.
     *
     * @param string $field
     * @param string $msg
     * @return string
     */
    public function validateEmpty($field, string $msg)
    {
        return empty($field) ? $msg : '';
    }

    public function userRegistrationExists($data)
    {
        $this->db->query("SELECT * FROM appointments WHERE name = :name && lastname = :lastname");
        $this->db->bind(':name', $data['name']);
        $this->db->bind(':lastname', $data['lastname']);

        $row = $this->db->resultSet();

        if ($this->db->rowCount()>0){
            return $row;
        }else{
            return false;
        }
    }

    public function validateTime($data)
    {
        $this->db->query("SELECT * FROM appointments WHERE day = :day && time = :time");
        $this->db->bind(':day', $data['day']);
        $this->db->bind(':time', $data['time']);

        $row = $this->db->singleRow();

        if ($this->db->rowCount()>0){
            return true;
        }else{
            return false;
        }
    }
}