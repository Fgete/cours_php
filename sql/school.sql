create database School;

use School;

/* --- USER --- */
create table User(
	LOGIN varchar(10) not null primary key,
	PASSWORD varchar(50) not null,
	LASTNAME varchar(50) not null,
	FIRSTNAME varchar(50) not null,
	ROLE varchar(10) not null -- Student / Professor
) engine = InnoDB;

/* --- STUDENT --- */
create table Student(
	LOGIN varchar(10) not null primary key,
	LASTNAME varchar(50) not null,
	FIRSTNAME varchar(50) not null
) engine = InnoDB;

/* --- PROFESSOR --- */
create table Professor(
	LOGIN varchar(10) not null primary key,
	LASTNAME varchar(50) not null,
	FIRSTNAME varchar(50) not null
) engine = InnoDB;

-- A user has only one role
alter table `Student` add foreign key (`LOGIN`) references `User` (`LOGIN`);
alter table `Professor` add foreign key (`LOGIN`) references `User` (`LOGIN`);

/*
-- Set into Student
insert into Student
select LOGIN, LASTNAME, FIRSTNAME
from User
where ROLE="Student";

-- Set into Professor
insert into Professor
select LOGIN, LASTNAME, FIRSTNAME
from User
where ROLE="Professor";
*/

/* --- MATTER --- */
create table Matter(
	MATTER_NAME varchar(50) not null primary key,
	PROF varchar(50) not null
) engine = InnoDB;

-- A matter has a professor
alter table `Matter` add foreign key (`PROF`) references `Professor` (`LOGIN`);

/* --- MARK --- */
create table Mark(
	MATTER varchar(50) not null,
	STUDENT varchar(50) not null,
	PROFESSOR varchar(50) not null,
	MARK int(2) not null
) engine = InnoDB;

alter table `Mark` add foreign key (`MATTER`) references `Matter` (`MATTER_NAME`);
alter table `Mark` add foreign key (`PROFESSOR`) references `Professor` (`LOGIN`);
alter table `Mark` add foreign key (`STUDENT`) references `Student` (`LOGIN`);