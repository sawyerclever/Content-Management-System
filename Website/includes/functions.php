<?php
    function query_error($result) {
        global $connection;
        if(!$result) {
            die('<b>Query failed.</b> ' . mysqli_error($connection));
        }
    }
?>