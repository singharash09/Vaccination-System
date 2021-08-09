<?php
include_once '../../templates/header.php';
include_once '../../../config/db.php';


if(isset($_GET['insertion'])){

    if($_GET['insertion'] == 'failed'){
        $message = 'Person is to young to be vaccinated in this province on this date!';
        echo "<script type='text/javascript'>
            $(window).on('load',function(){ 
            $('#Modal').modal('show');
            });
             </script>";

            
        echo'<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="Modal" aria-hidden="true">
             <div class="modal-dialog">
               <div class="modal-content">
                 <div class="modal-header">
                   <h5 class="modal-title" id="modalLabel">Unable to insert</h5>
                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                 </div>
                 <div class="modal-body">'.$message.'
                 </div>
                 <div class="modal-footer">
                   <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>      
                 </div>
               </div>
             </div>
           </div>';
        unset($_GET['insertion']);
    }
}
?>

<html>
    <head>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <h2 class="modify-page-title">Perform a Vaccination</h2>
            </div>
            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../../lib/processVaccinationInsertion.php" method="POST">
                          <div class="col-sm-6">
                              <label for="personSSN" class="form-label">SSN or Passport ID</label>
                                <select class="form-select" name="personSSN" id="personSSN" aria-label="Select Type" required>
                                <option>Select</option>
                                  <?php
                                  $query1 = "SELECT SSN FROM Person;";
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
                              <label for="employeeSSN" class="form-label">Employee SSN</label>
                                <select class="form-select" name="employeeSSN" id="employeeSSN" aria-label="Select Type" required>
                                <option>Select</option>
                                  <?php
                                  $query1 = "SELECT SSN FROM HealthCare_Worker;";
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
                          <div class="col-sm-3">
                              <label for="facilityName" class="form-label">Facility Name</label>
                              <select class="form-select" name="facilityName" id="facilityName" aria-label="Select Type" required>
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
                              <label for="typeName" class="form-label">Type Name</label>
                              <select class="form-select" name="typeName" id="typeName" aria-label="Select Type" required>
                                <option>Select</option>
                                  <?php
                                  $query1 = "SELECT type_name FROM Vaccine_Type;";
                                  $result = mysqli_query($conn, $query1);
                                  $resultCheck = mysqli_num_rows($result);
                                  if($resultCheck>0){
                                      while($row = mysqli_fetch_assoc($result)){
                                          echo '<option value="'.$row['type_name'].'">'.$row['type_name'].'</option>';
                                        }
                                    }
                                  ?>
                                </select>                           
                          </div>
                          <div class="col-sm-4">
                              <label for="vaccinationDate" class="form-label">Vaccination</label>
                              <input type="date" class="form-control" id="vaccinationDate" name="vaccinationDate" required>                           
                          </div>                         
                          <div class="col-sm-2">
                              <label for="doseNumber" class="form-label">Dose Number</label>
                              <input type="number" class="form-control" id="doseNumber" name="doseNumber" min="1" required>                           
                          </div>
                          <div class="col-sm-2">                         
                             <button class="btn btn-success" type="submit">Perform Vaccination</button>
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