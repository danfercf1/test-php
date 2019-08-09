<?php

class Users{
    private $error = array("status" => "0", "message" => "error", "result" => "Something wrong!!!");
    private $conn;
    function __construct($conn) {
        $this->conn = $conn;
    }
    //Get all users
    public function getUsers()
    {
        $users = [];
        $qry = "SELECT * from users";
        $result = mysqli_query($this->conn, $qry);

        while ($row = mysqli_fetch_row($result))
        {
            $users[] = array("id" => $row[0], "firstName" => $row[1], "surNames" => $row[2]);
        }

        return array("status" => "1", "message" =>"success", "result" => $users);
    }

    //Create a new user
    public function createUser(){
        $body = json_decode(file_get_contents('php://input'), true);
        if($body && !empty($body)) {
            $firstName = $body['firstName'];
            $surName = $body['surName'];
            $qry="INSERT INTO users(first_name, sur_name) values ('$firstName','$surName')";
            if(mysqli_query($this->conn, $qry))
            {
                $data = array("status" => "1", "message" => "success", "result" => "User added successfully");
            }
            else{
               $data = $this->error;
            }
        } else {
            $data = $this->error;
        }

        return $data;
    }
}
