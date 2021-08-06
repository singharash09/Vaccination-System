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
                    if(isset($_GET['personEditSSN'])){
                        $personToEdit = $_GET['personEditSSN'];
                        echo $personToEdit;
                    }
                    ?>
                </h2>
            </div> 
            
            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../lib/processPersonEdit.php" method="POST">
                       
                       <?php
                       $query = "SELECT*FROM Person, Postal_Code WHERE Person.postal_code = Postal_Code.postal_code AND Person.SSN ='$personToEdit';";
                       $result = mysqli_query($conn, $query);
                       $resultCheck = mysqli_num_rows($result);                     
                       if($resultCheck>0){
                           while($row = mysqli_fetch_assoc($result)){
                               $editPersonMedicare = $row['medicare'];
                               $editPersonFname = $row['first_name'];
                               $editPersonLname = $row['last_name'];
                               $editPersonDOB = $row['date_of_birth'];
                               $editPersonEmail = $row['email_address'];
                               $editPersonPhone = $row['telephone_number'];
                               $editPersonCitizenship = $row['citizenship'];
                               $editPersonAddress = $row['address'];
                               $editPersonCity = $row['city'];
                               $editPersonProvince = $row['province_code'];
                               $editPersonPostalCode = $row['postal_code'];

                           }
                       }
                       ?>
                         <div class="col-sm-6">
                              <input type="hidden" value="<?php echo $personToEdit ?>" class="form-control" id="personSSN" name="personSSN" minlength="9" maxlength="9" placeholder="123456789 " required>
                          </div>

                          <div class="col-sm-12">
                              <label for="personMedicare" class="form-label">Medicare</label>
                              <input type="text" value="<?php echo  $editPersonMedicare?>" class="form-control" id="personMedicare" name="personMedicare" minlength="9" maxlength="9">
                          </div>

                          <div class="col-sm-3">
                              <label for="personFname" class="form-label">First Name</label>
                              <input type="text" value="<?php echo  $editPersonFname?>" class="form-control" name="personFname" id="personFname"  placeholder="Roger" required>                        
                          </div>
                          <div class="col-sm-3">
                              <label for="personLname" class="form-label">Last Name</label>
                              <input type="text" value="<?php echo  $editPersonLname?>" class="form-control" id="personLname" name="personLname" placeholder="MacDonald" required>                              
                          </div>
                          <div class="col-sm-6">
                              <label for="personDOB" class="form-label">Date Of Birth</label>
                              <input type="date" value="<?php echo  $editPersonDOB?>" class="form-control" id="personDOB" name="personDOB" required>                           
                          </div>
                          <div class="col-sm-3">
                              <label for="personEmail" class="form-label">Email</label>
                              <input type="email" value="<?php echo  $editPersonEmail?>" class="form-control" id="personEmail" name="personEmail" placeholder="roger.macdonald@gmail.com" maxlength="30" required>
                          </div>
                          <div class="col-sm-3">
                              <label for="personPhoneNumber" class="form-label">Phone</label>
                              <input type="text" value="<?php echo  $editPersonPhone?>" class="form-control" id="personPhoneNumber" name="personPhoneNumber" placeholder="5141234567" maxlength="30" required>
                          </div> 
                          <div class="col-sm-6">                              
                              <label for="personCitizenship" class="form-label">Citizenship</label>
                              <input type="text" value="<?php echo  $editPersonCitizenship?>" class="form-control" id="personCitizenship" name="personCitizenship" placeholder="Canada" maxlength="30" required>
                          </div>
                          <div class="col-sm-6">
                              <label for="personAddress" class="form-label">Address</label>
                              <input type="text" value="<?php echo  $editPersonAddress?>" class="form-control" id="personAddress"  name="personAddress" placeholder="e.g: 123 Super Street" maxlength="255" required>
                          </div> 
                          <div class="col-sm-2">
                              <label for="personCity" class="form-label">City</label>
                              <input type="text" value="<?php echo  $editPersonCity?>" class="form-control" id="personCity"  name="personCity" placeholder="Montreal" maxlength="30" required>
                          </div>
                          <div class="col-sm-2">
                              <label for="personPostalCode" class="form-label">Postal Code</label>
                              <input type="text" value="<?php echo  $editPersonPostalCode?>" class="form-control" id="personPostalCode"  name="personPostalCode" placeholder="M4S2T1" minlength="6" maxlength="6" required>                            
                          </div>                          
                          <div class="col-sm-2">
                              <label for="personProvince" class="form-label">Province</label>
                              <input type="text" value="<?php echo  $editPersonProvince?>" class="form-control" id="personProvince"  name="personProvince" placeholder="QC" maxlength="2" required>
                          </div>   
                          <div>
                             <button class="btn btn-secondary" type="submit">Update</button>
                          </div>
                          </div>                                            
                       </form>
    </body>
</html>