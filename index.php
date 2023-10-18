<?php
    $name = 'oTAG0';
    $age = 18;
    $cgpa = 4.78;
    $male = true;
    $courses = ["swe301", "swe311", "swe309"];
    var_dump($age);
    /*
    foreach ($courses as $course) {
        $favoriteCourse = $course = "swe307" ? $course :null;
    }
    */
    $favoriteCourse = array_filter($courses, "sta343")? "sta343": null;
    $myCourse = "mth309";
/*
    class Users{
        function user(){
            $this->name = "Todun";
        }
    }
*/
   // echo $name;
   function sum($x, $y){
    return $x + $y;
   }
   $addition = sum(10, 8);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SWE 305</title>
</head>
<body>
    <h1 style="
    color: red; background-color: black; padding: 20px"> Welcome! <?= $name ?>. You are <?= $addition ?></h1>
    <p> You offer the following courses </p>
    <ul>
        <?php foreach ($courses as $course){ ?>
        <li><?= $course ?></li>
        <?php if($course == 'swe309'){ ?>
          Your favorite course is <?=  $favoriteCourse = "swe309"; ?>
        <?php } ?>
        <?php } ?>
    </ul>
</body>
</html>

