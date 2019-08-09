<?php
try{
    include 'db/connection.php';
    include 'classes/Contact.php';
    $method_name = $_SERVER['REQUEST_METHOD'];
    $Contact = new Contact($conn);

    if($_SERVER['REQUEST_METHOD']){
        $result = [];

        switch ($method_name){
            case 'GET':
                $contacts = $Contact->getContacts();
                $result = array('status' => '1', 'message' =>'success', 'result' => $contacts);
                break;

            case 'POST':
                $Contact->createContact();
                $result = array('status' => '1', 'message' => 'success', 'result' => 'Contact added successfully');
                http_response_code(201);
                break;

            case 'PUT':
                $Contact->updateContact();
                $result = array('status' => '1', 'message' => 'success', 'result' => 'Contact updated successfully');
                break;

            case 'DELETE':
                $Contact->deleteContact();
                $result = array('status' => '1', 'message' => 'success', 'result' => 'Contact deleted successfully');
                break;
        }
        echo json_encode($result);
    }
    else{
        $result = array('status' => '0', 'message' => 'Please enter proper request method !!');
        echo json_encode($result, JSON_PRETTY_PRINT);
    }
}
catch(Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), '\n';
}
