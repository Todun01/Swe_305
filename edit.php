<?php
    include("connection.php");

    $userId = $_GET["user_id"];
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
</head>
<body>
    <?php if(!empty($fetchUserData)) { ?>
<form action="assignment2.php" method="POST">
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
            Password: <input type="password" name="password" id="" value=<?= $fetchUserData['password']?>>
        </p>
        <button type="submit" name="add_entry">I'm Ready!</button>
    </form>
    <?php } else{ ?>
        <h1>User not found</h1>
        <?php } ?>
</body>
</html>