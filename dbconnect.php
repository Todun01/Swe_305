<?php
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "swe305_c1";

$connection =mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);
$connectionStatus = $connection
?"Database Connection Successful"
:"Database Connection Failed";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        div{
            margin: 50px auto;
            padding: 30px;
            height: 300px;
            border-radius: 50px;
        }
        .success{
            background-color: green;
            color: white;
        }
        
        .failure{
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
    <?php if ($connection) { ?>
        <div class="success">
            <?= $connectionStatus ?>
        </div>
    <?php } else { ?>
        <div class= "failure">
            <?= $connectionStatus ?>
        </div>
    <?php } ?>
</body>
</html>