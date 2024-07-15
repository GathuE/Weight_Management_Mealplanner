<?php

session_start();
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
	exit;	
}
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$db = new mysqli("localhost", "root", "", "nutrimass");
 
// Check connection
if($db === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

$user_id = ($_SESSION["id"]);

 $results = mysqli_query($db, "SELECT patients.age, patients.gender,patients.height, patients.weight, patients.pregnant, 
 patients.lactating,patients.work, users.id as users, users.name
 FROM patients 
 INNER JOIN users
 ON patients.user_id = users.id
 WHERE user_id =$user_id LIMIT 1"); 
 
 ?>

<!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="author" content="weight_manager Wellness">
        <meta name="description" content="Healthy Nutrition and Fitness">
        <meta name="keywords" content="weightmanagement, healthydiets, bodybuilding, fitness, healthymeals, weight_manager, wellness">
    
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nerko+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Patrick+Hand&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
        <!-- SweetAlert CSS -->
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>


        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">
    
        <!-- Jquery and JsPDF -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.3/jspdf.min.js"></script>
        <script src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
        <!--Custom CSS-->
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="sweetalert2.min.css">
    
        <link rel="icon" href="#" type="image/icon type">
        <title>Nutri App</title>
        
    </head>

<body>
<!-- Navigation -->
<?php 
    include 'navbar.php';


?>


<!-- Day One Show Meals -->

<?php 
    $user_id = ($_SESSION["id"]);

    $select_preworkout= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Preworkout' AND day='Day One'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_breakfast= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Breakfast' AND day='Day One'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_midmorningsnack= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='mid-morning' AND day='Day One'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_lunch= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Lunch' AND day='Day One'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_midafternoon= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='midafternoon' AND day='Day One'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_supper= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='supper' AND day='Day One'");
?>
<!-- Day One Show Meals -->

<div class="row" style="margin-left:30px;margin-right:30px;">

                    <table class="table table-responsive" style="font-size:11px;font-weight:bold;color:purple;">

                        <tr>
                            <tr> 
                                <td colspan='5'>
                                    <h5 style="text-align:center;color:orangered;">Day One</h5>
                                </td>
                            </tr>
                            <tr style="text-align:center;color:orange">
                                <td>Pre Workout</td>
                                <td>Breakfast</td>
                                <td>Mid Morning Snack</td>
                                <td>Lunch</td>
                                <td>Mid Afternoon</td>
                                <td>Supper</td>
                            </tr>
                            <td style="width:17%;">

                                <?php if (mysqli_num_rows($select_preworkout) > 0 ){ ?>

                                <table class="table table-bordered" style="color:purple;">

                                <?php
                                    $i=0;
                                    while ($row = mysqli_fetch_array($select_preworkout)){ 
                                        
                                ?>
                                    <tr>
                                        <input type="hidden" <?php echo $row['mealid'] ?>>
                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                        <td><?php echo $row['food']; ?></td>
                                        <td>
                                            <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"></i></a>
                                        </td>
                                    </tr>

                                <?php $i++;
                                        }
                                ?>
                                </table>
                                <?php 
                                        }
                                    
                                    else 
                                        {
                                            echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                        } 
                            
                                ?>

                            </td>
                            <td style="width:17%;">

                                <?php if (mysqli_num_rows($select_breakfast) > 0 ){ ?>

                                <table class="table table-bordered" style="color:purple;">

                                <?php
                                    $i=0;
                                    while ($row = mysqli_fetch_array($select_breakfast)){ 
                                        
                                ?>
                                    <tr>
                                        <input type="hidden" <?php echo $row['mealid'] ?>>
                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                        <td><?php echo $row['food']; ?></td>
                                        <td>
                                            <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"></i></a>
                                        </td>
                                    </tr>

                                <?php $i++;
                                        }
                                ?>
                                </table>
                                <?php 
                                        }
                                    
                                    else 
                                        {
                                            echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                        } 
                            
                                ?>

                            </td>

                            <td style="width:17%;">

                                    <?php if (mysqli_num_rows($select_midmorningsnack) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_midmorningsnack)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:17%;">
                                    <?php if (mysqli_num_rows($select_lunch) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_lunch)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:15%;">
                                    <?php if (mysqli_num_rows($select_midafternoon) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_midafternoon)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:17%;">
                                    <?php if (mysqli_num_rows($select_supper) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_supper)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            
                        </tr>

                    </table>

</div>        


<br>


<!-- Day Two Show Meals -->
<?php 
    $user_id = ($_SESSION["id"]);

    $select_preworkout2= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Preworkout' AND day='Day Two'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_breakfast2= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Breakfast' AND day='Day Two'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_midmorningsnack2= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='mid-morning' AND day='Day Two'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_lunch2= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Lunch' AND day='Day Two'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_midafternoon2= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='midafternoon' AND day='Day Two'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_supper2= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='supper' AND day='Day Two'");
?>
<!-- Day Two Show Meals -->


<div class="row" style="margin-left:30px;margin-right:30px;">

                    <table class="table table-responsive" style="font-size:11px;font-weight:bold;color:purple;">

                        <tr>
                            <tr> 
                                <td colspan='5'>
                                    <h5 style="text-align:center;color:orangered;">Day Two</h5>
                                </td>
                            </tr>
                            <tr style="text-align:center;color:orange">
                                <td>Pre Workout</td>
                                <td>Breakfast</td>
                                <td>Mid Morning Snack</td>
                                <td>Lunch</td>
                                <td>Mid Afternoon</td>
                                <td>Supper</td>
                            </tr>
                            <td style="width:17%;">

                                <?php if (mysqli_num_rows($select_preworkout2) > 0 ){ ?>

                                <table class="table table-bordered" style="color:purple;">

                                <?php
                                    $i=0;
                                    while ($row = mysqli_fetch_array($select_preworkout2)){ 
                                        
                                ?>
                                    <tr>
                                        <input type="hidden" <?php echo $row['mealid'] ?>>
                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                        <td><?php echo $row['food']; ?></td>
                                        <td>
                                            <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"></i></a>
                                        </td>
                                    </tr>

                                <?php $i++;
                                        }
                                ?>
                                </table>
                                <?php 
                                        }
                                    
                                    else 
                                        {
                                            echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                        } 
                            
                                ?>

                            </td>
                            <td style="width:17%;">

                                <?php if (mysqli_num_rows($select_breakfast2) > 0 ){ ?>

                                <table class="table table-bordered" style="color:purple;">

                                <?php
                                    $i=0;
                                    while ($row = mysqli_fetch_array($select_breakfast2)){ 
                                        
                                ?>
                                    <tr>
                                        <input type="hidden" <?php echo $row['mealid'] ?>>
                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                        <td><?php echo $row['food']; ?></td>
                                        <td>
                                            <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"></i></a>
                                        </td>
                                    </tr>

                                <?php $i++;
                                        }
                                ?>
                                </table>
                                <?php 
                                        }
                                    
                                    else 
                                        {
                                            echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                        } 
                            
                                ?>

                            </td>

                            <td style="width:17%;">

                                    <?php if (mysqli_num_rows($select_midmorningsnack2) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_midmorningsnack2)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:17%;">
                                    <?php if (mysqli_num_rows($select_lunch2) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_lunch2)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:15%;">
                                    <?php if (mysqli_num_rows($select_midafternoon2) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_midafternoon2)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:17%;">
                                    <?php if (mysqli_num_rows($select_supper2) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_supper2)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            
                        </tr>

                    </table>

</div> 

<br>


<!-- Day Three Show Meals -->
<?php 
    $user_id = ($_SESSION["id"]);

    $select_preworkout3= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Preworkout' AND day='Day Three'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_breakfast3= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Breakfast' AND day='Day Three'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_midmorningsnack3= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='mid-morning' AND day='Day Three'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_lunch3= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Lunch' AND day='Day Three'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_midafternoon3= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='midafternoon' AND day='Day Three'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_supper3= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='supper' AND day='Day Three'");
?>
<!-- Day Three Show Meals -->

<div class="row" style="margin-left:30px;margin-right:30px;">

                    <table class="table table-responsive" style="font-size:11px;font-weight:bold;color:purple;">

                        <tr>
                            <tr> 
                                <td colspan='5'>
                                    <h5 style="text-align:center;color:orangered;">Day Three</h5>
                                </td>
                            </tr>
                            <tr style="text-align:center;color:orange">
                                <td>Preworkout</td>
                                <td>Breakfast</td>
                                <td>Mid Morning Snack</td>
                                <td>Lunch</td>
                                <td>Mid Afternoon</td>
                                <td>Supper</td>
                            </tr>
                            <td style="width:17%;">

                                <?php if (mysqli_num_rows($select_preworkout3) > 0 ){ ?>

                                <table class="table table-bordered" style="color:purple;">

                                <?php
                                    $i=0;
                                    while ($row = mysqli_fetch_array($select_preworkout3)){ 
                                        
                                ?>
                                    <tr>
                                        <input type="hidden" <?php echo $row['mealid'] ?>>
                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                        <td><?php echo $row['food']; ?></td>
                                        <td>
                                            <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"></i></a>
                                        </td>
                                    </tr>

                                <?php $i++;
                                        }
                                ?>
                                </table>
                                <?php 
                                        }
                                    
                                    else 
                                        {
                                            echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                        } 
                            
                                ?>

                            </td>
                            <td style="width:17%;">

                                <?php if (mysqli_num_rows($select_breakfast3) > 0 ){ ?>

                                <table class="table table-bordered" style="color:purple;">

                                <?php
                                    $i=0;
                                    while ($row = mysqli_fetch_array($select_breakfast3)){ 
                                        
                                ?>
                                    <tr>
                                        <input type="hidden" <?php echo $row['mealid'] ?>>
                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                        <td><?php echo $row['food']; ?></td>
                                        <td>
                                            <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"></i></a>
                                        </td>
                                    </tr>

                                <?php $i++;
                                        }
                                ?>
                                </table>
                                <?php 
                                        }
                                    
                                    else 
                                        {
                                            echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                        } 
                            
                                ?>

                            </td>

                            <td style="width:17%;">

                                    <?php if (mysqli_num_rows($select_midmorningsnack3) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_midmorningsnack3)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:17%;">
                                    <?php if (mysqli_num_rows($select_lunch3) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_lunch3)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:15%;">
                                    <?php if (mysqli_num_rows($select_midafternoon3) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_midafternoon3)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:17%;">
                                    <?php if (mysqli_num_rows($select_supper3) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_supper3)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            
                        </tr>

                    </table>

</div>

<br>

<!-- Day Four Show Meals -->
<?php 
    $user_id = ($_SESSION["id"]);

    $select_preworkout4= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Preworkout' AND day='Day Four'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_breakfast4= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Breakfast' AND day='Day Four'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_midmorningsnack4= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='mid-morning' AND day='Day Four'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_lunch4= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Lunch' AND day='Day Four'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_midafternoon4= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='midafternoon' AND day='Day Four'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_supper4= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='supper' AND day='Day Four'");
?>
<!-- Day Four Show Meals -->

<div class="row" style="margin-left:30px;margin-right:30px;">

                    <table class="table table-responsive" style="font-size:11px;font-weight:bold;color:purple;">

                        <tr>
                            <tr> 
                                <td colspan='5'>
                                    <h5 style="text-align:center;color:orangered;">Day Four</h5>
                                </td>
                            </tr>
                            <tr style="text-align:center;color:orange">
                                <td>Pre Workout</td>
                                <td>Breakfast</td>
                                <td>Mid Morning Snack</td>
                                <td>Lunch</td>
                                <td>Mid Afternoon</td>
                                <td>Supper</td>
                            </tr>
                            <td style="width:17%;">

                                <?php if (mysqli_num_rows($select_preworkout4) > 0 ){ ?>

                                <table class="table table-bordered" style="color:purple;">

                                <?php
                                    $i=0;
                                    while ($row = mysqli_fetch_array($select_preworkout4)){ 
                                        
                                ?>
                                    <tr>
                                        <input type="hidden" <?php echo $row['mealid'] ?>>
                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                        <td><?php echo $row['food']; ?></td>
                                        <td>
                                            <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"></i></a>
                                        </td>
                                    </tr>

                                <?php $i++;
                                        }
                                ?>
                                </table>
                                <?php 
                                        }
                                    
                                    else 
                                        {
                                            echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                        } 
                            
                                ?>

                            </td>
                            <td style="width:17%;">

                                <?php if (mysqli_num_rows($select_breakfast4) > 0 ){ ?>

                                <table class="table table-bordered" style="color:purple;">

                                <?php
                                    $i=0;
                                    while ($row = mysqli_fetch_array($select_breakfast4)){ 
                                        
                                ?>
                                    <tr>
                                        <input type="hidden" <?php echo $row['mealid'] ?>>
                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                        <td><?php echo $row['food']; ?></td>
                                        <td>
                                            <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"></i></a>
                                        </td>
                                    </tr>

                                <?php $i++;
                                        }
                                ?>
                                </table>
                                <?php 
                                        }
                                    
                                    else 
                                        {
                                            echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                        } 
                            
                                ?>

                            </td>

                            <td style="width:17%;">

                                    <?php if (mysqli_num_rows($select_midmorningsnack4) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_midmorningsnack4)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:17%;">
                                    <?php if (mysqli_num_rows($select_lunch4) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_lunch4)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:15%;">
                                    <?php if (mysqli_num_rows($select_midafternoon4) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_midafternoon4)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:17%;">
                                    <?php if (mysqli_num_rows($select_supper4) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_supper4)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            
                        </tr>

                    </table>

</div>        


<br>

<!-- Day Five Show Meals -->
<?php 
    $user_id = ($_SESSION["id"]);

    $select_preworkout5= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Preworkout' AND day='Day Five'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_breakfast5= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Breakfast' AND day='Day Five'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_midmorningsnack5= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='mid-morning' AND day='Day Five'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_lunch5= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Lunch' AND day='Day Five'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_midafternoon5= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='midafternoon' AND day='Day Five'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_supper5= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='supper' AND day='Day Five'");
?>
<!-- Day Five Show Meals -->

<div class="row" style="margin-left:30px;margin-right:30px;">

                    <table class="table table-responsive" style="font-size:11px;font-weight:bold;color:purple;">

                        <tr>
                            <tr> 
                                <td colspan='5'>
                                    <h5 style="text-align:center;color:orangered;">Day Five</h5>
                                </td>
                            </tr>
                            <tr style="text-align:center;color:orange">
                                <td>Pre Workout</td>
                                <td>Breakfast</td>
                                <td>Mid Morning Snack</td>
                                <td>Lunch</td>
                                <td>Mid Afternoon</td>
                                <td>Supper</td>
                            </tr>
                            <td style="width:17%;">

                                <?php if (mysqli_num_rows($select_preworkout5) > 0 ){ ?>

                                <table class="table table-bordered" style="color:purple;">

                                <?php
                                    $i=0;
                                    while ($row = mysqli_fetch_array($select_preworkout5)){ 
                                        
                                ?>
                                    <tr>
                                        <input type="hidden" <?php echo $row['mealid'] ?>>
                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                        <td><?php echo $row['food']; ?></td>
                                        <td>
                                            <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"></i></a>
                                        </td>
                                    </tr>

                                <?php $i++;
                                        }
                                ?>
                                </table>
                                <?php 
                                        }
                                    
                                    else 
                                        {
                                            echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                        } 
                            
                                ?>

                            </td>
                            <td style="width:17%;">

                                <?php if (mysqli_num_rows($select_breakfast5) > 0 ){ ?>

                                <table class="table table-bordered" style="color:purple;">

                                <?php
                                    $i=0;
                                    while ($row = mysqli_fetch_array($select_breakfast5)){ 
                                        
                                ?>
                                    <tr>
                                        <input type="hidden" <?php echo $row['mealid'] ?>>
                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                        <td><?php echo $row['food']; ?></td>
                                        <td>
                                            <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"></i></a>
                                        </td>
                                    </tr>

                                <?php $i++;
                                        }
                                ?>
                                </table>
                                <?php 
                                        }
                                    
                                    else 
                                        {
                                            echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                        } 
                            
                                ?>

                            </td>

                            <td style="width:17%;">

                                    <?php if (mysqli_num_rows($select_midmorningsnack5) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_midmorningsnack5)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:17%;">
                                    <?php if (mysqli_num_rows($select_lunch5) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_lunch5)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:15%;">
                                    <?php if (mysqli_num_rows($select_midafternoon5) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_midafternoon5)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:17%;">
                                    <?php if (mysqli_num_rows($select_supper5) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_supper5)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            
                        </tr>

                    </table>

</div>        


<br>

<!-- Day Six Show Meals -->
<?php 
    $user_id = ($_SESSION["id"]);

    $select_preworkout6= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Preworkout' AND day='Day Six'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_breakfast6= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Breakfast' AND day='Day Six'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_midmorningsnack6= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='mid-morning' AND day='Day Six'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_lunch6= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Lunch' AND day='Day Six'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_midafternoon6= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='midafternoon' AND day='Day Six'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_supper6= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='supper' AND day='Day Six'");
?>
<!-- Day Six Show Meals -->

<div class="row" style="margin-left:30px;margin-right:30px;">

                    <table class="table table-responsive" style="font-size:11px;font-weight:bold;color:purple;">

                        <tr>
                            <tr> 
                                <td colspan='5'>
                                    <h5 style="text-align:center;color:orangered;">Day Six</h5>
                                </td>
                            </tr>
                            <tr style="text-align:center;color:orange">
                                <td>Pre Workout</td>
                                <td>Breakfast</td>
                                <td>Mid Morning Snack</td>
                                <td>Lunch</td>
                                <td>Mid Afternoon</td>
                                <td>Supper</td>
                            </tr>
                            <td style="width:17%;">

                                <?php if (mysqli_num_rows($select_preworkout6) > 0 ){ ?>

                                <table class="table table-bordered" style="color:purple;">

                                <?php
                                    $i=0;
                                    while ($row = mysqli_fetch_array($select_preworkout6)){ 
                                        
                                ?>
                                    <tr>
                                        <input type="hidden" <?php echo $row['mealid'] ?>>
                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                        <td><?php echo $row['food']; ?></td>
                                        <td>
                                            <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"></i></a>
                                        </td>
                                    </tr>

                                <?php $i++;
                                        }
                                ?>
                                </table>
                                <?php 
                                        }
                                    
                                    else 
                                        {
                                            echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                        } 
                            
                                ?>

                            </td>
                            <td style="width:17%;">

                                <?php if (mysqli_num_rows($select_breakfast6) > 0 ){ ?>

                                <table class="table table-bordered" style="color:purple;">

                                <?php
                                    $i=0;
                                    while ($row = mysqli_fetch_array($select_breakfast6)){ 
                                        
                                ?>
                                    <tr>
                                        <input type="hidden" <?php echo $row['mealid'] ?>>
                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                        <td><?php echo $row['food']; ?></td>
                                        <td>
                                            <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"></i></a>
                                        </td>
                                    </tr>

                                <?php $i++;
                                        }
                                ?>
                                </table>
                                <?php 
                                        }
                                    
                                    else 
                                        {
                                            echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                        } 
                            
                                ?>

                            </td>

                            <td style="width:17%;">

                                    <?php if (mysqli_num_rows($select_midmorningsnack6) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_midmorningsnack6)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:17%;">
                                    <?php if (mysqli_num_rows($select_lunch6) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_lunch6)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:15%;">
                                    <?php if (mysqli_num_rows($select_midafternoon6) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_midafternoon6)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:17%;">
                                    <?php if (mysqli_num_rows($select_supper6) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_supper6)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            
                        </tr>

                    </table>

</div>        


<br>

<!-- Day Seven Show Meals -->
<?php 
    $user_id = ($_SESSION["id"]);

    $select_preworkout7= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Preworkout' AND day='Day Seven'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_breakfast7= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Breakfast' AND day='Day Seven'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_midmorningsnack7= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='mid-morning' AND day='Day Seven'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_lunch7= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Lunch' AND day='Day Seven'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_midafternoon7= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='midafternoon' AND day='Day Seven'");
?>
<?php 
    $user_id = ($_SESSION["id"]);

    $select_supper7= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='supper' AND day='Day Seven'");
?>
<!-- Day Seven Show Meals -->

<div class="row" style="margin-left:30px;margin-right:30px;">

                    <table class="table table-responsive" style="font-size:11px;font-weight:bold;color:purple;">

                        <tr>
                            <tr> 
                                <td colspan='5'>
                                    <h5 style="text-align:center;color:orangered;">Day Seven</h5>
                                </td>
                            </tr>
                            <tr style="text-align:center;color:orange">
                                <td>Pre Workout</td>
                                <td>Breakfast</td>
                                <td>Mid Morning Snack</td>
                                <td>Lunch</td>
                                <td>Mid Afternoon</td>
                                <td>Supper</td>
                            </tr>
                            <td style="width:17%;">

                                <?php if (mysqli_num_rows($select_preworkout7) > 0 ){ ?>

                                <table class="table table-bordered" style="color:purple;">

                                <?php
                                    $i=0;
                                    while ($row = mysqli_fetch_array($select_preworkout7)){ 
                                        
                                ?>
                                    <tr>
                                        <input type="hidden" <?php echo $row['mealid'] ?>>
                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                        <td><?php echo $row['food']; ?></td>
                                        <td>
                                            <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"></i></a>
                                        </td>
                                    </tr>

                                <?php $i++;
                                        }
                                ?>
                                </table>
                                <?php 
                                        }
                                    
                                    else 
                                        {
                                            echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                        } 
                            
                                ?>

                            </td>
                            <td style="width:17%;">

                                <?php if (mysqli_num_rows($select_breakfast7) > 0 ){ ?>

                                <table class="table table-bordered" style="color:purple;">

                                <?php
                                    $i=0;
                                    while ($row = mysqli_fetch_array($select_breakfast7)){ 
                                        
                                ?>
                                    <tr>
                                        <input type="hidden" <?php echo $row['mealid'] ?>>
                                        <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                        <td><?php echo $row['food']; ?></td>
                                        <td>
                                            <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"></i></a>
                                        </td>
                                    </tr>

                                <?php $i++;
                                        }
                                ?>
                                </table>
                                <?php 
                                        }
                                    
                                    else 
                                        {
                                            echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                        } 
                            
                                ?>

                            </td>

                            <td style="width:17%;">

                                    <?php if (mysqli_num_rows($select_midmorningsnack7) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_midmorningsnack7)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:17%;">
                                    <?php if (mysqli_num_rows($select_lunch7) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_lunch7)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:15%;">
                                    <?php if (mysqli_num_rows($select_midafternoon7) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_midafternoon7)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            <td style="width:17%;">
                                    <?php if (mysqli_num_rows($select_supper7) > 0 ){ ?>

                                    <table class="table table-bordered" style="color:purple;">

                                    <?php
                                        $i=0;
                                        while ($row = mysqli_fetch_array($select_supper7)){ 
                                            
                                    ?>
                                        <tr>
                                            <input type="hidden" <?php echo $row['mealid'] ?>>
                                            <td><b><?php echo $row['amount'] ; ?></b>  <?php echo $row['serving'] ; ?></td>
                                            <td><?php echo $row['food']; ?></td>
                                            <td>
                                                <a href="delete_meal.php?mealid=<?php echo $row["mealid"]; ?>" style="font-size:12px;color:blue;" onClick="javascript:return confirm ('Are you Sure you want to Delete this Meal?');"> <i class="bi bi-x-square"> </i></a>
                                            </td>
                                        </tr>

                                    <?php $i++;
                                            }
                                    ?>
                                    </table>
                                    <?php 
                                            }
                                        
                                        else 
                                            {
                                                echo "<small style='color:red;'>You Have No Meal Entries Under this Category</small>";
                                            } 

                                    ?>

                            </td>
                            
                        </tr>

                    </table>

</div>        


<br>



<div class="container" id="container">
          <div class="row justify-content center">
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="card" id="#" class="divs" style="position:relative;top:20px;border-radius:5px; cursor:pointer;">
                    <div class="card-body">
                      <div class="container-fluid">
                         <a href="preworkout.php" class="btn btn-warning btn-xs " style="font-size:11px;color:white;"  onClick='javascript:return confirm ("Add Meals?");' role="button">Add Meals</a><BR> <br>
                         <a href="patients_list.php" style="font-family:monospace;font-size:14px;font-weight:bold;text-align:center;" class="btn btn-primary">Proceed</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

</body>
</html>




		


