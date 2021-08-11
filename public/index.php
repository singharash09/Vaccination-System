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
                                 $query = "SELECT P.SSN, P.first_name, P.last_name, P.date_of_birth, P.email_address, P.telephone_number, Pc.city, date_of_vaccination, type_name, IF(COUNT(I.date_of_infection)> 0 , 'YES', 'NO') AS 'Previously Infected ?'
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
            <div class="col-sm-6">
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
                                 GROUP BY PC.province_code, I.type_name
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
   
            
            <div class="col-sm-6">
                <h4>Vaccines by received city in Quebec</h4>               
               <div class="card" >
                  <div class="card-body">
                     <div style="height: 200px; overflow: scroll;">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th scope="col-md">City</th>
                                 <th scope="col-md">Total</th>                           
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $query = "SELECT city, SUM(number_of_vaccines) AS `num_vaccines`
                                 FROM Shipment s, Vaccination_Facility f, Postal_Code pc
                                 WHERE s.facility_name = f.facility_name AND f.postal_code = pc.postal_code 
                                 AND pc.province_code = 'QC'
                                 AND s.date_of_transfer BETWEEN CAST('2021-1-01' AS DATE) AND CAST('2021-7-22' AS DATE)
                                 GROUP BY city;";  
                                 $result = mysqli_query($conn, $query);
                                 $resultCheck = mysqli_num_rows($result);
                                 if($resultCheck>0){
                                     while($row = mysqli_fetch_assoc($result)){
                                         echo '<tr><th scope="row">'.$row['city'].'</th>
                                         <td>'.$row['num_vaccines'].'</td>                                                                                                    
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


   <div class="row" style="margin:25px; margin-bottom:50px;">
         <div class="col-sm-12">
                <h4>Total vaccines used between January 1 & July 22</h4>               
               <div class="card" >
                  <div class="card-body">
                     <div style="height: 200px; overflow: scroll;">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th scope="col-md">Province</th>
                                 <th scope="col-md">Type Name</th>
                                 <th scope="col-md">Count</th>                            
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $query = "select Postal_Code.province_code, Vaccine_Type.type_name, COUNT(DISTINCT Vaccination.SSN) AS 'Count'
                                          from Postal_Code, Vaccine_Type, Vaccination, Vaccination_Facility
                                          where Vaccination.date_of_vaccination>='2021-01-01' and Vaccination.date_of_vaccination<='2021-07-22'
                                             and Vaccine_Type.type_name=Vaccination.type_name and Vaccination.facility_name=Vaccination_Facility.facility_name
                                             and Vaccination_Facility.postal_code=Postal_Code.postal_code
                                          group by Postal_Code.province_code, Vaccine_Type.type_name
                                          order by Postal_Code.province_code asc, Vaccine_Type.type_name asc;";  
                                 $result = mysqli_query($conn, $query);
                                 $resultCheck = mysqli_num_rows($result);
                                 if($resultCheck>0){
                                     while($row = mysqli_fetch_assoc($result)){
                                         echo '<tr><th scope="row">'.$row['province_code'].'</th>
                                         <td>'.$row['type_name'].'</td>
                                         <td>'.$row['Count'].'</td>                                                                                                    
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



   <div class="row" style="margin:25px; margin-bottom:50px;">
         <div class="col-sm-12">
                <h4>All workers working in a specific facility</h4>               
               <div class="card" >
                  <div class="card-body">
                     <div style="height: 200px; overflow: scroll;">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th scope="col-md">Facility Name</th>
                                 <th scope="col-md">Employee ID</th>                            
                                 <th scope="col-md">SSN</th>
                                 <th scope="col-md">First Name</th>   
                                 <th scope="col-md">Last Name</th>
                                 <th scope="col-md">DOB</th>  
                                 <th scope="col-md">Medicare</th>   
                                 <th scope="col-md">Phone</th>  
                                 <th scope="col-md">Email</th>                              
                                 <th scope="col-md">Address</th>
                                 <th scope="col-md">City</th>   
                                 <th scope="col-md">Province</th> 
                                 <th scope="col-md">Postal Code</th> 
                                 <th scope="col-md">Citizenship</th>                                                                                                                                                                                                                                                                                                               
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                    $query = "select WA.facility_name, HCW.EID, HCW.SSN, Person.first_name, last_name, date_of_birth, medicare, 
                                                telephone_number, address, PC.city, province_code, PC.postal_code, Person.citizenship, email_address, 
                                                WA.start_date, end_date
                                             from HealthCare_Worker HCW, Person, Postal_Code PC, Works_At WA
                                             where WA.SSN=HCW.SSN and HCW.SSN=Person.SSN and Person.postal_code=PC.postal_code and WA.facility_name = 'Williams View Clinic'
                                             group by WA.facility_name, HCW.EID
                                             order by WA.facility_name asc, HCW.EID asc;";  
                                 $result = mysqli_query($conn, $query);
                                 $resultCheck = mysqli_num_rows($result);
                                 if($resultCheck>0){
                                     while($row = mysqli_fetch_assoc($result)){
                                         echo '<tr><th scope="row">'.$row['facility_name'].'</th>
                                         <td>'.$row['EID'].'</td>
                                         <td>'.$row['SSN'].'</td>
                                         <td>'.$row['first_name'].'</td> 
                                           <td>'.$row['last_name'].'</td> 
                                           <td>'.$row['date_of_birth'].'</td>                                                                                                                                 
                                           <td>'.$row['medicare'].'</td> 
                                           <td>'.$row['telephone_number'].'</td> 
                                           <td>'.$row['email_address'].'</td> 
                                           <td>'.$row['address'].'</td>
                                           <td>'.$row['city'].'</td> 
                                           <td>'.$row['province_code'].'</td> 
                                           <td>'.$row['postal_code'].'</td>
                                           <td>'.$row['citizenship'].'</td>   

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
         


   <div class="row" style="margin:25px; margin-bottom:50px;">
         <div class="col-sm-12">
                <h4>All workers in QC never vaccinated or vaccinated only once</h4>               
               <div class="card" >
                  <div class="card-body">
                     <div style="height: 200px; overflow: scroll;">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th scope="col-md">Employee ID</th>
                                 <th scope="col-md">First Name</th>   
                                 <th scope="col-md">Last Name</th>
                                 <th scope="col-md">DOB</th>   
                                 <th scope="col-md">Phone</th>  
                                 <th scope="col-md">Email</th>                              
                                 <th scope="col-md">City</th>   
                                 <th scope="col-md">Facility Name</th>                                                                                                                                                                                                                                                                                                               
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $query = "select HCW.EID, P.first_name, P.last_name, P.date_of_birth, P.telephone_number, PC.city,
                                             P.email_address, WA.facility_name
                                          from Person P
                                          LEFT JOIN Vaccination AS V on P.SSN = V.SSN
                                          INNER JOIN Works_At as WA on P.SSN = WA.SSN
                                          INNER JOIN HealthCare_Worker AS HCW on HCW.SSN = WA.SSN
                                          INNER JOIN  Postal_Code AS PC on P.postal_code = PC.postal_code
                                          group by HCW.EID
                                          having COUNT(V.SSN)<=1
                                          order by HCW.EID asc;";  
                                 $result = mysqli_query($conn, $query);
                                 $resultCheck = mysqli_num_rows($result);
                                 if($resultCheck>0){
                                     while($row = mysqli_fetch_assoc($result)){
                                         echo '<tr><th scope="row">'.$row['EID'].'</th>
                                         <td>'.$row['first_name'].'</td> 
                                           <td>'.$row['last_name'].'</td> 
                                           <td>'.$row['date_of_birth'].'</td>                                                                                                                                 
                                           <td>'.$row['telephone_number'].'</td> 
                                           <td>'.$row['email_address'].'</td> 
                                           <td>'.$row['city'].'</td> 
                                           <td>'.$row['facility_name'].'</td>  
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

   <div class="row" style="margin:25px; margin-bottom:50px;">
         <div class="col-sm-12">
                <h4>Detailed Report Of Facilities In Montreal</h4>               
               <div class="card" >
                  <div class="card-body">
                     <div style="height: 200px; overflow: scroll;">
                        <table class="table table-striped">
                           <thead>
                              <tr>
                                 <th scope="col-md">Facility Name</th>
                                 <th scope="col-md">Address</th>   
                                 <th scope="col-md">Facility Type</th>
                                 <th scope="col-md">Phone Number</th>   
                                 <th scope="col-md">Number Of Wokers</th>  
                                 <th scope="col-md">Total Number Of Shipments</th>   
                                 <th scope="col-md">Doses Received Via Shipments</th> 
                                 <th scope="col-md">Total Number Of Transfers In</th> 
                                 <th scope="col-md">Doses from Transfers In</th>                                                                                                                     
                                 <th scope="col-md">Total Number Of Transfers Out</th>  
                                 <th scope="col-md">Doses from Transfers Out</th>                                  
                                 <th scope="col-md">Type Name</th>  
                                 <th scope="col-md">Number of Vaccines</th>
                                 <th scope="col-md">Total People Vaccinated</th>  
                                 <th scope="col-md">Total Doses Given</th>                                                                                                                                                                                                                                                                                                                                                                   
                              </tr>
                           </thead>
                           <tbody>
                              <?php
                                 $query = "SELECT f.facility_name, f.address, f.facility_type, f.phone_number,
                                          (SELECT COUNT(SSN) FROM Works_At WHERE end_date IS NULL AND facility_name = f.facility_name) AS `num_workers`,
                                          COUNT(DISTINCT s.shipment_ID) as `num_shipments`,
                                          (SELECT SUM(number_of_vaccines) FROM Shipment as s WHERE s.facility_name = f.facility_name) as `total_doses_received`,
                                          COUNT(DISTINCT tin.transfer_ID) as `num_trans_in`,
                                          (SELECT SUM(number_of_vaccines) FROM Transfers as t WHERE f.facility_name = t.transfer_in) as `doses_trans_in`,
                                          COUNT(DISTINCT tout.transfer_ID) as `num_trans_out`,
                                          (SELECT SUM(number_of_vaccines) FROM Transfers as t WHERE f.facility_name = t.transfer_out) as `doses_trans_out`,
                                          i.type_name,
                                          i.number_of_vaccines,
                                          COUNT(DISTINCT v.ssn) as `total_ppl_vax`,
                                          COUNT(DISTINCT v.vaccination_id) as `total_vax_given`
                                          FROM Vaccination_Facility f
                                          LEFT JOIN Vaccination AS v ON f.facility_name = v.facility_name
                                          INNER JOIN Postal_Code AS p ON f.postal_code = p.postal_code
                                          INNER JOIN Inventory AS i ON f.facility_name = i.facility_name
                                          INNER JOIN Shipment AS s ON f.facility_name = s.facility_name
                                          LEFT JOIN Transfers AS tin ON f.facility_name = tin.transfer_in
                                          LEFT JOIN Transfers AS tout ON f.facility_name = tout.transfer_out
                                          WHERE p.city = 'Montreal'
                                          GROUP BY f.facility_name, i.type_name;";  
                                 $result = mysqli_query($conn, $query);
                                 $resultCheck = mysqli_num_rows($result);
                                 if($resultCheck>0){
                                     while($row = mysqli_fetch_assoc($result)){
                                         echo '<tr><th scope="row">'.$row['facility_name'].'</th>
                                         <td>'.$row['address'].'</td> 
                                           <td>'.$row['facility_type'].'</td> 
                                           <td>'.$row['phone_number'].'</td>                                                                                                                                 
                                           <td>'.$row['num_workers'].'</td> 
                                           <td>'.$row['num_shipments'].'</td> 
                                           <td>'.$row['total_doses_received'].'</td>  
                                           <td>'.$row['num_trans_in'].'</td>  
                                           <td>'.$row['doses_trans_in'].'</td>  
                                           <td>'.$row['num_trans_out'].'</td>  
                                           <td>'.$row['doses_trans_out'].'</td>   
                                          <td>'.$row['type_name'].'</td>
                                          <td>'.$row['number_of_vaccines'].'</td>                                                                                                                                                                   
                                          <td>'.$row['total_ppl_vax'].'</td>
                                          <td>'.$row['total_vax_given'].'</td>
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

   <?php   include_once 'templates/footer.php'; ?>
</html>
