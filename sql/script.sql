/*-------FILE ONLY FOR REFERENCE, NOT USED IN THE CODE--------*/

/*---------------------------------------------------
  -------------------Creating Tables----------------- 
  ---------------------------------------------------*/

CREATE TABLE Postal_Code (
    postal_code CHAR(6) NOT NULL,
	city VARCHAR(30) NOT NULL,
	province CHAR(2) NOT NULL,

    PRIMARY KEY (postal_code)
);

CREATE TABLE Person (
	-- general info
    SSN CHAR(9) NOT NULL,
    medicare CHAR(9),
    first_name VARCHAR(30),
	last_name VARCHAR(30),
    date_of_birth DATE NOT NULL,
	email_address CHAR(30) DEFAULT 'unknown',
    telephone_number CHAR(30) DEFAULT 'unknown',    
	citizenship CHAR(30) NOT NULL,
    
    -- address info
    address VARCHAR(255) NOT NULL,
    postal_code CHAR(6),
    
    FOREIGN KEY (postal_code) REFERENCES Postal_Code(postal_code),
    PRIMARY KEY (SSN)
);

CREATE TABLE Infection (
    SSN CHAR(9) NOT NULL,
    date_of_infection DATE NOT NULL,    
    type_of_infection VARCHAR(30) NOT NULL,
    
    FOREIGN KEY (SSN) REFERENCES Person(SSN),
    PRIMARY KEY(SSN, date_of_infection)
);

CREATE TABLE HealthCare_Worker(
    SSN CHAR(9),
    EID CHAR(9) NOT NULL,

    FOREIGN KEY(SSN) REFERENCES Person(SSN),
    PRIMARY KEY(SSN)
    );

-- Entity Age Group
CREATE TABLE Age_Group (
    group_id INTEGER,
    min_age INTEGER,
    max_age INTEGER,
    PRIMARY KEY (group_id)
);

-- current eligible age group
CREATE TABLE Current_Eligible_Group( 
    eligible_group_id INTEGER,
    province CHAR(2) NOT NULL,
    
    FOREIGN KEY (eligible_group_id) REFERENCES Age_Group(group_id),
    PRIMARY KEY (province)
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
    
    FOREIGN KEY (postal_code) REFERENCES Postal_Code(postal_code),
    PRIMARY KEY (facility_name)
);

-- Works_At relation
CREATE TABLE Works_At(
    SSN CHAR(9),
    facility_name VARCHAR(30),
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    
    FOREIGN KEY (SSN) REFERENCES HealthCare_Worker(SSN),
    FOREIGN KEY (facility_name) REFERENCES Vaccination_Facility(facility_name),
    PRIMARY KEY (SSN, facility_name, start_date)
);

-- Manages relation
CREATE TABLE Manages(
    SSN CHAR(9),
    facility_name VARCHAR(30),
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    
    FOREIGN KEY (SSN) REFERENCES HealthCare_Worker(SSN),
    FOREIGN KEY (facility_name) REFERENCES Vaccination_Facility(facility_name),
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
    
    FOREIGN KEY (Employee_SSN) REFERENCES HealthCare_Worker(SSN),
    FOREIGN KEY (SSN) REFERENCES Person(SSN),
    FOREIGN KEY (facility_name) REFERENCES Vaccination_Facility(facility_name),
    FOREIGN KEY (type_name) REFERENCES Vaccine_Type(type_name),
    PRIMARY KEY (vaccination_id)
);

-- Inventory Entity 
CREATE TABLE Inventory(
    facility_name VARCHAR(30),
    number_of_vaccines int NOT NULL,
    type_name VARCHAR(30),

    FOREIGN KEY (type_name) REFERENCES Vaccine_Type(type_name),
    FOREIGN KEY (facility_name) REFERENCES Vaccination_Facility(facility_name),
    PRIMARY KEY (facility_name, type_name)
);

CREATE TABLE Shipment(
    shipment_ID INTEGER NOT NULL AUTO_INCREMENT,
    type_name VARCHAR(30),
    number_of_vaccines INT NOT NULL,
    date_of_transfer DATE NOT NULL,
    facility_name VARCHAR(30),

    FOREIGN KEY (type_name) REFERENCES Vaccine_Type(type_name),
    FOREIGN KEY (facility_name) REFERENCES Vaccination_Facility(facility_name),
    PRIMARY KEY (shipment_ID)
);

CREATE TABLE Transfers(
    transfer_ID INTEGER NOT NULL AUTO_INCREMENT,
    transfer_in VARCHAR(30),
    transfer_out VARCHAR(30),
    vaccine_type VARCHAR(30),
    number_of_vaccines INT NOT NULL,
    date_of_transfer DATE NOT NULL,

    FOREIGN KEY (vaccine_type) REFERENCES Vaccine_Type(type_name),
    FOREIGN KEY (transfer_in) REFERENCES Vaccination_Facility(facility_name),
    FOREIGN KEY (transfer_out) REFERENCES Vaccination_Facility(facility_name),

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
DROP TABLE Current_Eligible_Group;
DROP TABLE Age_Group;
DROP TABLE HealthCare_Worker;
DROP TABLE Infection;
DROP TABLE Person;
DROP TABLE Postal_Code;

/*---------------------------------------------------
  -----------------------Queries---------------------
  ---------------------------------------------------*/

-- Query 9
DELIMITER //
CREATE TRIGGER shipment_update
BEFORE INSERT ON Shipment FOR EACH ROW
BEGIN 

    UPDATE Inventory
    SET Inventory.number_of_vaccines = Inventory.number_of_vaccines + New.number_of_vaccines
    WHERE Inventory.facility_name = New.facility_name AND Inventory.type_name = New.type_name;
END//
DELIMITER ;

DROP TRIGGER shipment_update;

 -- QUERY 10 
 
DELIMITER //
CREATE TRIGGER transfer_update
BEFORE INSERT ON Transfers FOR EACH ROW
	BEGIN 

		IF ((SELECT Inventory.number_of_vaccines FROM Inventory WHERE (Inventory.facility_name = New.transfer_out) AND (Inventory.type_name = New.vaccine_type)) >= New.number_of_vaccines) THEN
			UPDATE Inventory
			SET Inventory.number_of_vaccines = Inventory.number_of_vaccines + New.number_of_vaccines 
			WHERE Inventory.facility_name = New.transfer_in AND Inventory.type_name = New.vaccine_type;
			
			UPDATE Inventory
			SET Inventory.number_of_vaccines = Inventory.number_of_vaccines - New.number_of_vaccines
			WHERE Inventory.facility_name = New.transfer_out AND Inventory.type_name = New.vaccine_type;
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
SELECT first_name, last_name, date_of_birth, email_address, telephone_number, city, date_of_vaccination, type_name, IF(COUNT(date_of_infection)> 0 , "YES", "NO") AS 'Previously Infected ?'
FROM Person, Postal_Code, Vaccination, Infection
WHERE 
Person.SSN = Vaccination.SSN AND
Person.postal_code = Postal_Code.postal_code AND
dose_number = 1 AND
(FLOOR(DATEDIFF(date_of_vaccination,date_of_birth)/365.25) >=60);

-- Query 13
select P.first_name, P.last_name, P.date_of_birth, P.email_address, P.telephone_number, PC.city, V.date_of_vaccination, V.type_name, I.date_of_infection, I.type_of_infection
from Person P
inner join Postal_Code as PC on P.postal_code = PC.postal_code 
inner join Infection as I on P.SSN = I.SSN
inner join Vaccination as V on P.SSN = V.SSN
where PC.city = 'Montreal'
having count(distinct V.type_name) >= 2;

-- Query 14
select P.first_name, P.last_name, P.date_of_birth, P.email_address, P.telephone_number, PC.city, V.date_of_vaccination, V.type_name, count(I.date_of_infection)
from Person P
inner join Postal_Code as PC on P.postal_code = PC.postal_code 
inner join Vaccination as V on P.SSN = V.SSN
inner join Infection as I on P.SSN = I.SSN
having count(distinct I.type_of_infection) >= 2;

-- Query 15
select PC.province, I.type_name, I.number_of_vaccines
from Inventory I
inner join Vaccination_Facility as VF on I.facility_name = VF.facility_name
inner join Postal_Code as PC on VF.postal_code = PC.postal_code
group by PC.province
order by PC.province asc, I.number_of_vaccines desc;






-- DUMMY DATA
INSERT INTO Postal_Code VALUES('G0R1T0', 'Montreal', 'QC');
INSERT INTO Postal_Code VALUES('G0A3J0', 'Montreal', 'QC');
INSERT INTO Postal_Code VALUES ('M4S1A4', 'Toronto', 'ON');
INSERT INTO Person VALUES('303395586','123456789', 'Roy', 'Wetmore', '1976-12-27', 'roy.wetmore@gmail.com', '4182452870', 'Canadian', '539 sherbrooke st.', 'G0R1T0');
INSERT INTO Person VALUES('575003660','123456788','Mary', 'Dillard', '1941-4-14', 'mary.dillard@hotmail.com', '4184386204', 'Canadian', '3105 ccool st.',  'G0A3J0');
INSERT INTO Vaccination_Facility VALUES ('University Of Toronto', 'School', 'https://www.utoronto.ca/', '6474799611', '35','M4S1A4');
INSERT INTO Vaccination_Facility VALUES ('Olympic Stadium', 'School', 'https://www.utoronto.ca/', '6474799611', '35','M4S1A4');
INSERT INTO Inventory VALUES ('Olympic Stadium', 20, 'Pfizer');
INSERT INTO Inventory VALUES ('Olympic Stadium', 40, 'Moderna');
INSERT INTO Vaccine_Type VALUES ('Pfizer', 'SAFE', '2020-12-09', NULL);
INSERT INTO Vaccine_Type VALUES ('Moderna', 'SAFE', '2020-12-14', NULL);
INSERT INTO Vaccine_Type VALUES('Astrazeneca','SUSPENDED','2020-11-15','2021-02-26');
INSERT INTO Vaccine_Type  VALUES('Johnson & Johnson','SUSPENDED','2021-12-04', '2021-03-05');