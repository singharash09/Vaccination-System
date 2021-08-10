<?php
include_once '../../templates/header.php';
include_once '../../../config/db.php';
?>

<html>

<body>
    <div class="container">
        <div class="row">
            <h2 class="modify-page-title">You are now editing vaccine:
                <?php
                if (isset($_GET['vaccineEditType'])) {
                    $vaccineToEdit = $_GET['vaccineEditType'];
                    echo $vaccineToEdit;
                }
                ?>
            </h2>
        </div>

        <div class="row" style="text-align: center;">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3" style="text-align: left;" action="../../../lib/processVaccineEdit.php" method="POST">
                        <?php
                        $query = "SELECT*FROM Vaccine_Type WHERE Vaccine_Type.type_name ='$vaccineToEdit';";
                        $result = mysqli_query($conn, $query);
                        $resultCheck = mysqli_num_rows($result);
                        if ($resultCheck > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $editStatus = $row['status'];
                                $editApproval = $row['date_of_approval'];
                                $editSuspension = $row['date_of_suspension'];
                            }
                        }
                        ?>
                        <div class="col-sm-6">
                            <input type="hidden" value="<?php echo $vaccineToEdit ?>" class="form-control" id="type_name" name="type_name" placeholder="Pfizer" required>
                        </div>
                        <div class="col-sm-12">
                            <label for="status" class="form-label">Vaccine Status</label>

                            <select class="form-select" id="status" name="status" aria-label="Select Type" onchange='toggleSuspensionDate()' required>
                                <?php
                                    if($editStatus == 'SAFE'){
                                        echo "<option value='SAFE' selected>Safe</option>";
                                        echo "<option value='SUSPENDED'>Suspended</option>";
                                    }
                                    if($editStatus == 'SUSPENDED'){
                                        echo "<option value='SAFE'>Safe</option>";
                                        echo "<option value='SUSPENDED' selected>Suspended</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="date_of_approval" class="form-label">Approval Date</label>
                            <input type="date" value="<?php echo $editApproval?>" class=" form-control" id="date_of_approval" name="date_of_approval" required>
                        </div>
                        <div class="col-sm-6">

                            <label id="date_of_suspension_label" for="date_of_suspension" class="form-label">Suspended Date</label>
                            <input type="date" value="<?php echo $editSuspension?>" class="form-control" id="date_of_suspension" name="date_of_suspension">
                        </div>
                        <div>
                            <button class="btn btn-secondary" type="submit">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


    <script>
    
    $( document ).ready(function() {
        toggleSuspensionDate();
        });



        function toggleSuspensionDate() {
            let currentStatus = document.getElementById('status').value;
            if(currentStatus === 'SAFE'){
                document.getElementById('date_of_suspension').style.display = 'none';
                document.getElementById('date_of_suspension_label').style.display = 'none';
                document.getElementById('date_of_suspension').value ='';               
                document.getElementById('date_of_suspension').required = false;  

            }else{
                document.getElementById('date_of_suspension').style.display = 'block';
                document.getElementById('date_of_suspension_label').style.display = 'block'; 
                document.getElementById('date_of_suspension').required = true;              
            }
                    console.log(document.getElementById('date_of_suspension').value);
        }

    </script>

</body>

</html>