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
                <h2 class="modify-page-title">You are now editing Vaccination ID: 
                    <?php
                    if(isset($_GET['vaccinationToEdit'])){
                        $vaccinationToEdit = $_GET['vaccinationToEdit'];
                        echo $vaccinationToEdit;
                    }
                    ?>
                </h2>
            </div> 
            
            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../../lib/processVaccinationEdit.php" method="POST">
                       
                       <?php
                       $query = "SELECT*FROM Vaccination WHERE Vaccination.vaccination_id ='$vaccinationToEdit';";
                       $result = mysqli_query($conn, $query);
                       $resultCheck = mysqli_num_rows($result);                     
                       if($resultCheck>0){
                           while($row = mysqli_fetch_assoc($result)){
                            
                                $editSSN = $row['SSN'];
                                $editEmployeeSSN = $row['Employee_SSN'];
                                $editFacilityName = $row['facility_name'];
                                $editTypeName = $row['type_name'];
                                $editDoseNumber = $row['dose_number'];
                                $editVaccinationDate = $row['date_of_vaccination'];
                           }
                       }
                       ?>
                           <div class="col-sm-6">
                              <input type="hidden" value="<?php echo $vaccinationToEdit ?>" class="form-control" id="vaccination_id" name="vaccination_id">
                          </div>

                          <div class="col-sm-12">
                              <label for="personSSN" class="form-label">SSN</label>
                              <input type="text" value="<?php echo  $editSSN?>" class="form-control" id="personSSN" name="personSSN" minlength="9" maxlength="9">
                          </div>

                          <div class="col-sm-12">
                              <label for="employeeSSN" class="form-label">Employee SSN</label>
                              <input type="text" value="<?php echo  $editEmployeeSSN?>" class="form-control" id="employeeSSN" name="employeeSSN" minlength="9" maxlength="9">
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
                                          if($row['facility_name'] == $editFacilityName){
                                              echo '<option value="'.$row['facility_name'].'" selected>'.$row['facility_name'].'</option>';
                                          }else{
                                              echo '<option value="'.$row['facility_name'].'">'.$row['facility_name'].'</option>';
                                          }
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
                                          if($row['type_name'] == $editTypeName){
                                              echo '<option value="'.$row['type_name'].'" selected>'.$row['type_name'].'</option>';
                                          }else{
                                              echo '<option value="'.$row['type_name'].'">'.$row['type_name'].'</option>';
                                          }
                                        }
                                    }
                                  ?>
                                </select>
                          </div>   


                          <div class="col-sm-4">
                              <label for="vaccinationDate" class="form-label">Vaccination Date</label>
                              <input type="date" value="<?php echo  $editVaccinationDate?>" class="form-control" id="vaccinationDate" name="vaccinationDate" required>                           
                          </div>      

                          <div class="col-sm-2">
                              <label for="doseNumber" class="form-label">Dose Number</label>
                              <input type="number" value="<?php echo  $editDoseNumber?>" class="form-control" id="doseNumber" name="doseNumber" min="0" required>
                          </div>                 
                          <div>
                             <button class="btn btn-secondary" type="submit">Update</button>
                          </div>
                          </div>                                            
                       </form>
    </body>
</html>