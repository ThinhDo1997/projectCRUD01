<?php
require_once('../../db/dbhelper.php');

    $con = mysqli_connect("localhost", "root", "");
    $db = mysqli_select_db($con, 'project01');
    // mysqli_close($con);

    if(isset($_POST['deletedata']))
    {
        // echo 'deletedata';
        $id = $_POST['delete_id'];
        
        // echo'$id';
        $query = "delete from users where id='$id' ";
        
        $query_run = mysqli_query($con, $query);
        // execute($query);
        if($query_run)
        {
            echo '<script>alert("deleted");</script>';
            header("Location:index.php");
        } else {
            echo '<script>alert("not deleted");</script>';
            header("Location:index.php");
        }
    }
?>