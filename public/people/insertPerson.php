<?php
include_once '../templates/header.php';
include_once '../../config/db.php';

if(isset($_GET['insertion'])){

    if($_GET['insertion'] == 'failed'){
        $message = '';
        if(isset($_GET['type'])){
            if($_GET['type'] == 'SSN'){
                $message = "Duplicate SSN!";
            }else if($_GET['type'] == 'EID'){
                $message = "Duplicate Employee ID!";
            }else if($_GET['type'] == 'Unexpected'){
                $message = "Unexpected error";
            }
        }

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
        unset($_GET['type']);
    }
}
?>
<html>
    <head>
        <script type="text/javascript" src="../js/script.js"> </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h2 class="modify-page-title">Insert a Person</h2>
            </div>
            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../lib/processPersonInsertion.php" method="POST">
                          <div class="col-sm-6">
                              <label for="personSSN" class="form-label">SSN or Passport ID</label>
                              <input type="text" class="form-control" id="personSSN" name="personSSN" minlength="9" maxlength="9" placeholder="123456789 " required>
                          </div>
                          <div class="col-sm-6">
                              <label for="personMedicare" class="form-label">Medicare</label>
                              <input type="text" class="form-control" id="personMedicare" name="personMedicare" minlength="9" maxlength="9" placeholder="ABCD12345">
                          </div>
                          <div class="col-sm-3">
                              <label for="personFname" class="form-label">First Name</label>
                              <input type="text" class="form-control" name="personFname" id="personFname"  placeholder="Roger" required>                        
                          </div>
                          <div class="col-sm-3">
                              <label for="personLname" class="form-label">Last Name</label>
                              <input type="text" class="form-control" id="personLname" name="personLname" placeholder="MacDonald" required>                              
                          </div>
                          <div class="col-sm-6">
                              <label for="personDOB" class="form-label">Date Of Birth</label>
                              <input type="date" class="form-control" id="personDOB" name="personDOB" required>                           
                          </div>
                          <div class="col-sm-3">
                              <label for="personEmail" class="form-label">Email</label>
                              <input type="email" class="form-control" id="personEmail" name="personEmail" placeholder="roger.macdonald@gmail.com" maxlength="30" required>
                          </div>
                          <div class="col-sm-3">
                              <label for="personPhoneNumber" class="form-label">Phone</label>
                              <input type="text" class="form-control" id="personPhoneNumber" name="personPhoneNumber" placeholder="5141234567" maxlength="30" required>
                          </div> 
                          <div class="col-sm-6">                              
                              <label for="personCitizenship" class="form-label">Citizenship</label>
                              <input type="text" class="form-control" id="personCitizenship" name="personCitizenship" placeholder="Canada" maxlength="30" required>
                          </div>
                          <div class="col-sm-6">
                              <label for="personAddress" class="form-label">Address</label>
                              <input type="text" class="form-control" id="personAddress"  name="personAddress" placeholder="e.g: 123 Super Street" maxlength="255" required>
                          </div> 
                          <div class="col-sm-2">
                              <label for="personCity" class="form-label">City</label>
                              <input type="text" class="form-control" id="personCity"  name="personCity" placeholder="Montreal" maxlength="30" required>
                          </div>
                          <div class="col-sm-2">
                              <label for="personPostalCode" class="form-label">Postal Code</label>
                              <input type="text" class="form-control" id="personPostalCode"  name="personPostalCode" placeholder="M4S2T1" minlength="6" maxlength="6" required>                            
                          </div>                          
                          <div class="col-sm-2">
                            <label for="personProvince" class="form-label">Province</label>
                              <select class="form-select" name="personProvince" id="personProvince" aria-label="Select Type" required>
                                <option>Select</option>
                                  <?php
                                  $query1 = "SELECT province_code FROM Province;";
                                  $result = mysqli_query($conn, $query1);
                                  $resultCheck = mysqli_num_rows($result);
                                  if($resultCheck>0){
                                      while($row = mysqli_fetch_assoc($result)){
                                          echo '<option value="'.$row['province_code'].'">'.$row['province_code'].'</option>';
                                        }
                                    }
                                  ?>
                                </select> 
                          </div>
                          <div class="col-sm-12">
                                <input type="checkbox" id="isEmployee" name="isEmployee" value="isEmployee">
                                <label for="isEmployee"> Is Employee?</label><br>
                          </div>                         
                           <div class="col-sm-6">
                              <label id="employeeLabel"for="employeeInput" class="form-label">Employee ID</label>
                              <input id="employeeInput" type="text" class="form-control" id="employeeInput"  name="employeeInput" placeholder="123456789" minlength="9" maxlength="9"> 
                          </div>
                          <div class="col-sm-3">
                            <label id="employeeFacilityLabel" for="employeeFacility" class="form-label">Facility Name</label>
                              <select class="form-select" name="employeeFacility" id="employeeFacility" aria-label="Select Type">
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
                              <label id="employeeStartDateLabel"  for="employeeStartDate" class="form-label">Start Date</label>
                              <input type="date" class="form-control" id="employeeStartDate" name="employeeStartDate">                              
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
            document.getElementById("employeeLabel").style.display= 'none';
            document.getElementById("employeeInput").style.display= 'none';

            document.getElementById("employeeFacilityLabel").style.display= 'none';           
            document.getElementById("employeeFacility").style.display= 'none';

            document.getElementById("employeeStartDateLabel").style.display= 'none';            
            document.getElementById("employeeStartDate").style.display= 'none';         

            let element = document.getElementById("isEmployee");
            document.getElementById("isEmployee").onchange = function(){
                let isChecked = this.checked;

                if(isChecked){
                    document.getElementById("employeeLabel").style.display= 'block';
                    document.getElementById("employeeInput").style.display= 'block';
                    document.getElementById("employeeInput").required = true;

                    document.getElementById("employeeFacilityLabel").style.display= 'block';                     
                    document.getElementById("employeeFacility").style.display= 'block';
                    document.getElementById("employeeFacility").required = true;   

                    document.getElementById("employeeStartDateLabel").style.display= 'block';                  
                    document.getElementById("employeeStartDate").style.display= 'block'; 
                    document.getElementById("employeeStartDate").required = true;  

                }else{
                    document.getElementById("employeeLabel").style.display= 'none';
                    document.getElementById("employeeInput").style.display= 'none';
                    document.getElementById("employeeStartDate").required = false;

                    document.getElementById("employeeFacilityLabel").style.display= 'none';           
                    document.getElementById("employeeFacility").style.display= 'none';
                    document.getElementById("employeeStartDate").required = false;

                    document.getElementById("employeeStartDateLabel").style.display= 'none';            
                    document.getElementById("employeeStartDate").style.display= 'none';
                    document.getElementById("employeeStartDate").required = false;                 
                }
            }

        </script>
    </body>
</html>