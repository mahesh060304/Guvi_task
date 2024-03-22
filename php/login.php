<?php
    $email = $_POST["email"];
    $password = $_POST["password"];
        

    $con=mysqli_connect("localhost","root","","login");
    if($con->connect_error){
        exit("Connection failed ".$connect_error);
    }
    if(!isset($email,$password)){
        exit("Empty fields");   
    }
    if(empty($email)||empty($password)){
        exit("Empty values");
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit ("Invalid email format: $email");
    }

    if(strlen($password)<6){
        exit("Password Should be of min length 6");
    }


    if ($stmt = $con->prepare("SELECT * FROM user_details WHERE email=?")) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res = $stmt->get_result();
        if ($res->num_rows > 0) {
            $data = $res->fetch_assoc();
            $hashedPasswordFromDB = $data['password'];
    
            if (password_verify($password, $hashedPasswordFromDB)) {
                echo "LOGGED IN SUCCESSFULLY";
            } else {
                echo "INVALID PASSWORD";
            }
        } else {
            echo "PLEASE REGISTER";
        }
        $stmt->close();
    } else {
        echo "ERROR OCCURRED";
    }
    
    $con->close();
?>                                                                                                       