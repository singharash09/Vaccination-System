<?php
include_once '../../templates/header.php';
include_once '../../../config/db.php';
?>

<html>
<body>
    <div class="container">
        <div class="row">
            <h2 class="modify-page-title">Insert a Province</h2>
        </div>
        <div class="row" style="text-align: center;">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3" style="text-align: left;" action="../../../lib/processProvinceInsertion.php" method="POST">
                        <div class="col-sm">
                            <label for="province_code" class="form-label">Province Code</label>
                            <input type="text" class="form-control" id="province_code" name="province_code" minlength="2" maxlength="2" placeholder='QC' required>
                        </div>
                        <div class="col-sm">
                            <label for="eligible_group_id" class="form-label">Eligible Group</label>
                            <select class="form-select" id="eligible_group_id" name="eligible_group_id" aria-label="Select Type" required>
                                <option value="" selected disabled>Select a group</option>
                                <?php
                                for ($x = 0; $x <= 10; $x++) {
                                    echo '<option value=' . $x . '>' . $x . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div>
                            <button class="btn btn-success" type="submit">Add Province</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>
</html>