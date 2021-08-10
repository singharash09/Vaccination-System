<?php
include_once '../templates/header.php';
include_once '../../config/db.php';

/*if(isset($_GET['insertion'])){

    if($_GET['insertion'] == 'failed'){
        $message = '';
        if(isset($_GET['type'])){
            if($_GET['type'] == 'SSN'){
                $message = "Duplicate SSN!";
            }else if($_GET['type'] == 'EID'){
                $message = "Duplicate Employee ID!";
            }else if($_GET['type'] == 'Unexpected'){
                $message = "Unexpected error";
            }
        }

        unset($_GET['insertion']);
        unset($_GET['type']);
    }
}*/
?>
<html>
    <head>
        <script type="text/javascript" src="../js/script.js"> </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <h2 class="modify-page-title">Insert an Age Group</h2>
            </div>
            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../lib/processAgeGroupInsertion.php" method="POST">
                          <div class="col-sm-3">
                              <label for="group_id" class="form-label">Group number</label>
                              <input type="number" class="form-control" id="group_id" name="group_id" placeholder="1 " required>
                          </div>
                          <div class="col-sm-3">
                              <label for="min_age" class="form-label">Minimum age</label>
                              <input type="number" class="form-control" id="min_age" name="min_age"  placeholder="1" required>
                          </div>
                          <div class="col-sm-3">
                              <label for="max_age" class="form-label">Maximum Age</label>
                              <input type="number" class="form-control" name="max_age" id="max_age"  placeholder="1" required>                        
                          </div>
                                 
                                                                 
                       </form>
                    
                    </div>
               </div>
            </div>
        </div>



    </body>
</html>