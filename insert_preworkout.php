<?php
// Include config file
require_once "config.php";
session_start();

$day = $mysqli->real_escape_string($_REQUEST['day']);
$foods_id = $mysqli->real_escape_string($_REQUEST['foods_id']);
$servings_id = $mysqli->real_escape_string($_REQUEST['servings_id']);
$amount = $mysqli->real_escape_string($_REQUEST['amount']);
$user_id= ($_SESSION["id"]);


if($day == ''){
    
    echo "<script language='javascript' type='text/javascript'> 
                window.location = 'preworkout.php';
                alert('You Forgot to Select Day!');
          </script>";
}
else{
//Insert Query
$sql = "INSERT INTO patient_meals ". "(day, meal,foods_id, servings_id, amount,user_id
               ) ". "VALUES('$day', 'Preworkout','$foods_id','$servings_id','$amount', '$user_id')";

               if($mysqli->query($sql) === true){
                    echo "<script language='javascript' type='text/javascript'> 
                                window.location = 'preworkout.php';
                                alert('Meal Successfully Added!');
                         </script>";
            } else{
                echo "Something went wrong. Please try again.";
            }
            $mysqli->close();

    }

?>