<?php
   include_once '../config/db.php';
   include_once 'templates/header.php';
   ?>
<!DOCTYPE html>
<html>
   <head>
   </head>
   <body>
      <div class="container">
         <div class="row top-buffer">
            <div class="row" style="text-align:center;">
               <h1 class="page-title cen">Reports</h1>
            </div>
         </div>
         <!---ROW 1--->
         <div class="row" style="margin:25px; margin-bottom:50px;">
            <div class="col-sm-12">
                <h4>People Vaccinated with 1 dose with ages 60+</h4>
               <div class="card" >
                  <div class="card-body">
                     <div style="height: 150px; overflow: scroll;">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th scope="col-md">First Name</th>
                                 <th scope="col-md">Last Name</th>
                                 <th scope="col-md">DOB</th>
                                 <th scope="col-md">Email</th>
                                 <th scope="col-md">Phone</th>
                                 <th scope="col-md">City</th>
                                 <th scope="col-md">Date of Vaccination</th>
                                 <th scope="col-md">Vacccine</th>
                                 <th scope="col-md">Previously Infected?</th>
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $query = "SELECT P.SSN, P.first_name, P.last_name, P.date_of_birth, P.email_address, P.telephone_number, Pc.city,  date_of_vaccination, type_name, IF(COUNT(I.date_of_infection)> 0 , 'YES', 'NO') AS 'Previously Infected ?'
                                 FROM Person P
                                 LEFT JOIN Infection as I on P.SSN = I.SSN
                                 INNER JOIN Postal_Code as Pc on P.postal_code = Pc.postal_code
                                 INNER JOIN Vaccination as V on P.SSN = V.SSN
                                 WHERE
                                 dose_number = 1 AND
                                 (FLOOR(DATEDIFF(date_of_vaccination,date_of_birth)/365.25) >=60)
                                 GROUP BY P.SSN;";

                                 $result = mysqli_query($conn, $query);
                                 $resultCheck = mysqli_num_rows($result);
                                 if($resultCheck>0){
                                     while($row = mysqli_fetch_assoc($result)){
                                         echo '<tr><th scope="row">'.$row['first_name'].'</th>
                                         <td>'.$row['last_name'].'</td>
                                         <td>'.$row['date_of_birth'].'</td>
                                         <td>'.$row['email_address'].'</td>
                                         <td>'.$row['telephone_number'].'</td>
                                         <td>'.$row['city'].'</td>
                                         <td>'.$row['date_of_vaccination'].'</td>
                                         <td>'.$row['type_name'].'</td>
                                         <td>'.$row['Previously Infected ?'].'</td>                       
                                         </tr>';
                                     }
                                 }
                                 ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>







         <!---ROW 2--->
         <div class="row" style="margin:25px; margin-bottom:50px;">
            <div class="col-sm-12">
                <h4>People in Montreal with 2 doses of different types</h4>
               <div class="card" >
                  <div class="card-body">
                     <div style="height: 100px; overflow: scroll;">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th scope="col-md">First Name</th>
                                 <th scope="col-md">Last Name</th>
                                 <th scope="col-md">DOB</th>
                                 <th scope="col-md">Email</th>
                                 <th scope="col-md">Phone</th>
                                 <th scope="col-md">City</th>
                                 <th scope="col-md">Date of Vaccination</th>
                                 <th scope="col-md">Vacccine</th>
                                 <th scope="col-md">Date Of Infection</th>
                                 <th scope="col-md">Type of Infection</th>                               
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $query = "select P.first_name, P.last_name, P.date_of_birth, P.email_address, P.telephone_number, PC.city, V.date_of_vaccination, V.type_name, I.date_of_infection, I.type_of_infection
                                 from Person P
                                 inner join Postal_Code as PC on P.postal_code = PC.postal_code 
                                 inner join Infection as I on P.SSN = I.SSN
                                 inner join Vaccination as V on P.SSN = V.SSN
                                 where PC.city = 'Montreal'
                                 having count(distinct V.type_name) >= 2;"; 

                                 $result = mysqli_query($conn, $query);
                                 $resultCheck = mysqli_num_rows($result);
                                 if($resultCheck>0){
                                     while($row = mysqli_fetch_assoc($result)){
                                         echo '<tr><th scope="row">'.$row['first_name'].'</th>
                                         <td>'.$row['last_name'].'</td>
                                         <td>'.$row['date_of_birth'].'</td>
                                         <td>'.$row['email_address'].'</td>
                                         <td>'.$row['telephone_number'].'</td>
                                         <td>'.$row['city'].'</td>
                                         <td>'.$row['date_of_vaccination'].'</td>
                                         <td>'.$row['type_name'].'</td>
                                         <td>'.$row['date_of_infection'].'</td> 
                                         <td>'.$row['type_of_infection'].'</td>                                                                
                                         </tr>';
                                     }
                                 }
                                 ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>



               <!---ROW 3--->
               
         <div class="row" style="margin:25px; margin-bottom:50px;">
            <div class="col-sm-12">
                <h4>Vaccinated people infected with at least 2 different COVID-19 variants</h4>               
               <div class="card" >
                  <div class="card-body">
                     <div style="height: 100px; overflow: scroll;">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th scope="col-md">First Name</th>
                                 <th scope="col-md">Last Name</th>
                                 <th scope="col-md">DOB</th>
                                 <th scope="col-md">Email</th>
                                 <th scope="col-md">Phone</th>
                                 <th scope="col-md">City</th>
                                 <th scope="col-md">Date of Vaccination</th>
                                 <th scope="col-md">Vacccine</th>
                                 <th scope="col-md">Date Of Infection</th>
                                 <th scope="col-md">Type of Infection</th>                               
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $query = "select P.first_name, P.last_name, P.date_of_birth, P.email_address, P.telephone_number, PC.city, V.date_of_vaccination, V.type_name, count(I.date_of_infection)
                                 from Person P
                                 inner join Postal_Code as PC on P.postal_code = PC.postal_code 
                                 inner join Vaccination as V on P.SSN = V.SSN
                                 inner join Infection as I on P.SSN = I.SSN
                                 having count(distinct I.type_of_infection) >= 2;";  

                                 $result = mysqli_query($conn, $query);
                                 $resultCheck = mysqli_num_rows($result);
                                 if($resultCheck>0){
                                     while($row = mysqli_fetch_assoc($result)){
                                         echo '<tr><th scope="row">'.$row['first_name'].'</th>
                                         <td>'.$row['last_name'].'</td>
                                         <td>'.$row['date_of_birth'].'</td>
                                         <td>'.$row['email_address'].'</td>
                                         <td>'.$row['telephone_number'].'</td>
                                         <td>'.$row['city'].'</td>
                                         <td>'.$row['date_of_vaccination'].'</td>
                                         <td>'.$row['type_name'].'</td>
                                         <td>'.$row['date_of_infection'].'</td> 
                                         <td>'.$row['type_of_infection'].'</td>                                                                
                                         </tr>';
                                     }
                                 }
                                 ?>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>



        </div>
   </body>
</html>
