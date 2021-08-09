<?php
include_once '../templates/header.php';
include_once '../../config/db.php';

if(isset($_GET['insertion'])){

  if($_GET['insertion'] == 'failed'){
      $message = '';
      if(isset($_GET['type'])){
          if($_GET['type'] == 'Amount'){
              $message = "Insufficient Amount of Vaccines in the Sending Facility";
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
                <h2 class="modify-page-title">Perform a Transfer</h2>
            </div>
            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../lib/processTransfersInsertion.php" method="POST">
                          <div class="col-sm-6">
                              <label for="transfersFacilityOUT" class="form-label">Sending Facility Name</label>
                              <select class="form-select" name="transfersFacilityOUT" id="transfersFacilityOUT" aria-label="Select Facility">
                                <option>Select</option>
                                  <?php
                                  $query1 = "SELECT DISTINCT Vaccination_Facility.facility_name FROM Vaccination_Facility,Inventory WHERE Vaccination_Facility.facility_name = Inventory.facility_name ;";
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
                          <div class="col-sm-6">
                              <label for="transfersFacilityIN" class="form-label">Receiving Facility Name</label>
                              <select class="form-select" name="transfersFacilityIN" id="transfersFacilityIN" aria-label="Select Facility">
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
                            <div class="col-sm-4">  
                            <label for="transfersVaccineType" class="form-label">Vaccine type</label>
                              <select class="form-select" name="transfersVaccineType" id="transfersVaccineType" aria-label="Select Type">
                                <option>Select</option>
                                  <?php
                                  $query2 = "SELECT type_name FROM Vaccine_Type WHERE status='SAFE';";                                 
                                  $result = mysqli_query($conn, $query2);
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
                              <label for="transfersNumberOfVaccines" class="form-label">Quantity</label>
                              <input type="number" class="form-control" id="transfersNumberOfVaccines"  name="transfersNumberOfVaccines" placeholder="250" min="0" oninput="validity.valid||(value='');" required>
                          </div>  
                           <div class="col-sm-4">
                              <label for="transfersDateOfTransfer" class="form-label">Date of Transfer</label>
                              <input type="date" class="form-control" id="transfersDateOfTransfer" name="transfersDateOfTransfer"  min="<?php echo date('Y-m-d'); ?>" required>                           
                          </div>                         

                         <div class="col-sm-6"> 
                             <button class="btn btn-primary" type="submit">Transfer</button>
                         </div>
                          </div>
                          </div>                                            
                       </form>
                    
                    </div>
               </div>
            </div>           
        </div>
      </body>
</html>