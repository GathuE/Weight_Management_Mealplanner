<?php 

session_start();

// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    echo "<script language='javascript' type='text/javascript'> 
            window.location = 'index.php';
            alert('Please Log In!');
            </script>"; 
    exit;
}


else{



// add this at the start of the script
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

//Deny all overcoming errors
error_reporting (0);

$id = $_SESSION["id"]; 

// Database Connection 

$conn = mysqli_connect('localhost','root','');
mysqli_select_db($conn,'nutrimass');
// Include the main TCPDF library (search for installation path).
include('tcpdf/tcpdf.php');


         // create new PDF document
         ob_start();
         $pdf = new TCPDF('P','mm','A4');
         $pdf->SetPrintHeader(false);
         $pdf->SetPrintFooter(false);
         $pdf->setPageMark();
         $pdf->AddPage();
         
         $html .='<style>
                        table {
                        font-size: 9px;
                        border-collapse: collapse;
                        width: 100%;
                        }
                        
                        td, th {
                        padding: 2px;
                        border: 0.1px solid #dddddd;
                        }
                        
                        tr:nth-child(even) {
                        background-color: white;
                        }
                </style>
                <table>
                        <tr>
                            <td style="width:35%;border:none;">
                                <img src="images/logo.png" style="height:60px;">
                            </td>
                            <td style="width:30%;border:none;">
                                <p style="font-size:15px;font-weight:bold;text-align:center;color:purple;">Company Name 
                                    <br> <b style="font-size:9px;font-weight:regular;"> </b>
                                </p>
                            </td>
                            <td style="width:35%;border:none;text-align:right;">
                                <p style="text-align:right;color:purple;">
                                    <strong>Contact Us:</strong> 
                                    <br><b style="color:blue;"> Phone :</b><a href="tel:0711530740">Call Developer </a>
                                    <br><b style="color:blue;"> Email : </b><a href="mailto:gathuimmanuel@gmail.com"> Email Developer </a>
                                    <br><b style="color:blue;"> GitHub : </b><a href="www.github.com/GathuE"> Software Projects</a>
                                    <br><b style="color:blue;"> Linkedin : </b><a href="www.linkedin.com/emmanuel_gathu"> Connect with Developer</a>
                                </p>
                            </td>
                        </tr>';
         $html .='</table>';

         $html .='<hr>';

         $html .='<h4 style="text-align:center;color:purple;">Personal Details</h4>';
         
         $html .='<table style="background-color:#dddddd;">
                    <tr>
                        <td>';

         

         $html .='<table cellspacing="0" style=" font-size:9px; fontweight:bold; color:purple; line-height:15px; width:100%;">';

            // Generate User Data from database
            $query = mysqli_query($conn,"SELECT name, age, gender, height, currentweight, weight, work, user_id FROM patients
            INNER JOIN users ON users.id=patients.user_id WHERE user_id ='$id'");
            while($row = mysqli_fetch_assoc($query))
            {
                $html .= '
                <tr>
                    <td style="fontweight:bold;color:blue;text-align:right;">Client Name :</td>
                    <td style="fontweight:bold;color:purple;text-align:left;">'.$row["name"].'</td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:blue;text-align:right;">Gender :</td>
                    <td style="fontweight:bold;color:purple;text-align:left;">'.$row["gender"].'</td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:blue;text-align:right;">Height :</td>
                    <td style="fontweight:bold;color:purple;text-align:left;">'.$row["height"].' <b style="color:blue;">cms</b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:blue;text-align:right;">Current Weight :</td>
                    <td style="fontweight:bold;color:purple;text-align:left;">'.$row["currentweight"].' <b style="color:blue;">kgs</b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:blue;text-align:right;">Target Weight :</td>
                    <td style="fontweight:bold;color:purple;text-align:left;">'.$row["weight"].' <b style="color:blue;">kgs</b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:blue;text-align:right;">Physical Activity Level :</td>
                    <td style="fontweight:bold;color:purple;text-align:left;">'.$row["work"].'</td>
                </tr>
                ';
            }
            // Generate User Data from database

         $html .='</table>';

        
         $html .='</td> 
                        <td>
                            <table cellspacing="0" style="font-size:9px; fontweight:bold; color:purple; line-height:15px; width:100%;">';
         
                                // Generate EER from database
                                $query = mysqli_query($conn,"SELECT eer FROM reference WHERE user_id ='$id'");
                                while($row = mysqli_fetch_assoc($query))
                                {
                

                                $html .='<tr>
                                            <td style="fontweight:bold;color:blue;text-align:right;">Total Energy Expenditure :</td>
                                            <td style="fontweight:bold;color:purple;text-align:left;">'.$row["eer"].' <b style="color:blue;">Kcals</b></td>
                                        </tr>';
                                }

                                // Generate Target Goal from database
                                $query = mysqli_query($conn,"SELECT targetgoal FROM patients WHERE user_id ='$id'");
                                while($row = mysqli_fetch_assoc($query))
                                {
                
                                $html .='<tr>
                                            <td style="fontweight:bold;color:blue;text-align:right;">Target Goal :</td>
                                            <td style="fontweight:bold;color:purple;text-align:left;">'.$row["targetgoal"].'</td>
                                        </tr>
                                        <tr>
                                            <td style="fontweight:bold;color:blue;text-align:right;"> :</td>
                                            <td style="fontweight:bold;color:purple;text-align:left;"></td>
                                        </tr>
                                        <tr>
                                            <td style="fontweight:bold;color:blue;text-align:right;"> :</td>
                                            <td style="fontweight:bold;color:purple;text-align:left;"></td>
                                        </tr>
                                        <tr>
                                            <td style="fontweight:bold;color:blue;text-align:right;"> :</td>
                                            <td style="fontweight:bold;color:purple;text-align:left;"></td>
                                        </tr>
                            </table>';
                }
        $html .='      </td>
                </tr>
        </table> <br>';


        $html .='<hr>';

        $html .='<table cellspacing="0" style=" font-size:9px; fontweight:bold; color:purple; line-height:15px; width:100%;">
<tr>
    <td>
            <h2 style="text-align:center;"><strong>Nutritionist Notes :</strong></h2>
    </td>
</tr>
<tr>
    <td>
    <br>
    <br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        
        <br><br>
        
    </td>
</tr>
<tr>
    <td><br>Prepared on .................................................<br><br>Prepared by .................................................</td>
</tr>
<tr>
    <td><b style="color:blue;">Registered Clinical Nutritionist.</b></td>
</tr>
</table>';

        $html .='<hr>';

        $html .='<br pagebreak="true" />';

        $html .='<h4 style="text-align:center;color:blue;">MEAL PLAN</h4>';

        $html .='<h4 style="text-align:center;color:purple;">Day One</h4>';

        //1.Start Day one

        $html .='<table cellspacing="0" style="line-height:15px; width:100%;background-color:#DDDDDD;">
                    <tr>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Pre Workout</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Breakfast</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Mid Morning Snack</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Lunch</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:15%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Mid Afternoon Snack</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Supper</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>';
        
        // Generate Meal Plan Meals from database

        $html .='<table cellspacing="0" style="line-height:15px; width:100%;color:purple;">
                    <tr>
                        <td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day One' AND meal ='Preworkout' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';


        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day One' AND meal ='Breakfast' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day One' AND meal ='mid-morning' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day One' AND meal ='Lunch' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day One' AND meal ='midafternoon' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day One' AND meal ='supper' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';


        $html .=   '</tr>';
        $html .='</table>';

        //1.End Day one

        $html .='<br>';

        $html .='<hr>';

        

        //2.Start Day Two

        $html .='<h4 style="text-align:center;color:purple;">Day Two</h4>';

        $html .='<table cellspacing="0" style="line-height:15px; width:100%;background-color:#DDDDDD;">
                    <tr>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Breakfast</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Breakfast</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Mid Morning Snack</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Lunch</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:15%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Mid Afternoon Snack</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width: 17px%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Supper</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>';
        
        // Generate Meal Plan Meals from database

        $html .='<table cellspacing="0" style="line-height:15px; width:100%;color:purple;">
                    <tr>
                        <td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Two' AND meal ='Preworkout' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Two' AND meal ='Breakfast' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Two' AND meal ='mid-morning' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Two' AND meal ='Lunch' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Two' AND meal ='midafternoon' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Two' AND meal ='supper' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';


        $html .=   '</tr>';
        $html .='</table>';

        //2.End Day Two


        $html .='<br>';

        $html .='<hr>';

        

        //3.Start Day Three

        $html .='<h4 style="text-align:center;color:purple;">Day Three</h4>';

        $html .='<table cellspacing="0" style="line-height:15px; width:100%;background-color:#DDDDDD;">
                    <tr>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Pre Workout</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Breakfast</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Mid Morning Snack</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Lunch</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:15%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Mid Afternoon Snack</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Supper</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>';
        
        // Generate Meal Plan Meals from database

        $html .='<table cellspacing="0" style="line-height:15px; width:100%;color:purple;">
                    <tr>
                        <td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Three' AND meal ='Preworkout' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Three' AND meal ='Breakfast' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Three' AND meal ='mid-morning' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Three' AND meal ='Lunch' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Three' AND meal ='midafternoon' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Three' AND meal ='supper' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';


        $html .=   '</tr>';
        $html .='</table>';

        //3.End Day Three

        $html .='<br>';

        $html .='<hr>';

        $html .='<br pagebreak="true" />';

        //4.Start Day Four

        $html .='<h4 style="text-align:center;color:purple;">Day Four</h4>';

        $html .='<table cellspacing="0" style="line-height:15px; width:100%;background-color:#DDDDDD;">
                    <tr>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Pre Workout</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Breakfast</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Mid Morning Snack</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Lunch</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:15%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Mid Afternoon Snack</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Supper</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>';
        
        // Generate Meal Plan Meals from database

        $html .='<table cellspacing="0" style="line-height:15px; width:100%;color:purple;">
                    <tr>
                        <td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Four' AND meal ='Preworkout' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Four' AND meal ='Breakfast' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Four' AND meal ='mid-morning' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Four' AND meal ='Lunch' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Four' AND meal ='midafternoon' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Four' AND meal ='supper' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';


        $html .=   '</tr>';
        $html .='</table>';

        //4.End Day Four


        $html .='<br>';

        $html .='<hr>';

        

        //5.Start Day Five

        $html .='<h4 style="text-align:center;color:purple;">Day Five</h4>';

        $html .='<table cellspacing="0" style="line-height:15px; width:100%;background-color:#DDDDDD;">
                    <tr>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Pre Workout</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Breakfast</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Mid Morning Snack</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Lunch</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:15%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Mid Afternoon Snack</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Supper</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>';
        
        // Generate Meal Plan Meals from database

        $html .='<table cellspacing="0" style="line-height:15px; width:100%;color:purple;">
                    <tr>
                        <td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Five' AND meal ='Preworkout' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Five' AND meal ='Breakfast' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Five' AND meal ='mid-morning' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Five' AND meal ='Lunch' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Five' AND meal ='midafternoon' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Five' AND meal ='supper' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';


        $html .=   '</tr>';
        $html .='</table>';

        //5.End Day Five

        $html .='<br>';

        $html .='<hr>';

        //6.Start Day Six

        $html .='<h4 style="text-align:center;color:purple;">Day Six</h4>';

        $html .='<table cellspacing="0" style="line-height:15px; width:100%;background-color:#DDDDDD;">
                    <tr>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Pre Workout</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Breakfast</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Mid Morning Snack</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Lunch</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:15%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Mid Afternoon Snack</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Supper</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>';
        
        // Generate Meal Plan Meals from database

        $html .='<table cellspacing="0" style="line-height:15px; width:100%;color:purple;">
                    <tr>
                        <td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Six' AND meal ='Preworkout' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Six' AND meal ='Breakfast' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Six' AND meal ='mid-morning' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Six' AND meal ='Lunch' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Six' AND meal ='midafternoon' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Six' AND meal ='supper' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';


        $html .=   '</tr>';
        $html .='</table>';

        //6.End Day Six

        $html .='<br>';

        $html .='<hr>';

        //7.Start Day Seven

        $html .='<h4 style="text-align:center;color:purple;">Day Seven</h4>';

        $html .='<table cellspacing="0" style="line-height:15px; width:100%;background-color:#DDDDDD;">
                    <tr>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Pre Workout</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Breakfast</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Mid Morning Snack</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Lunch</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:15%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Mid Afternoon Snack</td>
                                </tr>
                            </table>
                        </td>
                        <td style=width:17%;>
                            <table style="text-align:center;color:blue;">
                                <tr>
                                    <td>Supper</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>';
        
        // Generate Meal Plan Meals from database

        $html .='<table cellspacing="0" style="line-height:15px; width:100%;color:purple;">
                    <tr>
                        <td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Seven' AND meal ='Preworkout' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Seven' AND meal ='Breakfast' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Seven' AND meal ='mid-morning' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';

        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Seven' AND meal ='Lunch' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Seven' AND meal ='midafternoon' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';
        $html .=        '<td>';

                            $html .='<table cellspacing="0" style="line-height:15px; width:100%;font-size:6px;">';

                            $query1 = mysqli_query($conn,"SELECT patient_meals.day, patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                            users.id, users.name
                            FROM patient_meals  
                            INNER JOIN foods ON foods.id=patient_meals.foods_id  
                            INNER JOIN servings ON servings.id=patient_meals.servings_id
                            INNER JOIN users ON users.id = patient_meals.user_id

                            WHERE day ='Day Seven' AND meal ='supper' AND user_id ='$id'");

                            $count = mysqli_num_rows($query1);
                            if ($count > 0){
                                //set counter variable
                            $counter = 1;

                                while($row = mysqli_fetch_assoc($query1))
                                {

                                    $food_amount = $row["amount"];
                                    $serving_amount = $row["serving"];
                                    $food_name = $row["food"];

                                    $html .='<tr>
                                                <td style=width:20%;>
                                                        '.$food_amount. ' '.$serving_amount.' '.$food_name.'<br>
                                                </td>
                                            </tr>';  
                                            
                                    $counter++;
                                }
                            }

                            $html .='</table>';

        $html .=        '</td>';


        $html .=   '</tr>';
        $html .='</table>';

        //7.End Day Seven

        //Start a New Page Here


        $html .='<br pagebreak="true" />';


        $html .='<style>
                        table {
                        font-size: 9px;
                        border-collapse: collapse;
                        width: 100%;
                        }
                        
                        td, th {
                        padding: 2px;
                        border: 0.1px solid #dddddd;
                        }
                        
                        tr:nth-child(even) {
                        background-color: white;
                        }
                </style>
                <table>
                    <tr>
                        <td style="width:35%;border:none;">
                            <img src="images/logo.png" style="height:60px;">
                        </td>
                        <td style="width:30%;border:none;">
                            <p style="font-size:15px;font-weight:bold;text-align:center;color:purple;">Company Name 
                                <br> <b style="font-size:9px;font-weight:regular;"> </b>
                            </p>
                        </td>
                        <td style="width:35%;border:none;text-align:right;">
                            <p style="text-align:right;color:purple;">
                                <strong>Contact Us:</strong> 
                                <br><b style="color:blue;"> Phone :</b> 0711530740 
                                <br><b style="color:blue;"> Email : </b> gathuimmanuel@gmail.com 
                                <br><b style="color:blue;"> Website : </b> www.github.com/GathuE 
                            </p>
                        </td>
                    </tr>';
$html .='</table>';

$html .='<hr>';

$html .='<h4 style="text-align:center;color:purple;">NUTRIENT ANALYSIS</h4>';

$html .='<table cellspacing="0" style="background-color:#b6b3ca; font-size:9px; fontweight:bold; color:purple; line-height:15px; width:100%;">
    <tr>
        <td style="width:35%;">
            <h3 style="fontweight:bold;color:blue;text-align:center;">Nutrient</h3>
        </td>
        <td style="width:32.5%;">
            <h3 style="fontweight:bold;color:blue;text-align:center;">Reference Intake</h3>
        </td>
        <td style="width:32.5%;">
            <h3 style="fontweight:bold;color:blue;text-align:center;">Meal Plan Composition</h3>
        </td>
    </tr>
    <tr>
        <td>
            <table cellspacing="0" style=" font-size:9px; fontweight:bold; color:purple; line-height:15px; width:100%;">
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Energy (Kcals)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Water (mls)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Protein (g)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Fat (g)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Fibre (g)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Carbohydrate (g)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Calcium (mg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Iron (mg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Magnesium (mg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Phosphorous (mg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Potassium (mg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Sodium (mg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Zinc (mg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Sellenium (mcg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Vit-A-RAE (mcg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Vit-A-RE (mcg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Retinol (mcg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">B-carotene (mcg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Thiamin (mg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Riboflavin (mg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Niacin (mg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Dietary Folate (mcg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Food Folate (mcg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Vit-B12 (mcg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Vit-C (mg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Cholestrol (mg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Oxalic Acid (mg)</td>
                    </tr>
                    <tr>
                        <td style="fontweight:bold;color:blue;text-align:center;">Phytate (mg)</td>
                    </tr> 
            </table>
        </td>
        
        <td>';

        

$html .='<table cellspacing="0" style=" font-size:9px; fontweight:bold; color:purple; line-height:15px; width:100%;">';

            // Generate User Data from database
            $query = mysqli_query($conn,"SELECT * From reference WHERE user_id ='$id'");
            while($row = mysqli_fetch_assoc($query))
            {
                $html .= '
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["eer"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["water"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["protein"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["fat"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["fibre"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["carbohydrate"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["calcium"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["iron"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["magnesium"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["phosphorous"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["potassium"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["sodium"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["zinc"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["sellenium"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["vitarae"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["vitare"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["retinol"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["bcarotene"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["thiamin"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["riboflavin"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["niacin"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["dietaryfolate"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["foodfolate"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["vitb12"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["vitc"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["cholestrol"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["oxalicacid"].' <b style="color:blue;"> </b></td>
                </tr>
                <tr>
                    <td style="fontweight:bold;color:purple;text-align:center;">'.$row["phytate"].' <b style="color:blue;"> </b></td>
                </tr>
                ';
            }
            // Generate User Data from database

$html .='</table>';


$html .='</td>';

$html .='<td>';

$html .='<table cellspacing="0" style=" font-size:9px; fontweight:bold; color:purple; line-height:15px; width:100%;">';




                    // Generate User Data from database
                    $query = mysqli_query($conn,"SELECT patient_meals.meal, patient_meals.foods_id, patient_meals.amount, patient_meals.user_id, foods.name as food, servings.name as serving, 
                    sum(round(servings.energy*patient_meals.amount/7,1)) as totalenergy,
                    sum(round(servings.water*patient_meals.amount/7, 1)) as totalwater,
                    sum(round(servings.protein*patient_meals.amount/7, 1)) as totalprotein,
                    sum(round(servings.fat*patient_meals.amount/7, 1)) as totalfat,
                    sum(round(servings.cho*patient_meals.amount/7, 1)) as totalcho,
                    sum(round(servings.fiber*patient_meals.amount/7, 1)) as totalfiber,
                    sum(round(servings.ca*patient_meals.amount/7, 1)) as totalca,
                    sum(round(servings.fe*patient_meals.amount/7, 1)) as totalfe,
                    sum(round(servings.mg*patient_meals.amount/7, 1)) as totalmg,
                    sum(round(servings.p*patient_meals.amount/7, 1)) as totalp,
                    sum(round(servings.k*patient_meals.amount/7, 1)) as totalk,
                    sum(round(servings.na*patient_meals.amount/7, 1)) as totalna,
                    sum(round(servings.zn*patient_meals.amount/7, 1)) as totalzn,
                    sum(round(servings.se*patient_meals.amount/7, 1)) as totalse,
                    sum(round(servings.Vit_A_RAE*patient_meals.amount/7, 1)) as totalVit_A_RAE,
                    sum(round(servings.Vit_A_RE*patient_meals.amount/7, 1)) as totalVit_A_RE,
                    sum(round(servings.retinol*patient_meals.amount/7, 1)) as totalretinol,
                    sum(round(servings.b_carotene_equivalent*patient_meals.amount/7, 1)) as totalb_carotene_equivalent,
                    sum(round(servings.thiamin*patient_meals.amount/7, 1)) as totalthiamin,
                    sum(round(servings.riboflavin*patient_meals.amount/7, 1)) as totalriboflavin,
                    sum(round(servings.niacin*patient_meals.amount/7, 1)) as totalniacin,
                    sum(round(servings.dietary_folate_eq*patient_meals.amount/7, 1)) as totaldietary_folate_eq,
                    sum(round(servings.food_folate*patient_meals.amount/7, 1)) as totalfood_folate,
                    sum(round(servings.vit_B_12*patient_meals.amount/7, 1)) as totalvit_B_12,
                    sum(round(servings.vit_c*patient_meals.amount/7, 1)) as totalvit_c,
                    sum(round(servings.cholesterol*patient_meals.amount/7, 1)) as totalcholesterol,
                    sum(round(servings.Oxalic_acid_OXALAC*patient_meals.amount/7, 1)) as totalOxalic_acid_OXALAC,
                    sum(round(servings.phytate*patient_meals.amount/7, 1)) as totalphytate,
                     users.id, users.name
                    FROM patient_meals  
                    INNER JOIN foods ON foods.id=patient_meals.foods_id  
                    INNER JOIN servings ON servings.id=patient_meals.servings_id
                    INNER JOIN users ON users.id = patient_meals.user_id
                    
                    WHERE user_id ='$id'");
                    while($row = mysqli_fetch_assoc($query))
                    {
                        $html .= '
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalenergy"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalwater"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalprotein"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalfat"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalfiber"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalcho"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalca"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalfe"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalmg"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalp"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalk"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalna"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalzn"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalse"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalVit_A_RAE"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalVit_A_RE"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalretinol"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalb_carotene_equivalent"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalthiamin"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalriboflavin"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalniacin"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totaldietary_folate_eq"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalfood_folate"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalvit_B_12"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalvit_c"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalcholesterol"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalOxalic_acid_OXALAC"].' <b style="color:blue;"> </b></td>
                        </tr>
                        <tr>
                            <td style="fontweight:bold;color:purple;text-align:center;">'.$row["totalphytate"].' <b style="color:blue;"> </b></td>
                        </tr>
                        ';
                    }
                    // Generate User Data from database

$html .='</table>';


$html .='</td>';

$html .='</tr>';


$html .='</table>';


//Start a New Page Here


$html .='<br pagebreak="true" />';


$html .='<table cellspacing="0" style=" font-size:9px; fontweight:bold; color:purple; line-height:15px; width:100%;">
<tr>
    <td>
            <h2 style="text-align:center;"><strong>Nutritionist Notes :</strong></h2>
    </td>
</tr>
<tr>
    <td>
    <br>
    <br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>
        ......................................................................................................................................................................................................................................................................................................................................................................................................................................<br>

        <br><br>
        
    </td>
</tr>
<tr>
    <td><br>Prepared on .................................................<br><br>Prepared by .................................................</td>
</tr>
<tr>
    <td><b style="color:blue;">Registered Clinical Nutritionist.</b></td>
</tr>
</table>';




$pdf->Ln(12);
$pdf->writeHTML($html);
$title = "Meal Plan";
$pdf->SetTitle($title);
ob_end_clean();
$pdf->Output("Meal Plan.pdf"); //rename your file generated here




}

?>
