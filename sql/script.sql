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
    FOREIGN KEY (eligible_group_id) REFERENCES Age_Group(group_id) ON DELETE CASCADE,
    PRIMARY KEY (province_code)
);

CREATE TABLE Postal_Code (
    postal_code CHAR(6) NOT NULL,
	city VARCHAR(30) NOT NULL,
	province_code CHAR(2) NOT NULL,
    FOREIGN KEY (province_code) REFERENCES Province(province_code) ON DELETE CASCADE,
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
    FOREIGN KEY (type_of_infection) REFERENCES Infection_Type(type_of_infection),
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
    
    -- information about this vaccination instance
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
                
                UPDATE Inventory
				SET Inventory.number_of_vaccines = Inventory.number_of_vaccines - New.number_of_vaccines
				WHERE Inventory.facility_name = New.transfer_out AND Inventory.type_name = New.vaccine_type;
                
			ELSE
				SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'The sending Facility doesnt have an inventory of the SELECTed vaccine!';

            
		END IF;
		
	END//

DELIMITER ;
DROP TRIGGER transfer_update;    

-- QUERY 11 
DELIMITER //
CREATE TRIGGER Vaccination_update
BEFORE INSERT ON Vaccination FOR EACH ROW
BEGIN 

	IF ((SELECT Person.SSN
FROM Person,Age_Group ,Province, Vaccination_Facility , Postal_Code
WHERE Person.SSN = new.SSN AND
Vaccination_Facility.postal_code = Postal_Code.postal_code AND
Province.province_code = Postal_Code.province_code AND
Province.eligible_group_id = Age_Group.group_id AND
Vaccination_Facility.facility_name = new.facility_name AND
(FLOOR(DATEDIFF(new.date_of_vaccination,date_of_birth)/365.25) >= min_age))AND
(EXISTS(SELECT facility_name, type_name FROM Inventory WHERE Inventory.facility_name = NEW.facility_name AND type_name = NEW.type_name AND number_of_vaccines >0)))
            
            
            THEN
            

    UPDATE Inventory
    SET Inventory.number_of_vaccines = Inventory.number_of_vaccines - 1
    WHERE Inventory.facility_name = New.facility_name AND Inventory.type_name = New.type_name;
    
    ELSE
    
		SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Person is too young to be vaccinated in this province!';

    
	END if;
    
END//    
DELIMITER ;

DROP TRIGGER Vaccination_update;

-- Query 12
SELECT P.SSN, P.first_name, P.last_name, P.date_of_birth, P.email_address, P.telephone_number, Pc.city, date_of_vaccination, type_name, IF(COUNT(I.date_of_infection)> 0 , 'YES', 'NO') AS 'Previously Infected ?'
                                 FROM Person P
                                 LEFT JOIN Infection as I on P.SSN = I.SSN
                                 INNER JOIN Postal_Code as Pc on P.postal_code = Pc.postal_code
                                 INNER JOIN Vaccination as V on P.SSN = V.SSN
                                 WHERE
                                 dose_number = 1 AND
                                 P.SSN NOT IN(SELECT Person.SSN FROM Person,Vaccination WHERE Person.SSN = Vaccination.SSN AND dose_number =2) AND
                                 (FLOOR(DATEDIFF(date_of_vaccination,date_of_birth)/365.25) >=60)
                                 GROUP BY P.SSN;
                                 
-- Query 13
SELECT P.first_name, P.last_name, P.date_of_birth, P.email_address, P.telephone_number, PC.city, V.date_of_vaccination, V.type_name, IF(COUNT(I.date_of_infection)> 0 , 'YES', 'NO') AS 'Previously Infected ?'
FROM Person P
LEFT JOIN  Infection as I on P.SSN = I.SSN
INNER JOIN Postal_Code as PC on P.postal_code = PC.postal_code 
INNER JOIN Vaccination as V on P.SSN = V.SSN
WHERE PC.city = 'Montreal'
GROUP BY P.SSN
having count(distinct V.type_name) >= 2;


-- Query 14
SELECT P.first_name, P.last_name, P.date_of_birth, P.email_address, P.telephone_number, PC.city, V.date_of_vaccination, V.type_name, count(I.date_of_infection)
FROM Person P
LEFT JOIN Infection as I on P.SSN = I.SSN
INNER JOIN Postal_Code as PC on P.postal_code = PC.postal_code 
INNER JOIN Vaccination as V on P.SSN = V.SSN
GROUP BY P.SSN
having count(distinct I.type_of_infection) >= 2;

-- Query 15
SELECT PC.province_code, I.type_name, SUM(I.number_of_vaccines)
FROM Inventory I
INNER JOIN Vaccination_Facility as VF on I.facility_name = VF.facility_name
INNER JOIN Postal_Code as PC on VF.postal_code = PC.postal_code
GROUP BY PC.province_code, I.type_name
ORDER BY PC.province_code asc, I.number_of_vaccines desc;

-- QUERY 16
SELECT Postal_Code.province_code, Vaccine_Type.type_name, COUNT(DISTINCT Vaccination.SSN) AS 'COUNT'
FROM Postal_Code, Vaccine_Type, Vaccination, Vaccination_Facility
WHERE Vaccination.date_of_vaccination>='2021-01-01' AND Vaccination.date_of_vaccination<='2021-07-22'
AND Vaccine_Type.type_name=Vaccination.type_name AND Vaccination.facility_name=Vaccination_Facility.facility_name
AND Vaccination_Facility.postal_code=Postal_Code.postal_code
GROUP BY Postal_Code.province_code, Vaccine_Type.type_name
ORDER BY Postal_Code.province_code asc, Vaccine_Type.type_name asc;

-- QUERY 17
SELECT city, SUM(number_of_vaccines) AS `num_vaccines` 
FROM Shipment s, Vaccination_Facility f, Postal_Code pc
WHERE s.facility_name = f.facility_name AND f.postal_code = pc.postal_code 
AND pc.province_code = 'QC'
AND s.date_of_transfer BETWEEN CAST('2021-1-01' AS DATE) AND CAST('2021-7-22' AS DATE)
GROUP BY city;

-- QUERY 18
SELECT f.facility_name, f.address, f.facility_type, f.phone_number,
(SELECT COUNT(SSN) FROM Works_At WHERE (end_date IS NULL or end_date >curdate()) AND facility_name = f.facility_name) AS `num_workers`,
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
GROUP BY f.facility_name, i.type_name;

-- QUERY 19
SELECT WA.facility_name, HCW.EID, HCW.SSN, Person.first_name, last_name, date_of_birth, medicare, 
telephone_number, address, PC.city, province_code, PC.postal_code, Person.citizenship, email_address, 
WA.start_date, end_date
FROM HealthCare_Worker HCW, Person, Postal_Code PC, Works_At WA
WHERE WA.SSN=HCW.SSN and HCW.SSN=Person.SSN and Person.postal_code=PC.postal_code and WA.facility_name = 'Petersen Orchard Hospital' AND (end_date IS NULL or end_date >curdate())
GROUP BY WA.facility_name, HCW.EID
ORDER BY WA.facility_name asc, HCW.EID asc;

-- QUERY 20
SELECT HCW.EID, P.first_name, P.last_name, P.date_of_birth, P.telephone_number, PC.city,
P.email_address, WA.facility_name
FROM Person P
LEFT JOIN Vaccination AS V on P.SSN = V.SSN
INNER JOIN Works_At as WA on P.SSN = WA.SSN
INNER JOIN HealthCare_Worker AS HCW on HCW.SSN = WA.SSN
INNER JOIN  Postal_Code AS PC on P.postal_code = PC.postal_code
WHERE (end_date IS NULL OR end_date >curdate()) AND PC.province_code ='QC'
GROUP BY HCW.EID
HAVING COUNT(V.SSN)<=1
ORDER BY HCW.EID asc;