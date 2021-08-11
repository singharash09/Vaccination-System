<?php
include_once '../../templates/header.php';
include_once '../../../config/db.php';
?>

<html>
<body>
    <div class="container">
        <div class="row">
            <h2 class="modify-page-title">You are now editing province:
                <?php
                if (isset($_GET['provinceToEdit'])) {
                    $provinceToEdit = $_GET['provinceToEdit'];
                    echo $provinceToEdit;
                }
                ?>
            </h2>
        </div>

        <div class="row" style="text-align: center;">
            <div class="card">
                <div class="card-body">
                    <form class="row g-3" style="text-align: left;" action="../../../lib/processProvinceEdit.php?provinceToEdit=<?php echo $provinceToEdit ?>" method="POST">

                        <?php
                        $query = "SELECT*FROM Province WHERE Province.province_code ='$provinceToEdit';";
                        $result = mysqli_query($conn, $query);
                        $resultCheck = mysqli_num_rows($result);
                        if ($resultCheck > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $editGroup = $row['eligible_group_id'];
                            }
                        }
                        ?>
                        <div class="col-sm">
                            <label for="province_code" class="form-label">Province Code</label>
                            <input type="text" value="<?php echo $provinceToEdit ?>" class="form-control" id="province_code" name="province_code" minlength="2" maxlength="2" required>
                        </div>
                        <div class="col-sm">
                            <label for="eligible_group_id" class="form-label">Eligible Group</label>
                            <select class="form-select" id="eligible_group_id" name="eligible_group_id" aria-label="Select Type" required>
                                <option>Select</option>
                                  <?php
                                  $query1 = "SELECT group_id FROM Age_Group;";
                                  $result = mysqli_query($conn, $query1);
                                  $resultCheck = mysqli_num_rows($result);
                                  if($resultCheck>0){
                                      while($row = mysqli_fetch_assoc($result)){
                                          echo '<option value="'.$row['group_id'].'">'.$row['group_id'].'</option>';
                                        }
                                    }
                                  ?>
                            </select> 
                        </div>
                        <div>
                            <button class="btn btn-secondary" type="submit">Update</button>
                        </div>
                </div>
                </form>
</body>

</html>