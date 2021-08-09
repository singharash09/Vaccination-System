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
                <h2 class="modify-page-title">Insert a Variant</h2>
            </div>
            <div class="row" style="text-align: center;">
               <div class="card">
                   <div class="card-body">
                       <form class="row g-3" style="text-align: left;" action="../../../lib/processVariantInsertion.php" method="POST">
                          <div class="mb-3">
                              <label for="type_of_infection" class="form-label">Variant Name</label>
                              <input type="text" class="form-control" id="type_of_infection" name="type_of_infection" placeholder="Delta" required>
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

        <script>

        </script>
    </body>
</html>