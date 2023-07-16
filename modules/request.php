<?php

class request {
    private $mysqli;
    private static $instance;

    /**
     * @throws Exception
     */
    private function __construct() {
        $this->mysqli = new mysqli("localhost", "root", "", "barangay_web_based_system");
        if ($this->mysqli->connect_errno)
            throw new Exception("Request Database Error: " . $this->mysqli->connect_error);
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new request();
        }
        return self::$instance;
    }

    /**
     * @throws Exception
     */
    public function createRequest($resident_id, $status, $requested_date, $due_date, $requested_type) {
        $resident_id = $this->mysqli->real_escape_string($resident_id);
        $status = $this->mysqli->real_escape_string($status);
        $requested_date = $this->mysqli->real_escape_string($requested_date);
        $due_date = $this->mysqli->real_escape_string($due_date);
        $requested_type = $this->mysqli->real_escape_string($requested_type);

        $sql = "INSERT INTO request (resident_id, status, requested_date, due_date, request_type) 
                VALUES ('$resident_id', '$status', '$requested_date', '$due_date', '$requested_type')";

        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            throw new Exception("Create Request Error: " . $this->mysqli->error);
        }
    }

    public function getRequests() {
        $sql = "SELECT * FROM request";
        $result = $this->mysqli->query($sql);
        $residents = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $residents[] = $row;
            }
        }

        return $residents;
    }

    public function getRequestsPagination() {
        $page_no = (isset($_GET['page_no']) && $_GET['page_no'] !== "") ? $_GET['page_no'] : 1;
        $max_row_per_page = 10;
        $offset = ($page_no - 1) * $max_row_per_page;
        $previous_page = $page_no - 1;
        $next_page = $page_no + 1;
        $max_num = $this->mysqli->query("SELECT * FROM request")->num_rows;
        $total_no_of_pages = ceil($max_num / $max_row_per_page);
        $pagination = [
            'page_no' => $page_no,
            'previous_page' => $previous_page,
            'next_page' => $next_page,
            'total' => $total_no_of_pages
        ];

        $sql = "SELECT request.*, CONCAT(resident.resident_given_name, ' ', resident.resident_middle_name, ' ', resident.resident_last_name) AS name
        FROM request
        JOIN resident ON request.resident_id = resident.resident_id
        LIMIT $offset, $max_row_per_page";
        $result = $this->mysqli->query($sql);
        $residents = [];

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $residents[] = $row;
            }
        }

        return [$residents, $pagination];
    }

    public function getResidentsName()
    {
        $sql = "SELECT resident_id, CONCAT(resident.resident_given_name, ' ', resident.resident_middle_name, ' ', resident.resident_last_name) AS name
        FROM resident";
        $result = $this->mysqli->query($sql);
        $residents = [];

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $residents[] = $row;
            }
        }

        return $residents;
    }

    public function displayStatus()
    {
        return [
            'Paid', 'Pending', 'Unclaimed', 'Claimed'
        ];
    }

    public function displayRequestedType()
    {
        return  [
            'Barangay clearance',
            'Proof of residency',
            'Certificate of indigency',
            'Cedula',
            'Scheduling',
            'Business permit'
        ];
    }


    /**
     * @throws Exception
     */
    public function updateRequest($request_id, $given_name, $middle_name, $last_name, $birth_date, $birth_place, $number, $address) {
        $request_id = $this->mysqli->real_escape_string($request_id);
        $given_name = $this->mysqli->real_escape_string($given_name);
        $middle_name = $this->mysqli->real_escape_string($middle_name);
        $last_name = $this->mysqli->real_escape_string($last_name);
        $birth_date = $this->mysqli->real_escape_string($birth_date);
        $birth_place = $this->mysqli->real_escape_string($birth_place);
        $number = $this->mysqli->real_escape_string($number);
        $address = $this->mysqli->real_escape_string($address);

        $sql = "UPDATE request SET resident_given_name='$given_name', resident_middle_name='$middle_name', resident_last_name='$last_name', resident_birth_date='$birth_date', resident_birth_place='$birth_place', resident_number='$number', resident_address='$address' WHERE request_id='$request_id'";

        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            throw new Exception("Update Request Error: " . $this->mysqli->error);
        }
    }

    public function deleteRequest($request_id) {
        $request_id = $this->mysqli->real_escape_string($request_id);

        $sql = "DELETE FROM request WHERE request_id='$request_id'";
        if ($this->mysqli->query($sql)) {
            return true;
        } else {
            throw new Exception("Delete Request Error: " . $this->mysqli->error);
        }

    }


    public function closeConnection() {
        $this->mysqli->close();
    }

}