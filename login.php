<?php

    session_start();

    if (isset($_POST['username'])) {
        include('connection.php');

        $username = $_POST['username'];
        $password = $_POST['password'];
        $passworddec = md5($password);
        
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$passworddec'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {

            $row = mysqli_fetch_array($result);

            $_SESSION['userid'] = $row['id'];
            $_SESSION['user'] = $row['firstname'] . " " . $row['lastname'];
            $_SESSION['userlevel'] = $row['userlevel'];

            if ($_SESSION['userlevel'] == 'admin') {
                header("Location: admin_page.php");
            } 
            
            if ($_SESSION['userlevel'] == 'member') {
                header("Location: user_page.php");
            } 
        } else {
            echo "<script>alert('Incorrect Username or Password');</script>";
        }
    } else {
        header("Location: index.php");
    }
?>