<?php
    include("connection.php");

    if(isset($_POST["update_entry"])){
        $legalname = mysqli_escape_string($connection, $_POST["legalname"]);
        $username = mysqli_escape_string($connection, $_POST["username"]);
        $os = mysqli_escape_string($connection, $_POST["os"]);
        $favgamegenre = mysqli_escape_string($connection, $_POST["favorite_game_genre"]);
        $email = mysqli_escape_string($connection, $_POST["email"]);
        $password = mysqli_escape_string($connection, $_POST["password"]);
        $confirmpassword = mysqli_escape_string($connection, $_POST["confirmpassword"]);
        $userId = mysqli_escape_string($connection, $_POST["id"]);
    
        $error = null;
        $success = null;
        $pass = null;
    
        if($password != $confirmpassword){
            $error = "Your passwords are not the same!";
        }else{
            $pass = md5($password);
        }
        $updateQuery = "UPDATE customers SET legalname = '$legalname', username = '$username', os = '$os', favorite_game_genre='$favgamegenre', email = '$email', password = '$pass' WHERE id = '$userId'";
        $saveQuery = mysqli_query($connection, $updateQuery);
        if($saveQuery){
            $success = "Changes saved Successfully";
        }else{
            $error = "Oops! Failed to update record";
        }
    }

    $userId = isset($_POST['id'])?$_POST['id']:$_GET['id'];
    $fetchUserQuery = "SELECT * FROM customers WHERE id = $userId";
    $fetchUserResult = mysqli_query($connection, $fetchUserQuery);
    $fetchUserData = mysqli_fetch_assoc($fetchUserResult);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
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
    <?php if(!empty($error)){ ?>
        <p class="error"><?= $error ?></p>
    <?php } ?>
    <?php if(!empty($success)){ ?>
        <p class="success"><?= $success ?></p>
    <?php } ?>
    <?php if(!empty($fetchUserData)) { ?>
<form action="edit.php" method="POST">
        <p>
            Legal Name: <input type="text" name="legalname" id="" value=<?= $fetchUserData['legalname']?>>
        </p>
        <p>
            Username: <input type="text" name="username" id="" value=<?= $fetchUserData['username']?>>
        </p>
        <p>
            Operating System: <input type="text" name="os" id="" value=<?= $fetchUserData['os']?>>
        </p>
        <p>
            Fav. Game Genre: <input type="text" name="favorite_game_genre" id="" value=<?= $fetchUserData['favorite_game_genre']?>>
        </p>
        <p>
            Email: <input type="email" name="email" id="" value=<?= $fetchUserData['email']?>>
        </p>
        <p>
            Password: <input type="password" name="password" id="" >
        </p>
        <p>
            Confirm Password: <input type="password" name="confirmpassword" id="">
        </p>
        <p>
            <input type="hidden" name="id" value="<?= $fetchUserData['id']?>">
        </p>
        <button type="submit" name="update_entry">Save Changes</button>
    </form>
    <?php } else{ ?>
        <h1>User not found</h1>
        <?php } ?>
</body>
</html>