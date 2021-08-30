<?php

require_once('../../db/dbhelper.php');

$con = mysqli_connect(host, username, password, database);

$email = $_POST["email"];
$sqlcheckEmail = "select * from users where email='$email'";

$resultCheck = mysqli_query($con, $sqlcheckEmail);
$check = mysqli_fetch_row($resultCheck);
if($check) {
    echo "true";
} else {
    echo "false";
}

?>