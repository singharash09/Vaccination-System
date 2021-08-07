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
                <h2 class="modify-page-title">Insert an Employee</h2>
            </div>
            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../lib/processEmployeeInsertion.php" method="POST">
                          

                          <div class="col-sm-2">
                            <label for="employeeSSN" class="form-label">SSN</label>
                              <select class="form-select" name="employeeSSN" id="employeeSSN" aria-label="Select Type" required>
                                <option>Select</option>
                                <?php
                                 $query1 = "SELECT Person.SSN FROM Person WHERE Person.SSN NOT IN(SELECT HealthCare_Worker.SSN from HealthCare_Worker);";
                               
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
                              <label for="employeeEID" class="form-label">EID</label>
                              <input type="text" class="form-control" id="employeeEID" name="employeeEID" minlength="9" maxlength="9" placeholder="ABCD12345">
                          </div>
                         

                          <div class="col-sm-2">
                            <label for="employeeFacility" class="form-label">Facility Name</label>
                              <select class="form-select" name="employeeFacility" id="employeeFacility" aria-label="Select Type" required>
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


                          <div class="col-sm-3">
                              <label for="employeeStartDate" class="form-label">Start Date</label>
                              <input type="date" class="form-control" id="employeeStartDate" name="employeeStartDate" required>                              
                          </div>
                          <div class="col-sm-6">
                              <label for="employeeEndDate" class="form-label">End Date</label>
                              <input type="date" class="form-control" id="employeeEndDate" name="employeeEndDate" >                           
                          </div>
                          
                          <div class="col-sm-12">
                           <button class="btn btn-success" type="submit">Add person</button>
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
</html>