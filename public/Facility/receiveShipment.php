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
                <h2 class="modify-page-title">Receive Shipment</h2>   
            </div>

             <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../lib/processShipment.php" method="POST">
                          <div class="col-sm-6">
                              <label for="shipmentFacility" class="form-label">Facility Name</label>
                              <select class="form-select" name="shipmentFacility" id="shipmentFacility" aria-label="Select Facility">
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
                            <div class="col-sm-6">  
                            <label for="shipmentType" class="form-label">Shipment Type</label>
                              <select class="form-select" name="shipmentType" id="shipmentType" aria-label="Select Type">
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
                        <div class="col-sm-6">
                              <label for="shipmentQuantity" class="form-label">Quantity</label>
                              <input type="number" class="form-control" id="shipmentQuantity"  name="shipmentQuantity" placeholder="250" required>
                          </div>  
                           <div class="col-sm-6">
                              <label for="shipmentDate" class="form-label">Date</label>
                              <input type="date" class="form-control" id="shipmentDate" name="shipmentDate" required>                           
                          </div>                         

                         <div class="col-sm-6"> 
                             <button class="btn btn-primary" type="submit">Ship</button>
                         </div>
                          </div>
                          </div>                                            
                       </form>
                    
                    </div>
               </div>
            </div>           
        </div>