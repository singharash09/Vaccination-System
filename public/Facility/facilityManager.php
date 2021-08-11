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
                <div class="col-sm-12" style="text-align: right;">
                    <a href="addManager.php" type="button" class="btn btn-success button-style"><i class="fas fa-plus"></i> Add Manager</a>
            </div>

            <div class="row" style="margin-top: 20px;">
                <h1 style="display:inline;">Manager SSN:
                    <?php
                    if(isset($_GET['managerSSN'])){
                        $managerSSN = $_GET['managerSSN'];
                        echo $managerSSN;
                    }
                    ?>
                </h1>
            <?php
                       $query = "SELECT * FROM Manages WHERE SSN ='$managerSSN';";
                       $query2 = "SELECT first_name, last_name FROM Person WHERE SSN='$managerSSN';";
                       $result = mysqli_query($conn, $query);
                       $result2 = mysqli_query($conn, $query2);


                       $resultCheck = mysqli_num_rows($result); 
                       $resultCheck2 = mysqli_num_rows($result2);                     
                       if($resultCheck>0){
                           while($row = mysqli_fetch_assoc($result)){
                            $managerFacility = $row['facility_name'];
                              $managerStart = $row['start_date'];
                              $managerEnd = $row['end_date'];
                       }
                    }
                    
                    
                    if($resultCheck2>0){
                           while($row = mysqli_fetch_assoc($result2)){
                            $first_name = $row['first_name'];
                              $last_name = $row['last_name'];
                       }                     
                    }

            ?>


                <div style="">
                <h1 style="display:inline;">First Name:</h1> <h4 style="display:inline; padding-left:20px"><?php echo  $first_name?></h4>
               </div>

                <div>
                <h1 style="display:inline;">Last Name:</h1> <h4 style="display:inline; padding-left:20px"><?php echo  $last_name?></h4>
               </div>

               <div style="margin-top:50px">
                <h4 style="display:inline;">Facility:</h4> <h6 style="display:inline; padding-left:20px"><?php echo $managerFacility?></h6>
                </div>

                <div >
                <h4 style="display:inline;">Start Date:</h4> <h6 style="display:inline; padding-left:20px"><?php echo $managerStart?></h6>
               </div>
 
                <div>
                <h4 style="display:inline; margin-bottom:50px">End Date:</h4> <h6 style="display:inline; padding-left:20px"><?php echo $managerEnd?></h6>
               </div>
               
            </div