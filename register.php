<?php
    session_start();

    require_once "connection.php";
    
    if(isset($_POST['submit'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];

        $user_check = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = mysqli_query($conn, $user_check);
        $user = mysqli_fetch_assoc($result);

        if ($user['username'] === $username) {
            echo "<script>alert('Username already exists');</script>";
        } else {
            $passwordenc = md5($password);

            $query = "INSERT INTO users (username, password, firstname, lastname, userlevel)
                        VALUE ('$username', '$passwordenc', '$firstname', '$lastname', 'member')";
            $result = mysqli_query($conn, $query);

            if ($result) {
                $_SESSION['success'] = "Insert user successfully";
                header("Location: index.php");
            } else {
                $_SESSION['error'] = "Something went wrong";
                header("Location: index.php");
            }
        }
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register Page</title>
</head>
<body>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Enter your username" required>
        <br>
        <label for="username">Password</label>
        <input type="password" name="password" placeholder="Enter your password" required>
        <br>
        <label for="username">Firstname</label>
        <input type="text" name="firstname" placeholder="Enter your First-name" required>
        <br>
        <label for="username">Lastname</label>
        <input type="text" name="lastname" placeholder="Enter your Last-name" required>
        <br>
        <input type="submit" name="submit" value="Submit">
    
    </form>
    
    <a href="index.php">Go back to index</a>
</body>
</html>