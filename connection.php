<?php

    $conn = mysqli_connect("localhost", "root","", "authentication");

    if (!$conn) {
        die("Failed to connec to database " . mysqli_error($conn));
    }

?>