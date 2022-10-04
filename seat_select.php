<!DOCTYPE HTML>
<html>
</head>
<body>

<?php
    session_start();

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "air_i_here";

    /*
    $_SESSION['customer_id'];
    $_SESSION['personal_id'];
    $_SESSION['firstname'];
    $_SESSION['lastname'];
    $_SESSION['middlename'];
    $_SESSION['gender'];
    $_SESSION['date_of_birth'];
    $_SESSION['address'];*/

    $conn = new mysqli($servername,$username,$password,$dbname);

    if($conn->connect_error){
        die("Cannot connect to database, reason: ".$conn->connect_error);
    }

    $flight_id_and_plane_id =  explode(" ",$_POST['flight_id_and_plane_id']);
    $_SESSION['flight_id'] = $flight_id_and_plane_id[0];
    $_SESSION['plane_id'] = $flight_id_and_plane_id[1];

    $stmt = $conn->prepare("SELECT seat_id from booking");
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($booked_seat_id);

    while($stmt->fetch())
    {
        echo $booked_seat_id."<br>";
    }

    echo "<select name=\"seat_id\" id = \"seat_select\" multiple>";

    for($i=1;$i<=6;$i++){
        for($j=1;$j<=6;$j++){
        echo "<option value="."\"".(6*($i-1)+$j)."\">".(6*($i-1)+$j)."</option>";
        }
        echo "<br>";
    }

    echo "</select>";



    

    $conn->close();

    /*while($stmt->fetch()){
    echo $result;
    }*/


?>


</body>


</html>