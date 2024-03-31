create database project2;
use project2;

create table admins(
	id INT auto_increment,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL unique,
    password VARCHAR(255) NOT NULL,
    primary key(id)
);

insert into admins(name, email, password) values 
('Tu Nguyen', 'trantranchian@gmail.com', '123456'),
('Chi An', 'chiantrannguyen@gmail.com', '654321'),
('Hoang Vy', 'phanhoangvy@gmail.com', '654321'),
('Duong Minh', 'luuduongminh@gmail.com', '132654'),
('Thanh Hoang', 'lethanhhoang@gmail.com', '132654');

update admins set password = '123456' where id = 1;

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
('Xương khớp'), 
('Da liễu'), 
('Răng-Hàm-Mặt'), 
('Tai-Mũi-Họng'), 
('Tim'), 
('Tiết niệu'), 
('Thần kinh');

select * from specialization;

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
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    foreign key (specialization_id) references specialization(id) ON DELETE CASCADE,
    foreign key (gender_id) references genders(id) ON DELETE CASCADE
);

INSERT INTO doctors (name, gender_id, email, password, specialization_id, contact_number, address, image) VALUES
('Nguyễn Văn An', 1, 'ngvaanh@gmail.com', '123456', 1, '0901234567', 'TP.HCM', '#'),
('Trần Thị Bảo', 2, 'trthbao@gmail.com', '123456', 2, '0912345678', 'HN', '#'),
('Lê Văn Cương', 1, 'levacuong@gmail.com', '123456', 3, '0923456789', 'HP', '#');


create table customers(
	id INT auto_increment primary key,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(255) NOT NULL unique,
    phone VARCHAR(10),
    gender_id INT,
    address TEXT,
    password VARCHAR(255) NOT NULL,
    foreign key (gender_id) references genders(id) ON delete cascade
);

insert into customers(name, email, password, phone, gender_id, address) values 
('Bao Chau', 'nguyenbaochau@gmail.com', 'guess?', '0123456789', 2, 'TP.HCM'),
('Hoang Dung', 'phanhoangdung@gmail.com', 'clgtbaochau?', '0123456789', 1, 'TP.HCM'),
('Thanh Tu', 'caothanhtu@gmail.com', 'nghiemtuchotao', '0987654321', 2, 'TP.HCM'),
('Le Tien', 'tranletien@gmail.com', 'datpasskieugiday', '01679460283', 1, 'HN'),
('Tong Tran', 'tongtrankhonkho@gmail.com', 'conanancut', '0868888666', 1, 'HN');


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
(2, 102),
(2, 203),
(3, 301),
(3, 302),
(3, 303);

select * from genders;


CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    date_birth DATE NOT NULL,
    gender_id INT NOT NULL,
    insurance_number VARCHAR(20),
    phone_number VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (gender_id) references genders(id) ON DELETE CASCADE
);

select * from patients;

INSERT INTO patients (name, age, gender_id, insurance_number, phone_number, address) VALUES
('Nguyễn Thị Anh', '2012-04-23', 2, 'BN12345', '0987654321', 'HP'),
('Trần Văn Bình', '1992-12-12', 1, 'BN67890', '0976543210', 'HN'),
('Lê Thị Chi', '2009-02-09', 2, 'BN54321', '0965432109', 'TP.HCM');

update patients set date_birth = '2009-02-09' where id = 3;

CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_id INT NOT NULL,
    admin_id INT NOT NULL,
    patient_id INT NOT NULL,
    appointment_time DATETIME NOT NULL,
    room_id INT NOT NULL,
    status ENUM('confirmed', 'pending', 'canceled') DEFAULT 'pending',
    note TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES consulting_rooms(id) ON DELETE CASCADE,
    foreign key (admin_id) references admins(id) ON DELETE CASCADE
);

alter table appointments change room_id room_id INT;

select * from appointments;

alter table appointments drop column time;


select * from appointments;




