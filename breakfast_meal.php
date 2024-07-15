<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
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
    
          <!-- Bootstrap CSS -->
          <link rel="stylesheet" href="bootstrap/css/bootstrap.css">

           <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css" integrity="sha384-xeJqLiuOvjUBq3iGOjvSQSIlwrpqjSHXpduPd6rQpuiM3f5/ijby8pCsnbu5S81n" crossorigin="anonymous">
      
        <!-- SweetAlert CSS -->
        <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>

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
     <!-- Navigation Section -->
     <?php 
        include 'navbarmain.php';
    ?>

<?php
    include 'database.php';
    $result = mysqli_query($conn,"SELECT * FROM foods");
?>

<div class="container" id="container">
          <div class="row justify-content center">
                <div class="col-12 col-sm-12 col-md-12">
                    <div class="card" id="breakfast" class="divs" style="position:relative;top:20px;border-radius:5px; cursor:pointer;">
                        <div class="card-header" style="font-size: 20px;font-weight:900;text-align:center; font-family:'Patrick Hand', cursive;color:purple;">Breakfast : <br>    
                    </div>
                    <div class="card-body">
                      <div class="container-fluid">
                          <form id="breakfastform" name="mealone" class="text-center p-3" style="font-family: monospace;font-size:12px;font-weight:500;color:darkblue;" action="insert_breakfast.php" method="post">


                          <!--Day Changing Code -->
                          <div class="form-group">

                                <input type="checkbox" name="one" id="dayone" value="dayone" onclick="checkOnly(this);add_day();">
                                <label>DayOne</label>
                                     
                                <input type="checkbox" name="two" id="daytwo" value="daytwo" onclick="checkOnly(this);add_day();">
                                <label>DayTwo</label>
                                    &nbsp;
                                <input type="checkbox" name="three" id="daythree" value="daythree" onclick="checkOnly(this);add_day();">
                                <label>DayThree</label>
                                    &nbsp;
                                <input type="checkbox"  name="four" id="dayfour" value="dayfour" onclick="checkOnly(this);add_day();">
                                <label>DayFour</label>
                                    &nbsp;
                                <input type="checkbox"  name="five" id="dayfive" value="dayfive" onclick="checkOnly(this);add_day();">
                                <label>DayFive</label>
                                    &nbsp;
                                <input type="checkbox"  name="six" id="daysix" value="daysix" onclick="checkOnly(this);add_day();">
                                <label>DaySix</label>
                                    &nbsp;
                                <input type="checkbox"  name="seven" id="dayseven" value="dayseven" onclick="checkOnly(this);add_day();">
                                <label>DaySeven</label>

                          </div>

                          <h6>Day Chosen: </h6>
                          <div class="form-group">
                            <input class="form-control" style="cursor:pointer;text-align:center;width:100px;margin-left:auto;margin-right:auto;color:purple;" type="text" name="day" id="day" required readonly>
                          </div>

                          <script language="javascript">
                                function checkOnly(stayChecked)
                                  {
                                  with(document.mealone)
                                    {
                                    for(i = 0; i < elements.length; i++)
                                      {
                                      if(elements[i].checked == true && elements[i].name != stayChecked.name)
                                        {
                                        elements[i].checked = false;
                                        }
                                      }
                                    }
                                  } 

                                  function add_day(){
                                      var checkBox1 = document.getElementById("dayone");
                                      var checkBox2 = document.getElementById("daytwo");
                                      var checkBox3 = document.getElementById("daythree");
                                      var checkBox4 = document.getElementById("dayfour");
                                      var checkBox5 = document.getElementById("dayfive");
                                      var checkBox6 = document.getElementById("daysix");
                                      var checkBox7 = document.getElementById("dayseven");

                                      // If the checkbox is checked, display the output text
                                        if (checkBox1.checked == true){
                                          //
                                          document.getElementById('day').value = 'Day One';

                                        } else  if (checkBox2.checked == true) {
                                          //
                                          document.getElementById('day').value = 'Day Two';
                                        }
                                        else  if (checkBox3.checked == true) {
                                          //
                                          document.getElementById('day').value = 'Day Three';
                                        } else  if (checkBox4.checked == true) {
                                          //
                                          document.getElementById('day').value = 'Day Four';
                                        }
                                        else  if (checkBox5.checked == true) {
                                          //
                                          document.getElementById('day').value = 'Day Five';
                                        } else  if (checkBox6.checked == true) {
                                          //
                                          document.getElementById('day').value = 'Day Six';
                                        }
                                        else  if (checkBox7.checked == true) {
                                          //
                                          document.getElementById('day').value = 'Day Seven';
                                        }

                                    }       
                          </script>

                          <!--Day Changing Code -->

                          
                                  <div class="row">
                                      <!-- Breakfast -->
                                      <div class="col">
                                          <!-- Food Choice -->
                                          <label> Add Breakfast Meal ? </label><br>
                                              <input type="radio" onclick="yesnoCheck();" name="yesno" id="yesCheck">
                                              <label>Yes</label>
                                              <input type="radio" onclick="yesnoCheck();" name="yesno" id="noCheck" checked>
                                              <label>No</label>
                                      </div>
                                  </div>
                                <div id="ifYes" style="display:none">
                                          <div class="form-group">
                                          <label>Select Food taken</label>
                                            <select name="foods_id" id="category_item" class="form-control input-lg" data-live-search="true" title="Select Category" required>
                                            <option type="optgroup" value="">Select Food Item..</option>
                                                <?php while($row = mysqli_fetch_array($result)):; ?>
                                                <option type="optgroup" value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                                <?php endwhile;?> 
                                            </select>
                                          </div>
                                          <div class="form-group">
                                          <label>Select Serving Type</label>
                                            <select name="servings_id" id="sub_category_item" class="form-control input-lg" data-live-search="true" title="Select Sub Category" required>
                                            </select>
                                          </div>
                                        <div class="form-group">
                                                  <label for="amount">No of Serving Item(s):</label>
                                                  <input type="number" min="0"  class="form-control mb-4"style="font-family: monospace;font-size:12px;font-weight:500;color:darkblue;" name="amount" id="amount"  placeholder="Enter Amount e.g 0.5" required >
                                        </div>
                                        <div class="form-group">
                                              <input type="submit"  class="btn btn-primary" id="breko" style="font-size:12px;width:150px;margin-right:auto;" value="Add to Breakfast">
                                        </div>
                                        
                                </div> 
                                        <div class="card-footer">
                                              <a class="btn btn-info" style="font-size:12px;width:150px;" href="mid-morning.php">Next Meal</a>
                                        </div>
                              </div>
                          </form>

                      </div>
                    </div>
                  </div>
                </div>
              </div>



<?php

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$db = new mysqli("localhost", "root", "", "nutrimass");
 
// Check connection
if($db === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

    $user_id = ($_SESSION["id"]);

    $select_breakfast= mysqli_query($db, "SELECT patient_meals.day, patient_meals.meal, patient_meals.servings_id, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, patient_meals.id as mealid,
    users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    WHERE user_id=$user_id AND meal='Breakfast'");
?>

              <!-- Display Meal Entries -->

              <div class="row justify-content center">
                <div class="col-12 col-sm-12 col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <h5 style="text-align:center;color:blue;">Breakfast Meals</h5>
                    </div>
                    <div class="card-body">


                    <?php if (mysqli_num_rows($select_breakfast) > 0 ){ ?>

                        <table class="table table-bordered" style="color:purple;font-size:12px;">

                          <tr style="color:blue;font-size:15px;font-weight:bold;">
                            <td> Day </td>
                            <td> Amount of Food Serving </td>
                            <td> Delete </td>
                          </tr>

                        <?php
                            $i=0;
                            while ($row = mysqli_fetch_array($select_breakfast)){ 
                                
                        ?>
                            <tr>
                                <input type="hidden" <?php echo $row['mealid'] ?>>
                                <td style="width:20%;"><?php echo $row['day'] ; ?></td>
                                <td style="width:50%;"><b><?php echo $row['amount'] ; ?></b> <?php echo $row['serving'] ; ?> <?php echo $row['food']; ?></td>
                                
                                <td style="width:30%;">
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

                    </div>
                  </div>
                </div>
                
              <!-- Display Meal Entries -->
            

            </div>



<?php

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$db = new mysqli("localhost", "root", "", "nutrimass");
 
// Check connection
if($db === false){
    die("ERROR: Could not connect. " . $mysqli->connect_error);
}

    $user_id = ($_SESSION["id"]);

    $select_breakfast_totals= mysqli_query($db, "SELECT patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
    sum(round(servings.energy*patient_meals.amount,2)) as totalenergy,
    sum(round(servings.water*patient_meals.amount, 2)) as totalwater,
    sum(round(servings.protein*patient_meals.amount, 2)) as totalprotein,
    sum(round(servings.fat*patient_meals.amount, 2)) as totalfat,
    sum(round(servings.cho*patient_meals.amount, 2)) as totalcho,
    sum(round(servings.fiber*patient_meals.amount, 2)) as totalfiber,
    sum(round(servings.ca*patient_meals.amount, 2)) as totalca,
    sum(round(servings.fe*patient_meals.amount, 2)) as totalfe,
    sum(round(servings.mg*patient_meals.amount, 2)) as totalmg,
    sum(round(servings.p*patient_meals.amount, 2)) as totalp,
    sum(round(servings.k*patient_meals.amount, 2)) as totalk,
    sum(round(servings.na*patient_meals.amount, 2)) as totalna,
    sum(round(servings.zn*patient_meals.amount, 2)) as totalzn,
    sum(round(servings.se*patient_meals.amount, 2)) as totalse,
    sum(round(servings.Vit_A_RAE*patient_meals.amount, 2)) as totalVit_A_RAE,
    sum(round(servings.Vit_A_RE*patient_meals.amount, 2)) as totalVit_A_RE,
    sum(round(servings.retinol*patient_meals.amount, 2)) as totalretinol,
    sum(round(servings.b_carotene_equivalent*patient_meals.amount, 2)) as totalb_carotene_equivalent,
    sum(round(servings.thiamin*patient_meals.amount, 2)) as totalthiamin,
    sum(round(servings.riboflavin*patient_meals.amount, 2)) as totalriboflavin,
    sum(round(servings.niacin*patient_meals.amount, 2)) as totalniacin,
    sum(round(servings.dietary_folate_eq*patient_meals.amount, 2)) as totaldietary_folate_eq,
    sum(round(servings.food_folate*patient_meals.amount, 2)) as totalfood_folate,
    sum(round(servings.vit_B_12*patient_meals.amount, 2)) as totalvit_B_12,
    sum(round(servings.vit_c*patient_meals.amount, 2)) as totalvit_c,
    sum(round(servings.cholesterol*patient_meals.amount, 2)) as totalcholesterol,
    sum(round(servings.Oxalic_acid_OXALAC*patient_meals.amount, 2)) as totalOxalic_acid_OXALAC,
    sum(round(servings.phytate*patient_meals.amount, 2)) as totalphytate,
     users.id, users.name
    FROM patient_meals  
    INNER JOIN foods ON foods.id=patient_meals.foods_id  
    INNER JOIN servings ON servings.id=patient_meals.servings_id
    INNER JOIN users ON users.id = patient_meals.user_id
    
    WHERE user_id=$user_id AND meal='Breakfast'");
?>


            <!-- Display Nutrients -->

            <div class="row justify-content center">
                <div class="col-12 col-sm-12 col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <h5 style="text-align:center;color:blue;">Nutrient Composition</h5>
                    </div>
                    <div class="card-body">
                        <?php if (mysqli_num_rows($select_breakfast_totals) > 0 ){ ?>

                            <table class="table table-bordered" style="color:purple;font-size:12px;">

                            <tr style="color:blue;font-size:15px;font-weight:bold;">
                                <td> Energy (Kcals) </td>
                                <td> Water (mls) </td>
                                <td> Protein (mg) </td>
                                <td> Fat (mg) </td>
                                <td> Fiber  (mg) </td>
                            </tr>

                            <?php
                                $i=0;
                                while ($row = mysqli_fetch_array($select_breakfast_totals)){ 
                                    
                            ?>
                                <tr>
                                    
                                    <td><?php echo $row['totalenergy'] ; ?></td>
                                    <td><b><?php echo $row['totalwater'] ; ?></td>
                                    <td><?php echo $row['totalprotein']; ?></td>
                                    <td><?php echo $row['totalfat'] ; ?> </td>
                                    <td><?php echo $row['totalfiber'] ; ?> </td>
                                    
                                    
                                </tr>

                            <?php $i++;
                                    }
                            ?>
                            </table>

                            <?php 
                                    }
                                
                                else 
                                    {
                                        echo "<small style='color:red;'>No Nutrients to Display.</small>";
                                    } 

                            ?>
                    </div>
                  </div>
                </div>
                
              <!-- Display Nutrients -->

<script src="foods.js" defer></script>

<script>

  
$(document).ready(function(){

  $('#category_item').selectpicker();

  $('#sub_category_item').selectpicker();

  load_data('category_data');

  function load_data(type, category_id = '')
  {
    $.ajax({
      url:"load_data.php",
      method:"POST",
      data:{type:type, category_id:category_id},
      dataType:"json",
      success:function(data)
      {
        var html = '';
        for(var count = 0; count < data.length; count++)
        {
          html += '<option value="'+data[count].id+'">'+data[count].name+'</option>';
        }
        if(type == 'category_data')
        {
          $('#category_item').html(html);
          $('#category_item').selectpicker('refresh');
        }
        else
        {
          $('#sub_category_item').html(html);
          $('#sub_category_item').selectpicker('refresh');
        }
      }
    })
  }

  $(document).on('change', '#category_item', function(){
    var category_id = $('#category_item').val();
    load_data('sub_category_data', category_id);
  });
  
});

// Choice Of Foods 
$(document).ready(function() {
    $("#breko").click(function() {
        var bfood = document.getElementById("category_item").value;
        var bitem = document.getElementById("sub_category_item").value;
        var bserving = document.getElementById("amount").value;

        var bfood = document.mealone.bfood.value;
        if (bfood === "" || bitem === "" || bserving === "") {
            Swal.fire({
                size: '200px',
                position: 'top-center',
                icon: 'error',
                text: 'Please fill in all Fields correctly.',
                showConfirmButton: true,
                timer: 2500
            })
            return false;
        }

    });

});

</script>


</body>
</html>




