<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "swe305_c1";

$connection =mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);

$firstname = "Oluwatodunni";
$lastname = "Obafemi";
$phonenumber = "+2348131546396";
$address = "asadam,ilorin";
$password = md5("lenovo");
$email = "obafemitodunni@gmail.com";



if(isset($_POST["add_record"])){
    $firstname = mysqli_escape_string($connection, $_POST["firstname"]);
    $lastname = mysqli_escape_string($connection, $_POST["lastname"]);
    $phonenumber = mysqli_escape_string($connection, $_POST["phonenumber"]);
    $address = mysqli_escape_string($connection, $_POST["address"]);
    $password = mysqli_escape_string($connection, $_POST["password"]);
    $confirmpassword = mysqli_escape_string($connection, $_POST["confirmpassword"]);
    $email = mysqli_escape_string($connection, $_POST["email"]);

    $error = null;
    $success = null;
    $pass = null;

    if($password != $confirmpassword){
        $error = "Password Mismatch";
    } else{
        $pass = md5($password);
    }
    $insertQuery = "INSERT INTO users (firstname, lastname, email, password, address, phonenumber)  VALUES ('$firstname','$lastname', '$email', '$pass', '$address', '$phonenumber')";
    $executeQuery = mysqli_query($connection, $insertQuery);
    if($executeQuery) {
        $success = "Record inserted successfully";
    }else{
        $error = "Error while insertng record";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Record</title>
    <style>
        .success{
            background-color: green;
            color: black;
            padding: 30px;
        }
        
        .failure{
            background-color: red;
            color: black;
            padding: 30px;
        }
    </style>
</head>
<body>
     <?php if (! empty($success)) { ?>
            <p class="success"><?= $success ?></p>
    <?php } if(! empty($error)) { ?>
            <p class="failure"><?= $error ?></p>
    <?php } ?>
    <form action="dbconnect.php" method="POST" enctype="">
        <p>
            Firstname: <input type="text" name="firstname" id="" placeholder="Enter your firstname">
        </p>
        <p>
            Lastname: <input type="text" name="lastname" id="" placeholder="Enter your lastname">
        </p>
        <p>
            Phone Number: <input type="text" name="phonenumber" id="" placeholder="Enter your phone number">
        </p>
        <p>
            Address: <br><textarea name="address" id="address" placeholder="Enter your address here" col= "3" rows= "10"></textarea>
        </p>
        <p>
            Email: <input type="email" name="email" id="" placeholder="Enter your email">
        </p>
        <p>
            Password: <input type="password" name="password" id="" placeholder="Enter your password">
        </p>
        <p>
            Confirm Password: <input type="password" name="confirmpassword" id="" placeholder="Enter your password again">
        </p>
        <button type="submit" name="add_record">Submit</button>
    </form>
</body>
</html>