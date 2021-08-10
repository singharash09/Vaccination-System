<?php
include_once '../../templates/header.php';
include_once '../../../config/db.php';
?>

<html>
<body>
    <div class="container">
        <div class="row">
            <h2 class="modify-page-title">Insert an Infection</h2>
        </div>
        <div class="row" style="text-align: center;">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3" style="text-align: left;" action="../../../lib/processInfectionInsertion.php" method="POST">
                        <div class="col-sm-12">
                            <label for="infectSSN" class="form-label">SSN</label>
                                <select class="form-select" name="infectSSN" id="infectSSN" aria-label="Select Type" required>
                                <option>Select</option>
                                  <?php
                                  $query1 = "SELECT SSN FROM Person;";
                                  $result = mysqli_query($conn, $query1);
                                  $resultCheck = mysqli_num_rows($result);
                                  if($resultCheck>0){
                                      while($row = mysqli_fetch_assoc($result)){
                                          echo '<option value="'.$row['SSN'].'">'.$row['SSN'].'</option>';
                                        }
                                    }
                                  ?>
                                </select> 
                        </div>
                          <div class="col-sm-3">
                              <label id="infectDate"  for="infectDate" class="form-label">Infection Date</label>
                              <input type="date" class="form-control" id="infectDate" name="infectDate">                              
                          </div>
                        <div class="col-sm-3">
                            <label for="infectType" class="form-label">SSN</label>
                                <select class="form-select" name="infectType" id="infectType" aria-label="Select Type" required>
                                <option>Select</option>
                                  <?php
                                  $query1 = "SELECT type_of_infection FROM Infection_Type;";
                                  $result = mysqli_query($conn, $query1);
                                  $resultCheck = mysqli_num_rows($result);
                                  if($resultCheck>0){
                                      while($row = mysqli_fetch_assoc($result)){
                                          echo '<option value="'.$row['type_of_infection'].'">'.$row['type_of_infection'].'</option>';
                                        }
                                    }
                                  ?>
                                </select> 
                        </div>
                        <div>
                            <button class="btn btn-success" type="submit">Add Infection</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>
</html>