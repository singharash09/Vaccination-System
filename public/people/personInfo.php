<?php
include_once '../templates/header.php';
include_once '../../config/db.php';
?>


<html>
    <head>

    </head>

    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-2">
                    <a href="people.php" type="button" class="btn btn-secondary button-style"><i class="fas fa-long-arrow-alt-left"></i></a>
            </div>

            <div class="row" style="margin-top: 20px;">
                <h1 style="display:inline;">SSN:
                    <?php
                    if(isset($_GET['personInfoSSN'])){
                        $personInfoSSN = $_GET['personInfoSSN'];
                        echo $personInfoSSN;
                    }
                    ?>
                </h1>
            <?php
                       $query = "SELECT*FROM Person, Postal_Code WHERE Person.postal_code = Postal_Code.postal_code AND Person.SSN ='$personInfoSSN';";
                       $result = mysqli_query($conn, $query);
                       $resultCheck = mysqli_num_rows($result);                     
                       if($resultCheck>0){
                           while($row = mysqli_fetch_assoc($result)){
                               $InfoPersonMedicare = $row['medicare'];
                               $InfoPersonFname = $row['first_name'];
                               $InfoPersonLname = $row['last_name'];
                               $InfoPersonDOB = $row['date_of_birth'];
                               $InfoPersonEmail = $row['email_address'];
                               $InfoPersonPhone = $row['telephone_number'];
                               $InfoPersonCitizenship = $row['citizenship'];
                               $InfoPersonAddress = $row['address'];
                               $InfoPersonCity = $row['city'];
                               $InfoPersonProvince = $row['province_code'];
                               $InfoPersonPostalCode = $row['postal_code'];
                           }
                       }                      
            ?>


               <div>
                <h1 style="display:inline;">Medicare:</h1> <h4 style="display:inline; padding-left:20px"><?php echo $InfoPersonMedicare?></h4>
               </div>
            </div>

            <div class="row" style="margin-top: 50px;">
               <div class="col-sm-3">
                <h3 style="display:inline;">First Name:</h3> <p style="display:inline; padding-left:20px"><?php echo $InfoPersonFname?></p>
               </div>
                <div class="col-sm-3">
                <h3 style="display:inline;">Last Name:</h3> <p style="display:inline; padding-left:20px"><?php echo $InfoPersonLname?></p>
               </div>
            </div>
            <div class="row" style="margin-top: 50px;">           
               <div class="col-sm-4">
                <h3 style="display:inline;">Date Of Birth:</h3> <p style="display:inline; padding-left:20px"><?php echo $InfoPersonDOB?></p>
               </div>
            </div> 
            <div class="row" style="margin-top: 50px;">
               <div class="col-sm-4">
                <h3 style="display:inline;">Email:</h3> <p style="display:inline; padding-left:20px"><?php echo $InfoPersonEmail?></p>
               </div>
            </div>  
            <div class="row" style="margin-top: 50px;">           
               <div class="col-sm-4">
                <h3 style="display:inline;">Phone:</h3> <p style="display:inline; padding-left:20px"><?php echo $InfoPersonPhone?></p>
               </div>
            </div>
            <div class="row" style="margin-top: 50px;">
                <h3 style="display:inline;">Address</h3>        
            </div>          
            <div class="row">           
               <div class="col-sm-3">
                <h4 style="display:inline;">Street:</h4> <p style="display:inline; padding-left:20px"><?php echo $InfoPersonAddress?></p>
               </div>
               <div class="col-sm-3">
                <h4 style="display:inline;">City:</h4> <p style="display:inline; padding-left:20px"><?php echo $InfoPersonCity?></p>
               </div>
               <div class="col-sm-3">
                <h4 style="display:inline;">Province:</h4> <p style="display:inline; padding-left:20px"><?php echo $InfoPersonProvince?></p>
               </div>
               <div class="col-sm-3">
                <h4 style="display:inline;">Postal Code:</h4> <p style="display:inline; padding-left:20px"><?php echo $InfoPersonPostalCode?></p>
               </div>                           
            </div>
            <div class="row" style="margin-top: 50px;">
                <h3 style="display:inline;">Infection History</h3>        
            </div> 

            <div class="row">

             <div class="col-sm-4">
                <?php                        
                
                $queryInfection = "SELECT*FROM Infection WHERE SSN='$personInfoSSN';";
                       $result2 = mysqli_query($conn, $queryInfection);
                       $resultCheck2 = mysqli_num_rows($result2);;                   
                       if($resultCheck2>0){
                           while($row = mysqli_fetch_assoc($result2)){
                               $dateOfInfection = $row['date_of_infection'];
                               $typeOfInfection = $row['type_of_infection']; 
                               echo '<ul class="list-group" style="margin-bottom:20px">
                               <li class="list-group-item">
                               <h6>'.$dateOfInfection.'</h6>    <span class="badge bg-primary rounded-pill">'.$typeOfInfection.'</span></li>
                               </ul>';                       
                           }
                       }
                       
                ?>
            </div>
        </div>
    </body>
</html>