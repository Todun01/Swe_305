<?php   

if(isset($_POST["calculate"])){
    $yourweight = floatval($_POST['weight']);
    $yourheight = floatval($_POST['height']);

    $yourBmi =number_format(your_bmi($yourweight, $yourheight), 2);
}
function your_bmi($weight, $height){
    $myBmi = $weight / ($height * $height);
    return $myBmi;
}
function bmi_calculator($bmi){
    $underweightBmi = $bmi < 18.5 ;
    $overweightBmi = $bmi > 25.0 && $bmi < 29.9;
    $obeseBmi = $bmi >= 30.0 ;
    $healthyBmi = $bmi > 18.5 && $bmi < 24.9;

    switch ($underweightBmi) {
        case true:
            $calculatedBmi = "Your BMI falls within underweight range. You can do better👍";
        };
    switch ($overweightBmi) {
        case true:
            $calculatedBmi = "Your BMI falls within overweight range. Watch your weight broski👀";
        };
    switch ($obeseBmi) {
        case true:
            $calculatedBmi = "Your BMI falls within obese range. Omo nawa for you o😂😂";
        }   ;               
    switch ($healthyBmi) {
        case true:
            $calculatedBmi = "Your BMI falls within healthy range. You're doing well✅";

        };
    return $calculatedBmi;
}

$bmiStatement = bmi_calculator($yourBmi);

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Welcome!</h1>
    <form action="assignment.php" method="POST">
        <p>
            Weight: <input type="text" name="weight" placeholder="Enter your weight in kg">
        </p>
        <p>
            Height: <input type="text" name="height" placeholder="Enter your height in metres">
        </p>
        <p>
            <button type="submit" name="calculate">Calculate!</button>
        </p>

    </form>
    <p>Your BMI is <?= $yourBmi ?>! <?= $bmiStatement?></p>
</body>
</html>