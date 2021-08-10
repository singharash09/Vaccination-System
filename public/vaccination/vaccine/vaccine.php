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
            <div class="col-sm-9">
                <h1 class="page-title"> <i class="fas fa-flask"></i> Vaccine Types</h1>
            </div>
            <div class="col-sm-3" style="text-align: right;">
                <a href="insertVaccine.php" type="button" class="btn btn-success button-style"><i class="fas fa-plus"></i> Add</a>
            </div>
        </div>
        <div class="row">

        </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col-md">Vaccine Type</th>
                    <th scope="col-md">Status</th>
                    <th scope="col-md">Approval Date</th>
                    <th scope="col-md">Suspension Date</th>
                    <th scope="col-sm"></th>
                    <th scope="col-sm"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT*FROM Vaccine_Type";
                $result = mysqli_query($conn, $query);
                $resultCheck = mysqli_num_rows($result);

                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo
                        '<tr><th scope="row">' . $row['type_name'] . '</th>
                        <td>' . $row['status'] . '</td>
                        <td>' . $row['date_of_approval'] . '</td>
                        <td>' . $row['date_of_suspension'] . '</td>
                        <td><a href="../../../lib/processVaccineDeletion.php?vaccineToDelete=' . $row['type_name'] . '" type="button" class="btn btn-danger button-style"><i class="fas fa-times"></i></a></td>
                        <td><a href="editVaccine.php?vaccineEditType=' . $row['type_name'] . '" type="button" class="btn btn-secondary button-style"><i class="fas fa-edit"></i></a></td>
                        </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
</body>
</div>

</html>