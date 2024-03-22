<?php
   
require_once '../vendor/autoload.php';
include ("database.php");



if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['email'])) {
        $email = $_GET['email'];
        // echo $email;
        try {
            $user_detail = $mycollection->findOne(['Email' => $email]);
            if ($user_detail) {
                echo json_encode($user_detail);
            } else {
                echo json_encode(["error" => "Given email not found"]);
            }
        } catch (Exception $e) {
            echo json_encode(["error" => "Error: " . $e->getMessage()]);
        }
    }else{
        echo json_encode(["error" => "Data not set"]);
    }
}


else if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email'])) {
        $email = $_POST['email'];

        
    
        $filter = ['Email' => $email];
       $toUpdateData = [
       '$set' => [
        'dob' => $_POST['dob'],
        'age' => $_POST['age'],
        'contact' =>$_POST['contact']
        ]
       ];


        $result = $mycollection->updateOne($filter, $toUpdateData, ['upsert' => true]);

        if ($result->getModifiedCount() > 0) {
            echo "User data updated successfully!!!";
        } else {
            echo "Failed to update te data.";
        }
    } else {
        echo "Email not set.";
    }
}

?>  