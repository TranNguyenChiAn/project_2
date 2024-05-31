create database project2;
use project2;
drop database project2;

create table admins(
	id INT auto_increment,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL unique,
    password VARCHAR(255) NOT NULL,
    primary key(id)
);
select * from admins;

create table genders(
	id INT auto_increment primary key,
    name VARCHAR(20) NOT NULL
);
insert into genders (name) values ('Male'), ('Female');
select * from genders;


create table departments(
	id INT auto_increment primary key,
    name VARCHAR(255) NOT NULL
);

insert into departments( name) Values 
('Rheumatology'), 
('Dermatology'), 
('Dentistry '),
('Cardiology'), 
('Ophthalmology'),
('Urology'), 
('Neurology');


CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    gender_id INT NOT NULL,
	email TEXT UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    department_id INT NOT NULL,
    contact_number VARCHAR(15) UNIQUE NOT NULL,
    address TEXT NOT NULL,
    image text,
    status INT,
    foreign key (department_id) references departments(id) ON DELETE CASCADE,
    foreign key (gender_id) references genders(id) ON DELETE CASCADE
);

alter table doctors add column status INT;
update doctors set status = 0;

select * from doctors;

create table shifts(
	id INT auto_increment primary key,
    start_time TIME NOT NULL,
    end_time TIME NOT NULL
);

create table shift_details (
	id INT NOT NULL auto_increment,
    doctor_id INT NOT NULL,
    shift_id INT NOT NULL,
    primary key(id, doctor_id, shift_id),
    foreign key (doctor_id) references doctors(id),
    foreign key (shift_id) references shifts(id)
);

select * from shift_details;
select * from shifts;

SET SQL_SAFE_UPDATES = 0;


create table customers(
	id INT auto_increment primary key,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL unique,
    phone VARCHAR(10),
    address TEXT,
    password VARCHAR(255) NOT NULL
);
select * from customers;

create table consulting_rooms(
	id INT auto_increment,
    floor INT NOT NULL,
    room INT NOT NULL,
    primary key(id)
);

insert into consulting_rooms ( floor,  room ) Values 
(0, 0),
(1, 101),
(1, 102),
(1, 103),
(2, 201),
(2, 202),
(2, 203),
(3, 301),
(3, 302),
(3, 303);
select * from consulting_rooms;

create table payment_method(
	id INT auto_increment primary key,
    name VARCHAR(100) NOT NULL
);
insert into payment_method (name) values ('Cash'), ('Banking'), ('Card'), ('VNPAY');
select * from payment_method;

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_id INT NOT NULL,
    customer_id INT,
    customer_name VARCHAR(255) NOT NULL,
    date_birth DATE NOT NULL,
    gender_id INT NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    phone VARCHAR(10) NOT NULL,
    room_id INT NOT NULL,
    status INT NOT NULL,
    payment_method INT,
    customer_note TEXT,
    update_by INT,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE,
    foreign key (gender_id) references genders(id) ON delete cascade,
    FOREIGN KEY (room_id) REFERENCES consulting_rooms(id) ON DELETE CASCADE,
    FOREIGN KEY (payment_method) REFERENCES payment_method(id) ON DELETE CASCADE,
    foreign key (update_by) references admins(id) ON DELETE CASCADE,
    foreign key (customer_id) references customers(id) ON DELETE CASCADE
);


alter table appointments change note customer_notes TEXT;
alter table appointments add column doctor_notes TEXT;
alter table appointments add column payment_status INT;

update appointments set fee_status = 1;
update appointments set approval_status = 1 where id = 19;

update appointments set payment_status = 0;

set sql_safe_updates = 0;

select * from appointments;


select doctors.*, shifts.start_time, shifts.end_time 
from doctors
join shifts on shifts.doctor_id = doctors.id;

select * from appointments;



