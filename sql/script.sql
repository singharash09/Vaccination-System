/*-------FILE ONLY FOR REFERENCE, NOT USED IN THE CODE--------*/

/*---------------------------------------------------
  -------------------Creating Tables----------------- 
  ---------------------------------------------------*/
-- Entity Age Group
CREATE TABLE Age_Group (
    group_id INTEGER,
    min_age INTEGER,
    max_age INTEGER,
    PRIMARY KEY (group_id)
);

CREATE TABLE Province(
	province_code CHAR(2) NOT NULL,
	eligible_group_id INTEGER NOT NULL,
    
    FOREIGN KEY (eligible_group_id) REFERENCES Age_Group(group_id) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (province_code)
);

CREATE TABLE Postal_Code (
    postal_code CHAR(6) NOT NULL,
	city VARCHAR(30) NOT NULL,
	province_code CHAR(2) NOT NULL,
	
    FOREIGN KEY (province_code) REFERENCES Province(province_code) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY (postal_code)
);

CREATE TABLE Person (
	-- general info
    SSN CHAR(9) NOT NULL,
    medicare CHAR(9),
    first_name VARCHAR(30),
	last_name VARCHAR(30),
    date_of_birth DATE NOT NULL,
	email_address CHAR(90) DEFAULT 'unknown',
    telephone_number CHAR(30) DEFAULT 'unknown',    
	citizenship CHAR(30) NOT NULL,
    
    -- address info
    address VARCHAR(255) NOT NULL,
    postal_code CHAR(6),
    
    FOREIGN KEY (postal_code) REFERENCES Postal_Code(postal_code) ON DELETE CASCADE,
    PRIMARY KEY (SSN)
);


CREATE TABLE Infection_Type(
    type_of_infection VARCHAR(30) NOT NULL,
    PRIMARY KEY(type_of_infection)
);

CREATE TABLE Infection (
    SSN CHAR(9) NOT NULL,
    date_of_infection DATE NOT NULL,    
    type_of_infection VARCHAR(30),
    
    FOREIGN KEY (SSN) REFERENCES Person(SSN) ON DELETE CASCADE,
    FOREIGN KEY (type_of_infection) REFERENCES Infection_Type(type_of_infection) ON DELETE CASCADE ON UPDATE CASCADE,
    PRIMARY KEY(SSN, date_of_infection)
);

CREATE TABLE HealthCare_Worker(
    SSN CHAR(9),
    EID CHAR(9) NOT NULL ,

    FOREIGN KEY(SSN) REFERENCES Person(SSN) ON DELETE CASCADE,
    UNIQUE (EID),
    PRIMARY KEY(SSN)
    );

-- Entity Vaccine_Type
CREATE TABLE Vaccine_Type (
    type_name VARCHAR(30) NOT NULL,
    status ENUM('SAFE', 'SUSPENDED'),
    date_of_approval DATE ,
    date_of_suspension DATE,

    PRIMARY KEY (type_name)
);

-- Entity Vaccination_Facility
CREATE TABLE Vaccination_Facility (
    -- general info
    facility_name VARCHAR(30) NOT NULL,
    facility_type VARCHAR(30) NOT NULL,
    web_address VARCHAR(100) DEFAULT 'unknown',
    phone_number VARCHAR(30) DEFAULT 'unknown',
    
    -- address info
    address VARCHAR(255) NOT NULL,
    postal_code CHAR(6),
    
    FOREIGN KEY (postal_code) REFERENCES Postal_Code(postal_code) ON DELETE CASCADE,
    PRIMARY KEY (facility_name)
);

-- Works_At relation
CREATE TABLE Works_At(
    SSN CHAR(9),
    facility_name VARCHAR(30),
    start_date DATE NOT NULL,
    end_date DATE ,
    
    
    FOREIGN KEY (SSN) REFERENCES HealthCare_Worker(SSN) ON DELETE CASCADE,
    FOREIGN KEY (facility_name) REFERENCES Vaccination_Facility(facility_name) ON DELETE CASCADE,
    PRIMARY KEY (SSN, facility_name, start_date)
    
);

-- Manages relation
CREATE TABLE Manages(
    SSN CHAR(9),
    facility_name VARCHAR(30),
    start_date DATE NOT NULL,
    end_date DATE ,
    
    FOREIGN KEY (SSN) REFERENCES HealthCare_Worker(SSN) ON DELETE CASCADE,
    FOREIGN KEY (facility_name) REFERENCES Vaccination_Facility(facility_name) ON DELETE CASCADE,
    PRIMARY KEY (SSN, facility_name, start_date)
    
);

-- Relation Vaccination_Infomation
CREATE TABLE Vaccination(
	vaccination_id INTEGER NOT NULL AUTO_INCREMENT,
    
    #information about this vaccination instance
    SSN CHAR(9),
    facility_name VARCHAR(30),
	type_name VARCHAR(30),
    dose_number INTEGER,
    date_of_vaccination DATE,
    Employee_SSN CHAR(9),
    
    FOREIGN KEY (Employee_SSN) REFERENCES HealthCare_Worker(SSN) ON DELETE CASCADE,
    FOREIGN KEY (SSN) REFERENCES Person(SSN) ON DELETE CASCADE,
    FOREIGN KEY (facility_name) REFERENCES Vaccination_Facility(facility_name)ON DELETE CASCADE,
    FOREIGN KEY (type_name) REFERENCES Vaccine_Type(type_name) ON DELETE CASCADE,
    PRIMARY KEY (vaccination_id)
);

-- Inventory Entity 
CREATE TABLE Inventory(
    facility_name VARCHAR(30),
    number_of_vaccines int NOT NULL,
    type_name VARCHAR(30),

    FOREIGN KEY (type_name) REFERENCES Vaccine_Type(type_name) ON DELETE CASCADE,
    FOREIGN KEY (facility_name) REFERENCES Vaccination_Facility(facility_name) ON DELETE CASCADE,
    PRIMARY KEY (facility_name, type_name)
);

CREATE TABLE Shipment(
    shipment_ID INTEGER NOT NULL AUTO_INCREMENT,
    type_name VARCHAR(30),
    number_of_vaccines INT NOT NULL,
    date_of_transfer DATE NOT NULL,
    facility_name VARCHAR(30),

    FOREIGN KEY (type_name) REFERENCES Vaccine_Type(type_name) ON DELETE CASCADE ,
    FOREIGN KEY (facility_name) REFERENCES Vaccination_Facility(facility_name) ON DELETE CASCADE,
    PRIMARY KEY (shipment_ID)
);

CREATE TABLE Transfers(
    transfer_ID INTEGER NOT NULL AUTO_INCREMENT,
    transfer_in VARCHAR(30),
    transfer_out VARCHAR(30),
    vaccine_type VARCHAR(30),
    number_of_vaccines INT NOT NULL,
    date_of_transfer DATE NOT NULL,

    FOREIGN KEY (vaccine_type) REFERENCES Vaccine_Type(type_name) ON DELETE CASCADE,
    FOREIGN KEY (transfer_in) REFERENCES Vaccination_Facility(facility_name) ON DELETE CASCADE,
    FOREIGN KEY (transfer_out) REFERENCES Vaccination_Facility(facility_name) ON DELETE CASCADE,

    PRIMARY KEY(transfer_ID)
);

/*---------------------------------------------------
  -------------------Droping Tables----------------- 
  ---------------------------------------------------*/
DROP TABLE Transfers;
DROP TABLE Shipment;
DROP TABLE Inventory;
DROP TABLE Vaccination;
DROP TABLE Manages;
DROP TABLE Works_At;
DROP TABLE Vaccination_Facility;
DROP TABLE Vaccine_Type;
DROP TABLE HealthCare_Worker;
DROP TABLE Infection;
DROP TABLE Infection_Type;
DROP TABLE Person;
DROP TABLE Postal_Code;
DROP TABLE Province;
DROP TABLE Age_Group;

/*---------------------------------------------------
  -----------------------Queries---------------------
  ---------------------------------------------------*/

-- Query 9
DELIMITER //
CREATE TRIGGER shipment_update
BEFORE INSERT ON Shipment FOR EACH ROW
BEGIN
    IF(EXISTS(SELECT facility_name, type_name FROM Inventory WHERE facility_name = NEW.facility_name AND type_name = NEW.type_name))
    THEN 
	UPDATE Inventory
    SET Inventory.number_of_vaccines = Inventory.number_of_vaccines + New.number_of_vaccines
    WHERE Inventory.facility_name = New.facility_name AND Inventory.type_name = New.type_name;
    ELSE 
    INSERT INTO Inventory VALUES (NEW.facility_name, NEW.number_of_vaccines, NEW.type_name);
    END IF;
END //
DELIMITER ;

DROP TRIGGER shipment_update;
SELECT DISTINCT type_name FROM Inventory WHERE facility_name="A Facility";
 -- QUERY 10 
 
DELIMITER //
CREATE TRIGGER transfer_update
BEFORE INSERT ON Transfers FOR EACH ROW
	BEGIN 
		
        
			IF ((((SELECT Inventory.number_of_vaccines FROM Inventory WHERE (Inventory.facility_name = New.transfer_out) AND (Inventory.type_name = New.vaccine_type)) >= New.number_of_vaccines)) AND 
            (EXISTS(SELECT facility_name, type_name FROM Inventory WHERE facility_name = NEW.transfer_in AND type_name = NEW.vaccine_type)) AND 
            (EXISTS(SELECT facility_name, type_name FROM Inventory WHERE facility_name = NEW.transfer_out AND type_name = NEW.vaccine_type)))
            
			THEN
				UPDATE Inventory
				SET Inventory.number_of_vaccines = Inventory.number_of_vaccines + New.number_of_vaccines 
				WHERE Inventory.facility_name = New.transfer_in AND Inventory.type_name = New.vaccine_type;
			
				UPDATE Inventory
				SET Inventory.number_of_vaccines = Inventory.number_of_vaccines - New.number_of_vaccines
				WHERE Inventory.facility_name = New.transfer_out AND Inventory.type_name = New.vaccine_type;
                
            ELSEIF(((NOT EXISTS(SELECT facility_name, type_name FROM Inventory WHERE facility_name = NEW.transfer_in AND type_name = NEW.vaccine_type))) AND 
            (EXISTS(SELECT facility_name, type_name FROM Inventory WHERE facility_name = NEW.transfer_out AND type_name = NEW.vaccine_type))) THEN
				
                INSERT INTO Inventory VALUES (NEW.transfer_in, NEW.number_of_vaccines, NEW.vaccine_type);
            
		END IF;
		
	END//

DELIMITER ;
DROP TRIGGER transfer_update;    

    -- QUERY 11 
    -- ( check if the person is part of the age group can be done on the front_end)
    
DELIMITER //
CREATE TRIGGER Vaccination_update
BEFORE INSERT ON Vaccination FOR EACH ROW
BEGIN 

    UPDATE Inventory
    SET Inventory.number_of_vaccines = Inventory.number_of_vaccines - 1
    WHERE Inventory.facility_name = New.facility_name AND Inventory.type_name = New.type_name;
    
	
    
END//    
DELIMITER ;

DROP TRIGGER Vaccination_update;

-- Query 12


SELECT P.SSN, P.first_name, P.last_name, P.date_of_birth, P.email_address, P.telephone_number, Pc.city,dose_number  date_of_vaccination, type_name, IF(COUNT(I.date_of_infection)> 0 , 'YES', 'NO') AS 'Previously Infected ?'
FROM Person P
LEFT JOIN Infection as I on P.SSN = I.SSN
INNER JOIN Postal_Code as Pc on P.postal_code = Pc.postal_code
INNER JOIN Vaccination as V on P.SSN = V.SSN
WHERE
dose_number = 1 AND
Email_address NOT IN(SELECT email_address FROM Person,Vaccination Where Person.SSN = Vaccination.SSN AND dose_number =2) AND
(FLOOR(DATEDIFF(date_of_vaccination,date_of_birth)/365.25) >=60)
GROUP BY P.SSN;
                                 



-- Query 13
select P.first_name, P.last_name, P.date_of_birth, P.email_address, P.telephone_number, PC.city, V.date_of_vaccination, V.type_name, IF(COUNT(I.date_of_infection)> 0 , 'YES', 'NO') AS 'Previously Infected ?'
from Person P
LEFT JOIN  Infection as I on P.SSN = I.SSN
inner join Postal_Code as PC on P.postal_code = PC.postal_code 
inner join Vaccination as V on P.SSN = V.SSN
GROUP BY P.SSN
having count(distinct V.type_name) >= 2;

SELECT * FROM Infection;
-- Query 14
select P.first_name, P.last_name, P.date_of_birth, P.email_address, P.telephone_number, PC.city, V.date_of_vaccination, V.type_name, count(I.date_of_infection)
from Person P
LEFT JOIN Infection as I on P.SSN = I.SSN
inner join Postal_Code as PC on P.postal_code = PC.postal_code 
inner join Vaccination as V on P.SSN = V.SSN
GROUP BY P.SSN
having count(distinct I.type_of_infection) >= 2;

-- Query 15
select PC.province_code, I.type_name, I.number_of_vaccines
from Inventory I
inner join Vaccination_Facility as VF on I.facility_name = VF.facility_name
inner join Postal_Code as PC on VF.postal_code = PC.postal_code
order by PC.province_code asc, I.number_of_vaccines desc;

-- Query 18
SELECT f.facility_name, f.address, f.facility_type, f.phone_number,
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
GROUP BY f.facility_name, i.type_name;

-- DUMMY DATA USED BY ARASH
INSERT INTO Age_Group VALUES (1, 80, 130);
INSERT INTO Age_Group VALUES (2, 70, 79);
INSERT INTO Age_Group VALUES (3, 60, 69);
INSERT INTO Age_Group VALUES (4, 60, 59);
INSERT INTO Age_Group VALUES (5, 40, 49);
INSERT INTO Age_Group VALUES(6,30,39);
INSERT INTO Age_Group VALUES(7,18,29);
INSERT INTO Age_Group VALUES(8,12,17);
INSERT INTO Age_Group VALUES(9,5,11);
INSERT INTO Age_Group VALUES(10,0,4);
INSERT INTO Province VALUES('QC',8);
INSERT INTO Province VALUES('ON',7);
INSERT INTO Postal_Code VALUES('G0R1T0', 'Montreal', 'QC');
INSERT INTO Postal_Code VALUES('G0A3J0', 'Montreal', 'QC');
INSERT INTO Postal_Code VALUES ('M4S1A4', 'Toronto', 'ON');
INSERT INTO Person VALUES('303395586','123456789', 'Roy', 'Wetmore', '1976-12-27', 'roy.wetmore@gmail.com', '4182452870', 'Canadian', '539 sherbrooke st.', 'G0A3J0');
INSERT INTO Person VALUES('575003660','123456788','Mary', 'Dillard', '1941-4-14', 'mary.dillard@hotmail.com', '4184386204', 'Canadian', '3105 ccool st.',  'G0A3J0');
INSERT INTO Vaccination_Facility VALUES ('University Of Toronto', 'School', 'https://www.utoronto.ca/', '6474799611', '35','G0A3J0');
INSERT INTO Vaccination_Facility VALUES ('Olympic Stadium', 'School', 'https://www.utoronto.ca/', '6474799611', '35','M4S1A4');
INSERT INTO Vaccine_Type VALUES ('Pfizer', 'SAFE', '2020-12-09', NULL);
INSERT INTO Vaccine_Type VALUES ('Moderna', 'SAFE', '2020-12-14', NULL);
INSERT INTO Vaccine_Type VALUES('Astrazeneca','SUSPENDED','2020-11-15','2021-02-26');
INSERT INTO Vaccine_Type  VALUES('Johnson & Johnson','SUSPENDED','2021-12-04', '2021-03-05');
INSERT INTO Inventory VALUES ('Olympic Stadium', 20, 'Pfizer');
INSERT INTO Inventory VALUES ('Olympic Stadium', 40, 'Moderna');

SELECT * FROM HealthCare_Worker;

INSERT INTO Vaccination VALUES (null,'555555555','Olympic Stadium','Pfizer',2,'2021-09-08','111111111');
INSERT INTO Vaccination VALUES (null,'555555555','Olympic Stadium','Moderna',1,'2021-08-08','111111111');
INSERT INTO Vaccination VALUES (null,'222222222','Olympic Stadium','Moderna',1,'2021-08-08','111111111');
       INSERT INTO Vaccination VALUES (null,'575003660','Olympic Stadium','Moderna',1,'2021-08-08','111111111');
     SELECt * FROM Vaccination; 


SELECT * FROM Inventory;
INSERT INTO Transfers VALUES (null,'University Of Toronto','Olympic Stadium','Pfizer',20,'2021-08-06');
SELECT * FROM Vaccination_Facility;
SELECT * FROM Postal_Code;
SELECT*FROM Vaccination_Facility, Postal_Code WHERE Vaccination_Facility.postal_code = Postal_Code.postal_code;
SELECT*FROM Inventory;
SELECT*FROM Shipment;
SELECT*FROM Province;
DELETE FROM Inventory;
DELETE FROM Shipment;
DELETE FROM Vaccination_Facility WHERE facility_name='Olympic Stadium';
SELECT * FROM Transfers;
DELETE FROM Transfers;
INSERT INTO Postal_Code  (postal_code, city, province_code) VALUES('G0A3J0', 'Toronto', 'ON')
ON DUPLICATE KEY UPDATE city='Toronto', province_code='ON';
DELETE FROM Postal_Code;

INSERT Into Infection VALUES('575003660','2021-09-09','Alpha');
INSERT Into Infection VALUES('575003660','2021-08-08','Delta');
INSERT Into Infection VALUES('222222222','2021-08-08','Delta');
INSERT Into Infection VALUES('222222222','2022-08-08','Delta');
Insert Into Infection_Type VALUES ('Delta');
Select * FROM Inventory;
SELECT * FROm Infection_Type;

SELECt * FROM Infection;
SELECT * FROM Vaccination;