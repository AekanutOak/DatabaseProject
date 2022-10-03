<!DOCTYPE HTML>
<html>
<head></head>
<body>

<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "air_i_here";

    $conn = new mysqli($servername,$username,$password,$dbname);

    if($conn->connect_error){
        die("Cannot connect to database, reason: ".$conn->connect_error);
    }

    $stmt = $conn->prepare("SELECT username,password,customer_id from account WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $_POST['username'],$_POST['password']);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($username,$password,$customer_id);
    $stmt->fetch();

    if($stmt->num_rows == 0){
        echo "Cannot login<br>";
        exit();
    }

    else{
        echo "Welcome<br>";
        $stmt = $conn->prepare("SELECT first_name,middle_name,last_name from customer WHERE customer_id = ?");
        $stmt->bind_param("s",$customer_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($firstname,$middlename,$lastname);
        $stmt->fetch();
        if($middlename == "-"){
            echo $firstname." ".$lastname."<br>";
        } else {
            echo $firstname." ".$middlename." ".$lastname."<br>";
        }
    }

    $conn->close();

    /*while($stmt->fetch()){
    echo $result;
    }*/


?>


</body>


</html>