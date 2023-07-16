<?php

class Resident
{
    private $mysqli;
    private static $instance;

    /**
     * @throws Exception
     */
    private function __construct()
    {
        $this->mysqli = new mysqli("localhost", "root", "", "barangay_web_based_system");
        if ($this->mysqli->connect_errno)
            throw new Exception("Resident Database Error: " . $this->mysqli->connect_error);
    }

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Resident();
        }
        return self::$instance;
    }

    /**
     * @throws Exception
     */
    public function createResident($given_name, $middle_name, $last_name, $birth_date, $birth_place, $number, $address)
    {
        $given_name = $this->mysqli->real_escape_string($given_name);
        $middle_name = $this->mysqli->real_escape_string($middle_name);
        $last_name = $this->mysqli->real_escape_string($last_name);
        $birth_date = $this->mysqli->real_escape_string($birth_date);
        $birth_place = $this->mysqli->real_escape_string($birth_place);
        $number = $this->mysqli->real_escape_string($number);
        $address = $this->mysqli->real_escape_string($address);

        $sql = "INSERT INTO resident (resident_given_name, resident_middle_name, resident_last_name, resident_birth_date, resident_birth_place, resident_number, resident_address, resident_role) 
                VALUES ('$given_name', '$middle_name', '$last_name', '$birth_date', '$birth_place', '$number', '$address', 'resident')";

        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            throw new Exception("Create Resident Error: " . $this->mysqli->error);
        }
    }

    public function getResidents()
    {
        $sql = "SELECT * FROM resident";
        $result = $this->mysqli->query($sql);
        $residents = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $residents[] = $row;
            }
        }

        return $residents;
    }




    public function getResidentsPagination()
    {
        $page_no = (isset($_GET['page_no']) && $_GET['page_no'] !== "") ? $_GET['page_no'] : 1;
        $max_row_per_page = 10;
        $offset = ($page_no - 1) * $max_row_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $max_num = $this->mysqli->query("SELECT * FROM resident WHERE resident_role = 'resident'")->num_rows;
        $total_no_of_pages = ceil($max_num / $max_row_per_page);
        $pagination = [
            'page_no' => $page_no,
            'previous_page' => $previous_page,
            'next_page' => $next_page,
            'total' => $total_no_of_pages
        ];

        $sql = "SELECT * FROM resident WHERE resident_role = 'resident'
        LIMIT $offset, $max_row_per_page";
        $result = $this->mysqli->query($sql);
        $residents = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $residents[] = $row;
            }
        }

        return [$residents, $pagination];
    }


    /**
     * @throws Exception
     */
    public function updateResident($resident_id, $given_name, $middle_name, $last_name, $birth_date, $birth_place, $number, $address)
    {
        $resident_id = $this->mysqli->real_escape_string($resident_id);
        $given_name = $this->mysqli->real_escape_string($given_name);
        $middle_name = $this->mysqli->real_escape_string($middle_name);
        $last_name = $this->mysqli->real_escape_string($last_name);
        $birth_date = $this->mysqli->real_escape_string($birth_date);
        $birth_place = $this->mysqli->real_escape_string($birth_place);
        $number = $this->mysqli->real_escape_string($number);
        $address = $this->mysqli->real_escape_string($address);

        $sql = "UPDATE resident SET resident_given_name='$given_name', resident_middle_name='$middle_name', resident_last_name='$last_name', resident_birth_date='$birth_date', resident_birth_place='$birth_place', resident_number='$number', resident_address='$address' WHERE resident_id='$resident_id'";

        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            throw new Exception("Update Resident Error: " . $this->mysqli->error);
        }
    }

    public function deleteResident($resident_id)
    {
        $resident_id = $this->mysqli->real_escape_string($resident_id);

        $sql = "DELETE FROM resident WHERE resident_id='$resident_id'";
        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            throw new Exception("Delete Resident Error: " . $this->mysqli->error);
        }

    }


    public function closeConnection()
    {
        $this->mysqli->close();
    }

}