<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <style>
        .error {
            color: #FF0000;
        }
    </style>
</head>
<body>
    <?php
    //define variable and set to empty
    $nameErr = $emailErr = $genderErr = $$webseiteErr = "";
    $name = $email = $gender = $commment = $webseite = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(empty($_POST["name"])){
            $nameErr = "Pleas enter a Valid name";
        }
        else{
            $name = text_input($_POST["name"]);
            if(preg_match("/^[A-Za-z\-']+( [A-Za-z\-']+)*$/", $name)) {
                $nameErr = 'Only letters and white spaces allowd';
            }
        }
    }


    if(empty($_POST["email"])){
        $emailErr = "Please enter a valid email";
    }
    else {
        $email = $_POST["email"]; // Verwenden Sie den richtigen Schlüssel "email" statt "name"
        if(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $email)) {
            $emailErr = "Invalid email format"; // Korrigieren Sie die Fehlermeldung
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "The email address is incorrect"; // Korrigieren Sie die Fehlermeldung und das Semikolon
        }
    }

    if(empty($_POST["website"])){
        $webseite = "";
    }
    else {
        $webseite = text_input($_POST["webseite"]);
        if(!preg_match("^(https?|ftp):\/\/[^\s\/$.?#].[^\s]*$
        ".$webseite)){
            $webseiteErr = "Enter Valid Webseite URL";
        }
    }

    if(empty($_POST["commit"])){
       $commment = ""; 
    } 
    else{
        $commment = text_input($_POST["commit"]);

    }

    if (empty($_POST["gender"])){
        $genderErr = "please enter selcetion gender";
    }
    else{
        $gender = text_input($_POST["gender"]);
    }


    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    ?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* Required field</span></p>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    Full Name: <input type="text" name="name">
    <span class="error">* <?php echo $nameErr;?></span>
    <br><br>
    E-mail: <input type="text" name="email">
    <span class="error">* <?php echo $emailErr;?></span>
    <br><br>
    Website: <input type="text" name="website">
    <span class="error"><?php echo $websiteErr;?></span>
    <br><br>
    Comment: <textarea name="comment" rows="5" cols="40"></textarea>
    <br><br>
    Gender:
    <input type="radio" name="gender" value="female">Female
    <input type="radio" name="gender" value="male">Male
    <span class="error">* <?php echo $genderErr;?></span>
    <br><br>
    <input type="submit" name="submit" value="Submit">
</form>
    <?php 
        echo "<h2> Your name Input </h2>";
        echo $name;
        echo "<br>";
        echo $email;
        echo "<br>";
        echo $webseite;
        echo "<br>";
        echo $comment;
        echo "<br>";
        echo $gender;
    ?>
</body>
</html>