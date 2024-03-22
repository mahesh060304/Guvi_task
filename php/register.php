    <?php
      require_once '../vendor/autoload.php';
        include ("database.php");


        $username=$_POST["username"];
        $email=$_POST["email"];
        $password=password_hash($_POST["password"],PASSWORD_DEFAULT);

       
        if($con->connect_error){
            exit("Connection error");
        }

        $con = mysqli_connect("localhost", "root", "", "login");
        if($con->connect_error){
        exit('Failed to connect to the database');
        }    
        if(!isset($username,$email,$password)){
            exit('Empty fields , null values');
        }

        if(empty($username)||empty($email)||empty($password)){
            exit('Empty Values , Please enter the below details');
        } 

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            exit ("Invalid email format: $email");
        }

        if(strlen($password)<6){
            exit("Password Should be of min length 6");
        }
    
        if($stmt = $con->prepare("SELECT * FROM user_details WHERE email=?")){
            $stmt->bind_param("s",$email);
            $stmt->execute();
            $result=$stmt->get_result();
            if($result->num_rows>0){
                echo "USER ALREADY EXISTS";
            }
            else{
                $stmt=$con->prepare("INSERT INTO `user_details` (`user_name`, `email`, `password`) VALUES (?,?,?)");
                $stmt->bind_param("sss",$username,$email,$password);
                if($stmt->execute()){
                    $userdetails=array(
                        "User_name"=>$username, 
                        "Email"=>$email,
                        "Password"=>$password
                    );
                    $mycollection->insertOne($userdetails);
                    echo "REGISTERED SUCCESSFULLY";
                }
            }
        }else{
            echo "ERROR OCCURED";
        }
    ?>