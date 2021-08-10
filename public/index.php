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
               <h1 class="page-title cen"><i class="fas fa-tachometer-alt"></i> Dashboard</h1>
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
                                 $query = "SELECT P.SSN, P.first_name, P.last_name, P.date_of_birth, P.email_address, P.telephone_number, Pc.city,dose_number  date_of_vaccination, type_name, IF(COUNT(I.date_of_infection)> 0 , 'YES', 'NO') AS 'Previously Infected ?'
                                 FROM Person P
                                 LEFT JOIN Infection as I on P.SSN = I.SSN
                                 INNER JOIN Postal_Code as Pc on P.postal_code = Pc.postal_code
                                 INNER JOIN Vaccination as V on P.SSN = V.SSN
                                 WHERE
                                 dose_number =1 AND
                                 Email_address NOT IN(SELECT email_address FROM Person,Vaccination Where Person.SSN = Vaccination.SSN AND dose_number =2) AND
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
                                 <th scope="col-md">Previously Infected?</th>                             
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $query = "select P.first_name, P.last_name, P.date_of_birth, P.email_address, P.telephone_number, PC.city, V.date_of_vaccination, V.type_name, IF(COUNT(I.date_of_infection)> 0 , 'YES', 'NO') AS 'Previously Infected ?'
                                 from Person P
                                 LEFT JOIN  Infection as I on P.SSN = I.SSN
                                 inner join Postal_Code as PC on P.postal_code = PC.postal_code 
                                 inner join Vaccination as V on P.SSN = V.SSN
                                 WHERE PC.city ='Montreal' 
                                 GROUP BY P.SSN
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



               <!---ROW 3--->
               
         <div class="row" style="margin:25px; margin-bottom:50px;">
            <div class="col-sm-4">
                <h4>Inventory By Province</h4>               
               <div class="card" >
                  <div class="card-body">
                     <div style="height: 200px; overflow: scroll;">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th scope="col-md">Province</th>
                                 <th scope="col-md">Type Name</th>
                                 <th scope="col-md">Total Number</th>                            
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $query = "select PC.province_code, I.type_name, SUM(I.number_of_vaccines) AS 'number_of_vaccines'
                                 from Inventory I
                                 inner join Vaccination_Facility as VF on I.facility_name = VF.facility_name
                                 inner join Postal_Code as PC on VF.postal_code = PC.postal_code
                                 GROUP BY (type_name)
                                 order by PC.province_code asc, I.number_of_vaccines desc;";  
                                 $result = mysqli_query($conn, $query);
                                 $resultCheck = mysqli_num_rows($result);
                                 if($resultCheck>0){
                                     while($row = mysqli_fetch_assoc($result)){
                                         echo '<tr><th scope="row">'.$row['province_code'].'</th>
                                         <td>'.$row['type_name'].'</td>
                                         <td>'.$row['number_of_vaccines'].'</td>                                                         
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
