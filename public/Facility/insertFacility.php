<?php
include_once '../templates/header.php';
include_once '../../config/db.php';

if(isset($_GET['insertion'])){

    if($_GET['insertion'] == 'failed'){
        $message = '';
        if(isset($_GET['type'])){
            if($_GET['type'] == 'name'){
                $message = "Duplicate Facility Name!";
            }else if($_GET['type'] == 'Unexpected'){
                $message = "Unexpected Error Occured!";
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
                          <div class="col-sm-6">
                              <label for="facilityWebAdress" class="form-label">Web address</label>
                              <input type="text" class="form-control" name="facilityWebAdress" id="facilityWebAdress"   >                        
                          </div>
                          <div class="col-sm-6">
                              <label for="facilityPhoneNumber" class="form-label">Phone Number</label>
                              <input type="text" class="form-control" id="facilityPhoneNumber" name="facilityPhoneNumber" placeholder="5141234567" maxlength="30" required>
                          </div> 
                          <div class="col-sm-6">
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
                              <select class="form-select" name="facilityProvince" id="facilityProvince" aria-label="Select Type" required>
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