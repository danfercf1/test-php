<?php

class Contact {
    private $error = array('status' => '0', 'message' => 'error', 'result' => 'Something is wrong!!!');
    private $conn;
    
    function __construct($conn){
        $this->conn = $conn;
    }
    
    //Get all contacts
    public function getContacts(){
        $contacts = [];
        $contactId = $_GET['id'];
        $qry = (isset($contactId)) ?
            "SELECT cnt.id, cnt.first_name, cnt.sur_name FROM contacts cnt WHERE id=".$contactId :
            "SELECT cnt.id, cnt.first_name, cnt.sur_name FROM contacts cnt";

        $result = mysqli_query($this->conn, $qry);

        while ($row = mysqli_fetch_row($result))
        {
            $id = $row[0];
            $information = $this->getInformation($id);

            $contacts[] = array('id' => (int) $row[0], 'firstName' => $row[1], 'surNames' => $row[2],
                'information' => $information);
        }

        return $contacts;
    }

    //Create a new user
    public function createContact(){
        $body = json_decode(file_get_contents('php://input'), true);

        if($body && !empty($body)) {
            $firstName = $body['firstName'];
            $surName = $body['surName'];
            $qry = "INSERT INTO contacts(first_name, sur_name) VALUES ('$firstName','$surName')";

            if($res = mysqli_query($this->conn, $qry))
            {
                $id = mysqli_insert_id($this->conn);

                if (isset($body['information']) && !empty($body['information'])){
                    foreach ($body['information'] as $information){
                        $this->saveInformation($id, $information);
                    }
                }
                $data = $res;
            }
            else{
               $data = $this->error;
            }
        } else {
            $data = $this->error;
        }

        return $data;
    }

    //Update an user by id
    public function updateContact(){
        $id = $_GET['id'];
        $body = json_decode(file_get_contents('php://input'), true);

        if($body && !empty($body) && $id) {
            $firstName = $body['firstName'];
            $surName = $body['surName'];
            $qry = "UPDATE contacts SET first_name='".$firstName."', sur_name='".$surName."' WHERE id='".$id."' ";

            if($res = mysqli_query($this->conn, $qry))
            {
                if (isset($body['information']) && !empty($body['information'])){
                    $this->deleteInformation($id);
                    foreach ($body['information'] as $information){
                        $this->saveInformation($id, $information);
                    }
                }
                $data = $res;
            }
            else{
                $data = $this->error;
            }
        } else {
            $data = $this->error;
        }

        return $data;
    }

    //Remove an user by id
    public function deleteContact(){
        $id = $_REQUEST['id'];

        if($id) {
            $qry = "DELETE FROM contacts WHERE id='".$id."'";

            if($res = mysqli_query($this->conn, $qry))
            {
                $data = $res;
            }
            else{
                $data = $this->error;
            }
        } else {
            $data = $this->error;
        }

        return $data;
    }

    // Save the information for an user
    private function saveInformation($id, $information){
        $res = false;
        $email = isset($information['email']) ? $information['email'] : '';
        $phoneNumber = isset($information['phoneNumber']) ? $information['phoneNumber'] : '';
        $contactId = $id;

        if($email !== ''){
            $qry = "INSERT INTO information(email, phone_number, contact_id) VALUES ('$email', '$phoneNumber', '$contactId')";

            if($result = mysqli_query($this->conn, $qry))
            {
                $res = $result;
            }
        } else {
            return $res;
        }

        return $res;
    }

    //Gets the information for an user
    private function getInformation($id){
        $information = [];

        $qry = "SELECT inf.email, inf.phone_number FROM information inf WHERE inf.contact_id=". (int) $id;

        $result = mysqli_query($this->conn, $qry);

        if (!$result) return $information;

        while ($row = mysqli_fetch_row($result))
        {
            $information[] = array('email' => $row[0], 'phone_number' => $row[1]);
        }

        return $information;
    }

    //Removes information for an user
    private function deleteInformation($id){

        $qry = "DELETE FROM information WHERE contact_id=". (int) $id;

        if($res = mysqli_query($this->conn, $qry))
        {
            $data = $res;
        }
        else{
            $data = $this->error;
        }

        return $data;
    }
}
