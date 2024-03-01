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

select * from customers;

create table genders(
	id INT auto_increment primary key,
    name VARCHAR(20) NOT NULL
);

insert into genders (name) values ('Female'), ('Male');

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

CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
	email TEXT NOT NULL,
    password VARCHAR(255) NOT NULL,
    specialization VARCHAR(255) NOT NULL,
    contact_number VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    image text,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- email, so dien thoai phai de unique

INSERT INTO doctors (name, email, password, specialization, contact_number, address, image) VALUES
('Nguyễn Văn An', 'ngvaanh@gmail.com', '123456','Chuyên môn Tim', '0901234567', 'TP.HCM', '#'),
('Trần Thị Bảo', 'trthbao@gmail.com', '123456','Chuyên môn Răng - Hàm Mặt', '0912345678', 'HN', '#'),
('Lê Văn Cương', 'levacuong@gmail.com', '123456','Chuyên môn Da liễu', '0923456789', 'HP', '#');

select * from doctors;

 

CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email TEXT NOT NULL,
    insurance_number VARCHAR(20),
    phone_number VARCHAR(15) NOT NULL,
    address TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);


INSERT INTO patients (name, email, insurance_number, phone_number, address) VALUES
('Nguyễn Thị Anh', 'ngthanh@gmail.com', 'BN12345', '0987654321', 'HP'),
('Trần Văn Bình', 'trvabinh@gmail.com', 'BN67890', '0976543210', 'HN'),
('Lê Thị Chi', 'lethchi@gmail.com','BN54321', '0965432109', 'TP.HCM');


CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    doctor_id INT NOT NULL,
    patient_id INT NOT NULL,
    appointment_time DATETIME NOT NULL,
    room_id INT NOT NULL,
    status ENUM('confirmed', 'pending', 'canceled') DEFAULT 'pending',
    note TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (doctor_id) REFERENCES doctors(id) ON DELETE CASCADE,
    FOREIGN KEY (patient_id) REFERENCES patients(id) ON DELETE CASCADE,
    FOREIGN KEY (room_id) REFERENCES consulting_rooms(id) ON DELETE CASCADE
);

INSERT INTO appointments (doctor_id, patient_id, appointment_time, room_id, status) VALUES
(1, 1, '2024-03-01 10:00:00', 2, 'confirmed'),
(2, 2, '2024-03-02 14:30:00', 3, 'pending'),
(3, 3, '2024-03-03 16:45:00', 5, 'canceled');



