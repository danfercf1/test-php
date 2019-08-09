<?php
try{
    include 'db/connection.php';
    include 'classes/Users.php';
    $method_name=$_SERVER["REQUEST_METHOD"];
    $users = new Users($conn);
    if($_SERVER["REQUEST_METHOD"])
    {
        $data = [];

        switch ($method_name)
        {
            case 'GET':
                $data = $users->getUsers();
                break;
            case 'POST':
                $data = $users->createUser();
                break;

            case 'PUT':

            case 'DELETE':
        }
        echo json_encode($data);
    }
    else{
        $data=array("status"=>"0","message"=>"Please enter proper request method !! ");
        echo json_encode($data);
    }

}
catch(Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}
?>