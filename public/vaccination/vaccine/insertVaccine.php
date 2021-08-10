<?php
include_once '../../templates/header.php';
include_once '../../../config/db.php';
?>

<html>

<body>
    <div class="container">
        <div class="row">
            <h2 class="modify-page-title">Insert a Vaccine</h2>
        </div>
        <div class="row" style="text-align: center;">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3" style="text-align: left;" action="../../../lib/processVaccineInsertion.php" method="POST">
                        <div class="col-sm-6">
                            <label for="type_name" class="form-label">Vaccine Name</label>
                            <input type="text" class="form-control" id="type_name" name="type_name" placeholder="Pfizer" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="status" class="form-label">Vaccine Status</label>
                            <select class="form-select" id="status" name="status" aria-label="Select Type" required>
                                <option value="" selected disabled>Select vaccine status</option>
                                <option value='SAFE'>Safe</option>
                                <option value='SUSPENDED'>Suspended</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for="date_of_approval" class="form-label">Approval Date</label>
                            <input type="date" class="form-control" id="date_of_approval" name="date_of_approval" required>
                        </div>
                        <div class="col-sm-6">
                            <label for="date_of_suspension" class="form-label">Suspended Date</label>
                            <input type="date" class="form-control" id="date_of_suspension" name="date_of_suspension">
                        </div>
                        <div>
                            <button class="btn btn-success" type="submit">Add Variant</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>

</html>