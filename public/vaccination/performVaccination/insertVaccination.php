<?php
include_once '../../templates/header.php';
include_once '../../../config/db.php';
?>

<html>
    <head>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <h2 class="modify-page-title">Insert a Vaccination</h2>
            </div>
            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../../lib/processVaccinationInsertion.php" method="POST">
                          <div class="col-sm-6">
                              <label for="personSSN" class="form-label">SSN or Passport ID</label>
                              <input type="text" class="form-control" id="personSSN" name="personSSN" minlength="9" maxlength="9" placeholder="123456789 " required>
                          </div>
                          <div class="col-sm-6">
                              <label for="employeeSSN" class="form-label">Employee SSN</label>
                              <input type="text" class="form-control" id="employeeSSN" name="employeeSSN" minlength="9" maxlength="9" placeholder="123456789 " required>
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
                          <div class="col-sm-6">
                              <label for="doseNumber" class="form-label">Dose Number</label>
                              <input type="number" class="form-control" id="doseNumber" name="doseNumber" min="0" required>                           
                          </div>
                          <div class="col-sm-6">
                              <label for="vaccinationDate" class="form-label">Vaccination</label>
                              <input type="date" class="form-control" id="vaccinationDate" name="vaccinationDate" required>                           
                          </div>
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