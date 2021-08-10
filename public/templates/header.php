<!DOCTYPE html>
<html>
    <head>
        <!--Styles-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link rel="icon" type="image/png" href="/COMP353/public/assets/logo.png"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
        <link rel="stylesheet" href="/COMP353/public/css/styles.css">
        <!--Scripts-->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>

    <body>
    <div class="menu">
    <div class="row text-center logo-space">
        <!--Must change this url when pushing to concordia servers-->
        <div class="span4"><img class="center-block" height="100" width="100" src="/COMP353/public/assets/logo.png" /></div>
        <h2>Vaccination Management System</h2>
    </div>
    

    <div>
        <nav class="navbar navbar-expand-md py-3" style="background-color: #cc0000;">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <!--Must change this url when pushing to concordia servers-->
                    <a class="nav-link active" aria-current="page" href="/COMP353/public/people/people.php"><i class="fas fa-users"></i>  People</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/COMP353/public/vaccination/vaccination.php"><i class="fas fa-syringe"></i>  Vaccinations</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/COMP353/public/index.php"><i class="fas fa-tachometer-alt"></i>  Dashboard</a>
                </li>               
               <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/COMP353/public/Facility/Facility.php"><i class="fas fa-hospital-alt"></i>  Facilities</a>
                </li>
               <li class="nav-item">
                    <a class="nav-link" aria-current="page" href="/COMP353/public/employees/employees.php"><i class="fas fa-user-nurse"></i>  Employees</a>
                </li>
        </nav>

         </div>
    </div>

    </body>

</html>