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

    $username = $_POST['username'];
    $password = $_POST['password'];
    $personal_id = (int)$_POST['personal_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $middle_name = $_POST['middle_name'];
    $gender = $_POST['gender'];
    $date_of_birth = $_POST['date_of_birth'];
    $address = $_POST['house_no']." ".$_POST['group']." ".$_POST['sub_district']." ".$_POST['district']." ".$_POST['province']." ".$_POST['country']." ".$_POST['postal_code'];

    $stmt = $conn->prepare("INSERT INTO customer(personal_id,first_name,middle_name,last_name,gender,date_of_birth,address) VALUES (?,?,?,?,?,?,?)");
    $stmt->bind_param("issssss", $personal_id,$first_name,$middle_name,$last_name,$gender,$date_of_birth,$address);
    $stmt->execute();
    
    $stmt = $conn->prepare("INSERT INTO account(username,password) VALUES (?,?)");
    $stmt->bind_param("ss", $username,$password);
    $stmt->execute();

    



    $conn->close();


    /*while($stmt->fetch()){
    echo $result;
    }*/


?>

<a href="login.php">Go back to login</a>

</body>


</html>