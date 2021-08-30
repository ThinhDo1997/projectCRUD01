<?php

    require_once('config.php');

    function execute($sql) {
        $con = mysqli_connect(host, username, password, database);
        mysqli_query($con, $sql);
        mysqli_close($con);
    }

    function executeResult($sql) {
        $con = mysqli_connect(host, username, password, database);
        $result = mysqli_query($con, $sql);
        $data = [];
        while($row = mysqli_fetch_array($result, 1)) {
            $data[] = $row;
        }

        mysqli_close($con);

        return $data;
    }

//lay ra 1 bang ghi
    function executeSingleResult($sql) {
        $con = mysqli_connect(host, username, password, database);
        $result = mysqli_query($con, $sql);
       
        $row = mysqli_fetch_array($result, 1);

        mysqli_close($con);
 
        return $row;
    }    
?>