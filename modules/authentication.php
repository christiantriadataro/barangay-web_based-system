<?php
class Authentication {
    private $mysqli;
    private static $instance;

    private function __construct() {
        $this->mysqli = new mysqli("localhost", "root", "", "barangay_web_based_system");
        if ($this->mysqli->connect_errno)
            throw new Exception("Resident Database Error: " . $this->mysqli->connect_error);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new Authentication();
        }
        return self::$instance;
    }

    public function createAuthentication($authen_email, $authen_password) {
        $sql = "SELECT resident_id FROM resident ORDER BY resident_id DESC LIMIT 1";
        $recent_resident_id = $this->mysqli->query($sql)->fetch_array()['resident_id'];
        $recent_resident_id++;
        $sql = "INSERT INTO authentication (authen_email, authen_password, resident_id)
        VALUES ('$authen_email', '$authen_password', '$recent_resident_id')";

        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            throw new Exception("Create Authentication Error: " . $this->mysqli->error);
        }
    }

    public function getAuthentication($resident_id) {
        $sql = "SELECT authen_email, authen_password FROM authentication WHERE resident_id='$resident_id'";
        return $this->mysqli->query($sql)->fetch_row();
    }

    public function updateAuthentication($resident_id, $authen_email, $authen_password) {
        $authen_email = $this->mysqli->real_escape_string($authen_email);
        $authen_password = $this->mysqli->real_escape_string($authen_password);
        $sql = "UPDATE authentication SET authen_email='$authen_email', authen_password='$authen_password'
                WHERE resident_id='$resident_id'";

        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            throw new Exception("Update Authentication Error: " . $this->mysqli->error);
        }
    }

    public function deleteAuthentication($resident_id) {
        $resident_id = $this->mysqli->real_escape_string($resident_id);

        $sql = "DELETE FROM authentication WHERE resident_id='$resident_id'";
        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            throw new Exception("Delete Authentication Error: " . $this->mysqli->error);
        }
    }

}