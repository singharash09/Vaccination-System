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
                <h2 class="modify-page-title">You are now editing variant: 
                    <?php
                    if(isset($_GET['variantEditType'])){
                        $variantToEdit = $_GET['variantEditType'];
                        echo $variantToEdit;
                    }
                    ?>
                </h2>
            </div> 
            
            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../lib/processPersonEdit.php" method="POST">
                       
                       <?php
                       $query = "SELECT*FROM Infection_Type WHERE Infection_Type.type_of_infection ='$variantToEdit';";
                       $result = mysqli_query($conn, $query);
                       $resultCheck = mysqli_num_rows($result);                     
                       if($resultCheck>0){
                           while($row = mysqli_fetch_assoc($result)){
                               $editVariant = $row['type_of_infection'];
                           }
                       }
                       ?>
                        <div class="mb-3">
                              <label for="type_of_infection" class="form-label">Variant Name</label>
                              <input type="text" value="<?php echo $variantToEdit?>" class="form-control" id="type_of_infection" name="type_of_infection" required>
                          </div>   
                          <div>
                             <button class="btn btn-secondary" type="submit">Update</button>
                          </div>
                          </div>                                            
                       </form>
    </body>
</html>