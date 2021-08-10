<?php
include_once '../../templates/header.php';
include_once '../../../config/db.php';
?>


<html>
    <head>

    </head>

    <body>
        <div class="container">
            <div class="row">
                <h2 class="modify-page-title">You are now editing Age Group: 
                    <?php
                    if(isset($_GET['ageGroupEditID'])){
                        $ageGroupToEdit = $_GET['ageGroupEditID'];
                        echo $ageGroupToEdit;
                    }
                    ?>
                </h2>
            </div> 
            
            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../../lib/processAgeGroupEdit.php" method="POST">
                       <?php
                       $query = "SELECT*FROM Age_Group WHERE group_id =$ageGroupToEdit;";
                       $result = mysqli_query($conn, $query);
                       $resultCheck = mysqli_num_rows($result);                     
                       if($resultCheck>0){
                           while($row = mysqli_fetch_assoc($result)){
                               $editGroupID= $row['group_id'];
                               $editMinAge = $row['min_age'];
                               $editMaxAge = $row['max_age'];
                           }
                       }
                       ?>
                         <div >
                              <input type="hidden" value="<?php echo $ageGroupToEdit ?>" class="form-control" id="group_id" name="group_id"placeholder="1" required>
                          </div>

                          <div class="col-sm-2">
                              <label for="min_age" class="form-label">Minimum Age</label>
                              <input type="number" value="<?php echo  $editMinAge?>" class="form-control" id="min_age" name="min_age" min="0" placeholder="1" required>
                          </div>

                          <div class="col-sm-2">
                              <label for="max_age" class="form-label">Maximum Age</label>
                              <input type="number" value="<?php echo  $editMaxAge?>" class="form-control" name="max_age" id="max_age" min="1" placeholder="1" required>                        
                          </div>
                          
                          <div>
                             <button class="btn btn-secondary" type="submit">Update</button>
                          </div>
                          </div>                                            
                       </form>
    </body>
</html>