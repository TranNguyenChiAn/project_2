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
insert into admins (name, email, password) values ('Tu Nguyen', 'tunguyen@gmail.com', '123456');
select * from admins;

create table genders(
	id INT auto_increment primary key,
    name VARCHAR(20) NOT NULL
);

insert into genders (name) values ('Male'), ('Female');
select * from genders;


create table specialization(
	id INT auto_increment primary key,
    name VARCHAR(255) NOT NULL
);

insert into specialization( name) Values 
('Rheumatology'), 
('Dermatology'), 
('Dentistry '),
('Cardiology'), 
('Ophthalmology'),
('Urology'), 
('Neurology');
select * from specialization;

insert into doctors (name, gender_id, email, password, specialization_id, contact_number) values
('Tran Canh Nguyen', 1, 'canhnguyen@gmail.com', '123456789', 3, '0987654321');

update doctors set gender_id = 1 where id = 6;

select * from doctors;
insert into doctors (name, gender_id, email, password, specialization_id, contact_number, address) 
values ('Name', 1, '123@gmail.com', '12jnskdjf', 3, '0897653421', 'HCM');

CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    gender_id INT NOT NULL,
	email TEXT UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    specialization_id INT NOT NULL,
    contact_number VARCHAR(15) UNIQUE NOT NULL,
    address TEXT NOT NULL,
    image text,
    foreign key (specialization_id) references specialization(id) ON DELETE CASCADE,
    foreign key (gender_id) references genders(id) ON DELETE CASCADE
);

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

drop table shifts;

select * from shifts;
SET SQL_SAFE_UPDATES = 0;
drop table shifts;

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
(1, 101),
(1, 102),
(1, 103),
(2, 201),
(2, 202),
(2, 203),
(3, 301),
(3, 302),
(3, 303);

update consulting_rooms set room = 202 where id = 5;

select * from consulting_rooms;

create table payment_method(
	id INT auto_increment primary key,
    name VARCHAR(100) NOT NULL
);
insert into payment_method (name) values ('Cash'), ('Banking'), ('Card'), ('VNPAY');


CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_id INT NOT NULL,
    admin_id INT NOT NULL,
    customer_name VARCHAR(255) NOT NULL,
    date_birth DATE NOT NULL,
    gender_id INT,
    date DATE NOT NULL,
    time TIME,
    room_id INT,
    status INT,
    payment_method INT,
    note TEXT,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE,
    foreign key (gender_id) references genders(id) ON delete cascade,
    FOREIGN KEY (room_id) REFERENCES consulting_rooms(id) ON DELETE CASCADE,
    FOREIGN KEY (payment_method) REFERENCES payment_method(id) ON DELETE CASCADE,
    foreign key (admin_id) references admins(id) ON DELETE CASCADE
);

ALTER TABLE appointments
ADD COLUMN phone VARCHAR(255) NOT NULL AFTER date_birth;

select doctors.*, shifts.start_time, shifts.end_time 
from doctors
join shifts on shifts.doctor_id = doctors.id;

select * from appointments;



