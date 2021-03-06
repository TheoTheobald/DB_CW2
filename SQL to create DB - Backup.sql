DROP TABLE IF EXISTS Vehicle;
CREATE TABLE Vehicle (
Vehicle_ID int(11) NOT NULL,
Vehicle_License varchar(10) NOT NULL,
Vehicle_Type varchar(30),
Vehicle_Colour varchar(10)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO Vehicle (Vehicle_ID, Vehicle_License, Vehicle_Type, Vehicle_Colour) VALUES
(12, 'LB15AJL', 'Ford Fiesta', 'Blue'),
(13, 'MY64PRE', 'Ferrari 458', 'Red'),
(14, 'FD65WPQ', 'Vauxhall Astra', 'Silver'),
(15, 'FJ17AUG', 'Honda Civic', 'Green'),
(16, 'FP16KKE', 'Toyota Prius', 'Silver'),
(17, 'FP66KLM', 'Ford Mondeo', 'Black'),
(18, 'DJ14SLE', 'Ford Focus', 'White'),
(20, 'NY64KWD', 'Nissan Pulsar', 'Red'),
(21, 'BC16OEA', 'Renault Scenic', 'Silver'),
(22, 'AD223NG', 'Hyundai i30', 'Grey');

DROP TABLE IF EXISTS Incident;
CREATE TABLE Incident (
Incident_ID int(11) NOT NULL,
Officer_ID int(11) NOT NULL,
Person_ID int(11) NOT NULL,
Vehicle_ID int(11),
Offence_ID int(11) NOT NULL,
Incident_Fine_Amount int(11) DEFAULT 0,
Incident_Points_Awarded int(11) DEFAULT 0,
Incident_Date datetime,
Incident_Statement varchar(300)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO Incident (Incident_ID, Officer_ID, Person_ID, Vehicle_ID, Offence_ID, Incident_Fine_Amount, Incident_Points_Awarded, Incident_Date, Incident_Statement) VALUES
(1, 57, 4, 15, 1, 0, 0, '2017-12-01', '40mph in a 30 limit'),
(2, 57, 8, 20, 4, 50, 2, '2017-11-01', 'Double parked'),
(3, 58, 4, 13, 1, 2000, 6, '2017-09-17', '110mph on motorway'),
(4, 58, 2, 14, 8, 500, 3, '2017-08-22', 'Failure to stop at a red light - travelling 25mph'),
(5, 55, 4, 13, 3, 0, 0, '2017-10-17', 'Not wearing a seatbelt on the M1');

DROP TABLE IF EXISTS Person;
CREATE TABLE Person (
Person_ID int(11) NOT NULL,
Person_Name varchar(50) NOT NULL,
Person_License_No varchar(16),
Person_Address varchar(75),
Person_DOB DATE,
Person_Points int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO Person (Person_ID, Person_Name, Person_License_No, Person_Address, Person_DOB, Person_Points) VALUES
(1,	'James Smith', 'SMITH92LDOFJJ829', '23 Barnsdale Road, Leicester', '1996-09-23',0),
(2,	'Jennifer Allen', 'ALLEN88K23KLR9B3', '46 Bramcote Drive, Nottingham', '1981-07-19', 3),
(3,	'John Myers', 'MYERS99JDW8REWL3', '323 Derby Road, Nottingham', '1989-01-19', 0),
(4,	'James Smith', 'SMITHR004JFS20TR', '26 Devonshire Avenue, Nottingham', '2001-11-07', 6),
(5,	'Terry Brown', 'BROWND3PJJ39DLFG', '7 Clarke Rd, Nottingham', '1993-02-11', 0),
(6,	'Mary Adams', 'ADAMSH9O3JRHH107', '38 Thurman St, Nottingham', '1952-12-04', 0),
(7,	'Neil Becker', 'BECKE88UPR840F9R', '6 Fairfax Close, Nottingham', '1960-12-05', 0),
(8,	'Angela Smith', 'SMITH222LE9FJ5DS', '30 Avenue Road, Grantham', '1995-04-30', 2),
(9,	'Xene Medora', 'MEDORH914ANBB223', '22 House Drive, West Bridgford', '1974-06-01', 0);

DROP TABLE IF EXISTS Offence;
CREATE TABLE Offence (
Offence_ID int(11) NOT NULL,
Offence_Description varchar(100) NOT NULL,
Offence_Max_Fine int(11) NOT NULL,
Offence_Max_Points int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO Offence (Offence_ID, Offence_Description, Offence_Max_Fine, Offence_Max_Points) VALUES
(1, 'Speeding', 1000, 3),
(2, 'Speeding on a motorway', 2500, 6),
(3, 'Seat belt offence', 500, 0),
(4, 'Illegal parking', 500, 0),
(5, 'Drink driving', 10000, 11),
(6, 'Driving without a licence', 10000, 0),
(7, 'Traffic light offences', 1000, 3),
(8, 'Cycling on pavement', 500, 0),
(9, 'Failure to have control of vehicle', 1000, 3),
(10, 'Dangerous driving', 1000, 11),
(11, 'Careless driving', 5000, 6),
(12, 'Dangerous cycling', 2500, 0);

DROP TABLE IF EXISTS Officer;
CREATE TABLE Officer (
Officer_ID int(11) NOT NULL,
Officer_Name varchar(50) NOT NULL,
Officer_DOB DATE,
Officer_Username varchar(40) NOT NULL,
Officer_Password varchar(40) NOT NULL,
Officer_Type int(2) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO Officer (Officer_ID, Officer_Name, Officer_DOB, Officer_Username, Officer_Password, Officer_Type) VALUES
(55, 'Terrance Truffle', '1948-12-25', 'bonus_login', 'terriblePassword', 1),
(56, 'Adam Inistrator', '1970-01-01', 'Daniels', 'copper99', 2),
(57, 'Rudolph McNulty', '1870-10-30', 'McNulty', 'plod123', 1),
(58, 'Ineed Moreland', '1912-12-12', 'Moreland', 'fuzz42', 1);

DROP TABLE IF EXISTS Ownership;
CREATE TABLE Ownership (
Person_ID int(11) NOT NULL,
Vehicle_ID int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO Ownership (Person_ID, Vehicle_ID) VALUES
(3, 12),
(8, 20),
(4, 15),
(4, 13),
(1, 16),
(2, 14),
(5, 17),
(6, 18),
(7, 21);


ALTER TABLE Vehicle
  ADD PRIMARY KEY (Vehicle_ID);
  
ALTER TABLE Incident
  ADD PRIMARY KEY (Incident_ID),
  ADD KEY fk_incident_officer (Officer_ID),
  ADD KEY fk_incident_person (Person_ID),
  ADD KEY fk_incident_vehicle (Vehicle_ID),
  ADD KEY fk_incident_offence (Offence_ID);

ALTER TABLE Person
  ADD PRIMARY KEY (Person_ID);
  
ALTER TABLE Offence
  ADD PRIMARY KEY (Offence_ID);

ALTER TABLE Officer
  ADD PRIMARY KEY (Officer_ID);

ALTER TABLE Ownership
  ADD KEY fk_person (Person_ID),
  ADD KEY fk_vehicle (Vehicle_ID);


ALTER TABLE Vehicle
  MODIFY Vehicle_ID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
  
ALTER TABLE Incident
  MODIFY Incident_ID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
  
ALTER TABLE Person
  MODIFY Person_ID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
  
ALTER TABLE Offence
  MODIFY Offence_ID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
  
ALTER TABLE Officer
  MODIFY Officer_ID int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

ALTER TABLE Incident
  ADD CONSTRAINT fk_incident_offence FOREIGN KEY (Offence_ID) REFERENCES Offence (Offence_ID),
  ADD CONSTRAINT fk_incident_person FOREIGN KEY (Person_ID) REFERENCES Person (Person_ID),
  ADD CONSTRAINT fk_incident_vehicle FOREIGN KEY (Vehicle_ID) REFERENCES Vehicle (Vehicle_ID);

ALTER TABLE Ownership
  ADD CONSTRAINT fk_person FOREIGN KEY (Person_ID) REFERENCES Person (Person_ID),
  ADD CONSTRAINT fk_vehicle FOREIGN KEY (Vehicle_ID) REFERENCES Vehicle (Vehicle_ID);
