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
                <h2 class="modify-page-title">You are now editing: 
                    <?php
                    if(isset($_GET['facilityEditName'])){
                        $facilityToEdit = $_GET['facilityEditName'];
                        echo $facilityToEdit;
                    }
                    ?>
                </h2>
            </div> 
            
            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../lib/processFacilityEdit.php" method="POST">
                       
                       <?php
                       $query = "SELECT*FROM Vaccination_Facility, Postal_Code WHERE Vaccination_Facility.postal_code = Postal_Code.postal_code AND Vaccination_Facility.facility_name ='$facilityToEdit';";
                       $result = mysqli_query($conn, $query);
                       $resultCheck = mysqli_num_rows($result);                     
                       if($resultCheck>0){
                           while($row = mysqli_fetch_assoc($result)){
                               $editFacilityType = $row['facility_type'];
                               $editFacilityWebAdress = $row['web_address'];
                               $editFacilityPhoneNumber = $row['phone_number'];
                               $editFacilityAddress = $row['address'];
                               $editFacilityCity = $row['city'];
                               $editFacilityProvince = $row['province'];
                               $editFacilityPostalCode = $row['postal_code'];                            
                           }
                       }
                       ?>
                         <div class="col-sm-6">                           
                              <input type="hidden" value="<?php echo $facilityToEdit ?>" class="form-control" id="facilityName" name="facilityName"  placeholder="Olympic stadium" required>
                          </div>

                          <div class="col-sm-12">
                              <label for="facilityType" class="form-label">Facility Type</label>
                              <input type="text" value="<?php echo  $editFacilityType?>" class="form-control" id="facilityType" name="facilityType" placeholder="ABCD12345"  required>
                          </div>

                          <div class="col-sm-6">
                              <label for="facilityWebAdress" class="form-label">Web Address</label>
                              <input type="text" value="<?php echo  $editFacilityWebAdress?>" class="form-control" name="facilityWebAdress" id="facilityWebAdress"  >                        
                          </div>
                          <div class="col-sm-6">
                              <label for="facilityPhoneNumber" class="form-label">Phone Number</label>
                              <input type="text" value="<?php echo  $editFacilityPhoneNumber?>" class="form-control" id="facilityPhoneNumber" name="facilityPhoneNumber" placeholder="5141234567" maxlength="30" required>                              
                          </div>
                          
                          <div class="col-sm-6">
                              <label for="facilityAddress" class="form-label">Address</label>
                              <input type="text" value="<?php echo  $editFacilityAddress?>" class="form-control" id="facilityAddress"  name="facilityAddress" placeholder="e.g: 123 Super Street" maxlength="255" required>
                          </div> 
                          
                          <div class="col-sm-2">
                              <label for="facilityCity" class="form-label">City</label>
                              <input type="text" value="<?php echo  $editFacilityCity?>" class="form-control" id="facilityCity"  name="facilityCity" placeholder="Montreal" maxlength="30" required>
                          </div>
                          <div class="col-sm-2">
                              <label for="facilityPostalCode" class="form-label">Postal Code</label>
                              <input type="text" value="<?php echo  $editFacilityPostalCode?>" class="form-control" id="facilityPostalCode"  name="facilityPostalCode" placeholder="M4S2T1" minlength="6" maxlength="6" required>                            
                          </div>                          
                          <div class="col-sm-2">
                              <label for="facilityProvince" class="form-label">Province</label>
                              <input type="text" value="<?php echo  $editFacilityProvince?>" class="form-control" id="facilityProvince"  name="facilityProvince" placeholder="QC" maxlength="2" required>
                          </div> 
                          <div>
                             <button class="btn btn-secondary" type="submit">Update</button>
                          </div>
                          </div>                                            
                       </form>
    </body>
</html>