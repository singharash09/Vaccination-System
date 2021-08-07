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
                <h2 class="modify-page-title">You are now editing SSN: 
                    <?php
                    if(isset($_GET['employeeEditSSN'])){
                        $employeeEditSSN = $_GET['employeeEditSSN'];
                        echo $employeeEditSSN;
                    }
                    ?>
                </h2>
            </div> 

            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../lib/processEmployeeEdit.php" method="POST">
                       
                       <?php
                       $query = "SELECT * FROM HealthCare_Worker, Works_At WHERE HealthCare_Worker.SSN = Works_At.SSN AND HealthCare_Worker.SSN =$employeeEditSSN ;";
                       $result = mysqli_query($conn, $query);
                       $resultCheck = mysqli_num_rows($result);                     
                       if($resultCheck>0){
                           while($row = mysqli_fetch_assoc($result)){
                               $editEmployeeSSN = $row['SSN'];
                               $editEmployeeEID = $row['EID'];
                               $editEmployeeFacility = $row['facility_name'];
                               $editEmployeeStartDate = $row['start_date'];
                               $editEmployeeEndDate = $row['end_date'];
                           }
                       }
                       ?>
                         <div class="col-sm-6">
                              <input type="hidden" value="<?php echo $employeeEditSSN ?>" class="form-control" id="employeeSSN" name="employeeSSN" minlength="9" maxlength="9" placeholder="123456789 " required>
                          </div>

                          <div class="col-sm-12">
                              <label for="employeeEID" class="form-label">EID</label>
                              <input type="text" value="<?php echo  $editEmployeeEID?>" class="form-control" id="employeeEID" name="employeeEID" minlength="9" maxlength="9" placeholder="ABCD56789 " required>
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
                              <input type="date" value="<?php echo  $editEmployeeStartDate?>" class="form-control" id="employeeStartDate" name="employeeStartDate" required>                              
                          </div>
                          <div class="col-sm-6">
                              <label for="employeeEndDate" class="form-label">End Date</label>
                              <input type="date" value="<?php echo  $editEmployeeEndDate?>" class="form-control" id="employeeEndDate" name="employeeEndDate" >                           
                          </div>
                                                    
                            
                          <div>
                             <button class="btn btn-secondary" type="submit">Update</button>
                          </div>
                          </div>                                            
                       </form>
    </body>
</html>