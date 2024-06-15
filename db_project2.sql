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
('Dentistry'),
('Cardiology'), 
('Ophthalmology'),
('Urology'), 
('Neurology');
select * from departments;

create table consulting_rooms(
	id INT auto_increment,
    floor INT NOT NULL,
    room_name varchar(255) NOT NULL,
    primary key(id)
);

insert into consulting_rooms ( floor,  room_name ) Values 
(1,'Rheumatology 1'), 
(1, 'Rheumatology 2'), 
(1, 'Dermatology 1'), 
(1, 'Dermatology 2'), 
(2, 'Dentistry 1'),
(2, 'Dentistry 2'),
(2, 'Cardiology 1'), 
(2, 'Cardiology 2'), 
(3, 'Ophthalmology 1'),
(3, 'Ophthalmology 2'),
(3, 'Urology 1'), 
(3, 'Urology 2'), 
(4, 'Neurology 1'),
(4, 'Neurology 2');

select * from consulting_rooms;

CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    gender_id INT NOT NULL,
	email TEXT UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    department_id INT NOT NULL,
    contact_number VARCHAR(15) UNIQUE NOT NULL,
    room_id INT,
    address TEXT NOT NULL,
    image text,
    status int NOT NULL,
    status INT,
    foreign key (department_id) references departments(id) ON DELETE CASCADE,
    foreign key (gender_id) references genders(id) ON DELETE CASCADE,
    foreign key (room_id) references rooms(id) ON DELETE CASCADE
);
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
    status INT,
    password VARCHAR(255) NOT NULL
);
select * from customers;

alter table customers add column status INT;


update customers set status = 0;

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
    status INT NOT NULL,
    payment_method INT,
    payment_status INT,
    customer_note TEXT,
    update_by INT,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE,
    foreign key (gender_id) references genders(id) ON delete cascade,
    FOREIGN KEY (room_id) REFERENCES consulting_rooms(id) ON DELETE CASCADE,
    FOREIGN KEY (payment_method) REFERENCES payment_method(id) ON DELETE CASCADE,
    foreign key (update_by) references admins(id) ON DELETE CASCADE,
    foreign key (customer_id) references customers(id) ON DELETE CASCADE
);


delete from appointments where id = 78;

alter table appointments change created_id created_at timestamp;
alter table appointments add column doctor_notes TEXT;
alter table appointments add column payment_status INT;
alter table appointments add column created_id timestamp;

alter table appointments drop column room_id;
SET FOREIGN_KEY_CHECKS=0;

update appointments set approval_status = 1 where id = 76;

update appointments set appointment_status = 1 where id = 76;

set sql_safe_updates = 0;

select * from appointments;

select * from appointments where payment_status = 2;

select doctors.name as doctor_name, doctors.department_id, departments.name, shifts.start_time, shifts.end_time
from shift_details
join shifts on shift_details.shift_id = shifts.id
join doctors on shift_details.doctor_id = doctors.id
join departments on departments.id = doctors.department_id;

SELECT * FROM appointments WHERE date = '2024-31-05' AND doctor_id = 5;

select * from customers;



