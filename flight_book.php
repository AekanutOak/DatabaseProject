<!DOCTYPE HTML>
<html>
<head></head>
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

    $stmt = $conn->prepare("SELECT a.flight_id,a.plane_id,a.depart_time, b.location_name as depart, c.location_name as destination FROM flight a INNER JOIN location b ON a.departure_id = b.location_id INNER JOIN location c on a.destination_id = c.location_id;");
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($flight_id,$plane_id,$depart_time,$depart,$destination);

    $flight_select =  "<form action=\"seat_select.php\" method = \"POST\">
    <label>Select flight</label><br>
    <select name = \"flight_id_and_plane_id\">";

    while($stmt->fetch()){
        $flight_select = $flight_select."<option value=\"".$flight_id." ".$plane_id."\">".$depart." -> ".$destination." ,depart : ".$depart_time."</option>";

    }

    $flight_select = $flight_select."</select><br><input type=\"submit\" value = \"submit\"></form>";
    echo $flight_select;

    

    $conn->close();

    /*while($stmt->fetch()){
    echo $result;
    }*/


?>


</body>


</html>