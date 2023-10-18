<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "swe305_c2";

$connection =mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

if(isset($_POST["add_entry"])){
    $legalname = mysqli_escape_string($connection, $_POST["legalname"]);
    $username = mysqli_escape_string($connection, $_POST["username"]);
    $os = mysqli_escape_string($connection, $_POST["os"]);
    $favgamegenre = mysqli_escape_string($connection, $_POST["favorite_game_genre"]);
    $email = mysqli_escape_string($connection, $_POST["email"]);
    $password = mysqli_escape_string($connection, $_POST["password"]);
    $confirmpassword = mysqli_escape_string($connection, $_POST["confirmpassword"]);

    $error = null;
    $success = null;
    $pass = null;

    if($password != $confirmpassword){
        $error = "Your passwords are not the same!";
    }else{
        $pass = md5($password);
    }
    $insertQuery = "INSERT INTO customers (legalname, username, os, favorite_game_genre, email, password) 
    VALUES ('$legalname', '$username', '$os','$favgamegenre', '$email', '$pass')";
    $executeQuery = mysqli_query($connection, $insertQuery);
    if($executeQuery){
        $success = "Entry Recorded Successfully";
    }else{
        $error = "Failed to record entry";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error{
            background-color: red;
            color: black;
            padding: 30px;
        }
        .success{
            background-color: green;
            color: black;
            padding: 30px;
        }
        body{
            background-color: black;
        }
        p{
            color: white;

        }
        h1{
            color: black;
            background-color: darkred;
            padding: 25px;
        }
    </style>
</head>
<body>
    <h1>Welcome to  oTAG0! Your number 1 PC Gamers Society!</h1>
    <p style="color: darkred; padding-bottom: 20px">👇Get registered on our platform!👇</p>
    <?php if(!empty($error)){ ?>
        <p class="error"><?= $error ?></p>
    <?php } ?>
    <?php if(!empty($success)){ ?>
        <p class="success"><?= $success ?></p>
    <?php } ?>

    <form action="assignment2.php" method="POST">
        <p>
            Legal Name: <input type="text" name="legalname" id="" placeholder="Enter your full name">
        </p>
        <p>
            Username: <input type="text" name="username" id="" placeholder="Enter a username">
        </p>
        <p>
            Operating System: <input type="text" name="os" id="" placeholder="Enter the OS of your PC ">
        </p>
        <p>
            Fav. Game Genre: <input type="text" name="favorite_game_genre" id="" placeholder="Enter your favorite game genre">
        </p>
        <p>
            Email: <input type="email" name="email" id="" placeholder="Enter your email">
        </p>
        <p>
            Password: <input type="password" name="password" id="" placeholder="Enter your passsword">
        </p>
        <p>
            Confirm Password: <input type="password" name="confirmpassword" id="" placeholder="Enter your password again">
        </p>
        <button type="submit" name="add_entry">I'm Ready!</button>
    </form>
</body>
</html>