<?php
// add this at the start of the script
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
session_start();


if(!empty($_GET['mealid'])){
    // Include config file
        require_once "config.php"; 

 $meal_id = $_GET['mealid'];

// Attempt Delete query execution
    $sql = "DELETE from patient_meals WHERE id='" .$meal_id. "'";
    $result = mysqli_query($mysqli, $sql);
    if($result){
        
        header("Location:".$_SERVER[HTTP_REFERER]."");
        echo "<script language='javascript' type='text/javascript'>
                alert('You Forgot to Select Day!');
          </script>";
        
    }
    

}


   


?>