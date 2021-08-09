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
                       <form class="row g-3" style="text-align: left;" action="../../../lib/processVariantEdit.php?variantToEdit=<?php echo $variantToEdit ?>" method="POST">
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
