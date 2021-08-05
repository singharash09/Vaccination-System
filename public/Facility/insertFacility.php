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
                              <label for="facilityName" class="form-label">Facility Name</label>
                              <input type="text" class="form-control" id="facilityName" name="facilityName"  placeholder="Olympic stadium" required>
                          </div>
                          <div class="col-sm-6">
                              <label for="facilityType" class="form-label">Facility Type</label>
                              <input type="text" class="form-control" id="facilityType" name="facilityType"  placeholder="ABCD12345"     required>
                          </div>
                          <div class="col-sm-3">
                              <label for="facilityWebAdress" class="form-label">Web address</label>
                              <input type="text" class="form-control" name="facilityWebAdress" id="facilityWebAdress"   >                        
                          </div>
                          <div class="col-sm-3">
                              <label for="facilityPhoneNumber" class="form-label">Phone Number</label>
                              <input type="text" class="form-control" id="facilityPhoneNumber" name="facilityPhoneNumber" placeholder="5141234567" maxlength="30" required>
                          </div> 
                          <div class="col-sm-10">
                              <label for="facilityAddress" class="form-label">Address</label>
                              <input type="text" class="form-control" id="facilityAddress"  name="facilityAddress" placeholder="e.g: 123 Super Street" maxlength="255" required>
                          </div>                           
                          <div class="col-sm-2">
                              <label for="facilityCity" class="form-label">City</label>
                              <input type="text" class="form-control" id="facilityCity"  name="facilityCity" placeholder="Montreal" maxlength="30" required>
                          </div>
                          <div class="col-sm-2">
                              <label for="facilityPostalCode" class="form-label">Postal Code</label>
                              <input type="text" class="form-control" id="facilityPostalCode"  name="facilityPostalCode" placeholder="M4S2T1" minlength="6" maxlength="6" required>                            
                          </div>                          
                          <div class="col-sm-2">
                              <label for="facilityProvince" class="form-label">Province</label>
                              <input type="text" class="form-control" id="facilityProvince"  name="facilityProvince" placeholder="QC" maxlength="2" required>
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