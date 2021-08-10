<?php
include_once '../templates/header.php';
//include_once '../../config/db.php';
?>

<!DOCTYPE html>

<html>
    <head>

    <link rel="stylesheet" href="../css/styles.css">
        
    </head>

    <body>
        <div class="container">
            <div class="row top-buffer">
                <div class="col-sm-9"><h1 class="page-title"> <i class="fas fa-syringe"></i>  Vaccination</h1></div>
            </div>
            
            <div class="row text-center cell">
                <div class="col-lg-2 cell">
                    <a href="performVaccination/performVaccination.php" class="btn btn-sq-lg btn-primary" style="display: inline-block; text-align: center; margin:10px;  padding: 1vw;font-weight: bolder;">
                    <i class="fas fa-table  fa-5x"></i></br></br>
                    &nbsp;&nbsp;Vaccinations&nbsp;&nbsp;
                    </a>   
                 </div> 
                <div class="col-lg-2 cell">
                    <a href="vaccine/vaccine.php" class="btn btn-sq-lg btn-primary" style="display: inline-block; text-align: center; margin:10px;   padding: 1vw;font-weight: bolder;">
                    <i class="fas fa-flask fa-5x"></i></br></br>
                    Vaccine Types
                    </a>      
                </div>
                   <div class="col-lg-2 cell">               
                    <a href="/ageGroup/ageGroup.php" class="btn btn-sq-lg btn-primary" style="display: inline-block;text-align: center; margin:10px;  padding: 1vw; font-weight: bolder;">
                    <i class="fas fa-user-circle fa-5x"></i></br></br>
                    &nbsp;&nbsp;&nbsp;Age Group &nbsp;&nbsp;&nbsp;
                    </a>  
                   </div>
                   <div class="col-lg-2 cell">                   
                    <a href="province/province.php" class="btn btn-sq-lg btn-primary" style="display: inline-block; text-align: center; margin:10px; padding: 1vw; font-weight: bolder;">
                    <i class="fas fa-map fa-5x"></i></br></br>
                    &nbsp;&nbsp;&nbsp;&nbsp;Province&nbsp;&nbsp;&nbsp;&nbsp;
                    </a> 
                   </div>   
                     <div class="col-lg-2 cell">                       
                    <a href="variants/variants.php" class="btn btn-sq-lg btn-primary" style="display: inline-block; text-align: center; margin:10px; padding: 1vw; font-weight: bolder;">
                    <i class="fas fa-viruses fa-5x"></i></br></br>
                    &nbsp;&nbsp;&nbsp;&nbsp;Variants&nbsp;&nbsp;&nbsp;&nbsp;
                    </a> 
                    </div>  
                   <div class="col-lg-2 cell">                   
                    <a href="infection/infection.php" class="btn btn-sq-lg btn-primary" style="display: inline-block; text-align: center; margin:10px; padding: 1vw; font-weight: bolder;">
                    <i class="fas fa-disease fa-5x"></i></br></br>
                    &nbsp;&nbsp;&nbsp;&nbsp;Infection&nbsp;&nbsp;&nbsp;&nbsp;
                    </a> 
                   </div>                        
            </div>
        </div>
    </body>
</html>