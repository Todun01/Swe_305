<?php
    include("connection.php");

    $usercount = 1;


    $fetchQuery = "SELECT * FROM customers";
    $fetchResult = mysqli_query($connection, $fetchQuery);
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Database Record</title>
    <style>
        table, th, td{
            border: 1px solid;
            padding: 20px;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>S/N</th>
            <th>Legal Name</th>
            <th>Username</th>
            <th>OS</th>
            <th>Favorite Game Genre</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php while($fetchdata = mysqli_fetch_array($fetchResult)){ ?>
        <tr>
            <td><?= $usercount++?></td>
            <td><?= $fetchdata['legalname'] ?></td>
            <td><?= $fetchdata['username'] ?></td>
            <td><?= $fetchdata['os'] ?></td>
            <td><?= $fetchdata['favorite_game_genre'] ?></td>
            <td><?= $fetchdata['email'] ?></td>
            <td><a href="edit.php?user_id=<?= $fetchdata['id']?>">Edit</a></td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>