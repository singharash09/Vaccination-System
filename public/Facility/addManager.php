<?php
include_once '../templates/header.php';
include_once '../../config/db.php';
?>

<html>
    <head>

    </head>
    <body>
    <body>
        <div class="container">
            <div class="row">
                <h2 class="modify-page-title">Add Manager</h2>
            </div>
            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../lib/processManager.php" method="POST">
                          

                          <div class="col-sm-6">
                            <label for="managerSSN" class="form-label">SSN</label>
                              <select class="form-select" name="managerSSN" id="managerSSN" aria-label="Select Type" required>
                                <option>Select</option>
                                <?php
                                 $query1 = "SELECT HealthCare_Worker.SSN FROM HealthCare_Worker WHERE  HealthCare_Worker.SSN NOT IN(SELECT SSN FROM Manages);";
                               
                                  $result = mysqli_query($conn, $query1);

                                  $resultCheck = mysqli_num_rows($result);
                                  if($resultCheck>0){
                                      while($row = mysqli_fetch_assoc($result)){
                                          echo '<option value="'.$row['SSN'].'">'.$row['SSN'].'</option>';
                                        }
                                    }
                                  ?>

                                </select> 
                          </div>

                          <div class="col-sm-6">
                            <label for="managerFacility" class="form-label">Facility Name</label>
                              <select class="form-select" name="managerFacilityy" id="managerFacility" aria-label="Select Type" required>
                                <option>Select</option>
                                  <?php
                                  $query1 = "SELECT facility_name FROM Vaccination_Facility;";
                                  $result = mysqli_query($conn, $query1);

                                  $resultCheck = mysqli_num_rows($result);
                                  if($resultCheck>0){
                                      while($row = mysqli_fetch_assoc($result)){
                                          echo '<option value="'.$row['facility_name'].'">'.$row['facility_name'].'</option>';
                                        }
                                    }
                                  ?>
                                </select> 
                          </div>


                          <div class="col-sm-6">
                              <label for="managerStartDate" class="form-label">Start Date</label>
                              <input type="date" class="form-control" id="managerStartDate" name="managerStartDate" required>                              
                          </div>
                          <div class="col-sm-6">
                              <label for="managerStartDate" class="form-label">End Date</label>
                              <input type="date" class="form-control" id="managerStartDate" name="managerStartDate" >                           
                          </div>
                          
                          <div class="col-sm-12">
                           <button class="btn btn-success" type="submit">Add Manager</button>
                          </div>                                                     
                          </div>
                          </div>                                            
                       </form>
                    
                    </div>
               </div>
            </div>
        </div>



        <script>
            

        </script>
    </body>