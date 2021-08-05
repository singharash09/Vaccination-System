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
                <h2 class="modify-page-title">Insert a Facility</h2>
            </div>
            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../lib/processFacilityInsertion.php" method="POST">
                          <div class="col-sm-6">
                              <label for="FacilityName" class="form-label">Facility Name</label>
                              <input type="text" class="form-control" id="FacilityName" name="FacilityName"  placeholder="Olympic stadium" required>
                          </div>
                          <div class="col-sm-6">
                              <label for="FacilityType" class="form-label">Facility Type</label>
                              <input type="text" class="form-control" id="FacilityType" name="FacilityType"  placeholder="ABCD12345"       required>
                          </div>
                          <div class="col-sm-3">
                              <label for="FacilityWebAdress" class="form-label">Web address</label>
                              <input type="text" class="form-control" name="FacilityWebAdress" id="FacilityWebAdress"   >                        
                          </div>
                          <div class="col-sm-3">
                              <label for="FacilityPhoneNumber" class="form-label">Phone Number</label>
                              <input type="text" class="form-control" id="FacilityPhoneNumber" name="FacilityPhoneNumber" placeholder="5141234567" maxlength="30" required>
                          </div> 
                          <div class="col-sm-10">
                              <label for="FacilityAddress" class="form-label">Address</label>
                              <input type="text" class="form-control" id="FacilityAddress"  name="FacilityAddress" placeholder="e.g: 123 Super Street" maxlength="255" required>
                          </div>                           
                         <div class="col-sm-2">
                              <label for="FacilityPostalCode" class="form-label">Postal Code</label>
                              <select class="form-select form-select" id="FacilityPostalCode" name="FacilityPostalCode" aria-label=".form-select-lg example" required>
                                  <option value="">Please Select</option>
                                  <?php 
                                    $query = "SELECT postal_code FROM Postal_Code;";
                                    $result = mysqli_query($conn, $query);
                                    $resultCheck = mysqli_num_rows($result);
                                    
                                    if($resultCheck>0){
                                        while($row = mysqli_fetch_assoc($result)){
                                            echo '<option value="'.$row['postal_code'].'">'.$row['postal_code'].'</option>';
                                        }
                                    }                                    
                                  ?>
                                </select>
                          </div>
                          <div>
                             <button class="btn btn-success" type="submit">Add Facility</button>
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