<?php
include_once '../../templates/header.php';
include_once '../../../config/db.php';
?>
<html>
    <head>
        <link rel="stylesheet" href="../../css/styles.css">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    </head>

    <body>
        <div class="container">
            <div class="row top-buffer">
                <div class="col-sm-9"><h1 class="page-title"> <i class="fas fa-map"></i> Provinces</h1></div>
                <div class="col-sm-3" style="text-align: right;">
                    <a href="insertProvince.php" type="button" class="btn btn-success button-style"><i class="fas fa-plus"></i> Add</a>
                </div>
            </div>
            <div class="row">

            </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col-md">Province</th>
                    <th scope="col-md">Eligible Group</th>
                    <th scope="col-sm"></th>
                    <th scope="col-sm"></th>                    
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT*FROM Province";
                $result = mysqli_query($conn, $query);
                $resultCheck = mysqli_num_rows($result);
      
                if($resultCheck>0){
                    while($row = mysqli_fetch_assoc($result)){
                        echo 
                        '<tr><th scope="row">'.$row['province_code'].'</th>
                        <td>'.$row['eligible_group_id'].'</td>
                        <td><a href="../../../lib/processProvinceDeletion.php?provinceToDelete='.$row['province_code'].'" type="button" class="btn btn-danger button-style"><i class="fas fa-times"></i></a></td>
                        <td><a href="editProvince.php?provinceToEdit='.$row['province_code'].'" type="button" class="btn btn-secondary button-style"><i class="fas fa-edit"></i></a></td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </body>
        </div>
</html>