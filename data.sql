
CREATE DATABASE IF NOT EXISTS voting_db;
USE voting_db;

CREATE TABLE IF NOT EXISTS voters (
    id INT AUTO_INCREMENT PRIMARY KEY,
    voter_name VARCHAR(100) NOT NULL,
    voter_address TEXT NOT NULL,
    date_of_birth DATE NOT NULL,
    mobile_number VARCHAR(15) NOT NULL UNIQUE,
    aadhar_number VARCHAR(64) NOT NULL UNIQUE, 
    password VARCHAR(255) NOT NULL 
);


INSERT INTO voters (voter_name, voter_address, date_of_birth, mobile_number, aadhar_number, password) VALUES
('Amit Sharma', 'Delhi, India', '1985-02-15', '9876543210', SHA2('123456789012', 256), SHA2('pass123', 256)),
('Priya Singh', 'Mumbai, India', '1992-07-22', '9876543211', SHA2('234567890123', 256), SHA2('secure456', 256)),
('Raj Patel', 'Ahmedabad, India', '1988-11-05', '9876543212', SHA2('345678901234', 256), SHA2('raj789', 256)),
('Neha Verma', 'Bangalore, India', '1995-04-18', '9876543213', SHA2('456789012345', 256), SHA2('neha2021', 256)),
('Vikram Joshi', 'Chennai, India', '1982-09-30', '9876543214', SHA2('567890123456', 256), SHA2('vikramXyz', 256)),
('Sanjay Kumar', 'Hyderabad, India', '1987-12-10', '9876543215', SHA2('678901234567', 256), SHA2('sanjay007', 256)),
('Deepika Mehta', 'Pune, India', '1990-06-25', '9876543216', SHA2('789012345678', 256), SHA2('deepika567', 256)),
('Rahul Choudhary', 'Jaipur, India', '1983-08-12', '9876543217', SHA2('890123456789', 256), SHA2('rahul@123', 256)),
('Anjali Kapoor', 'Kolkata, India', '1996-03-05', '9876543218', SHA2('901234567890', 256), SHA2('anjali!456', 256)),
('Ravi Shankar', 'Lucknow, India', '1991-05-14', '9876543219', SHA2('012345678901', 256), SHA2('ravi_789', 256)),
('khushi bansal', 'meerut, India', '2003-04-03', '7983425459', SHA2('123456789812', 256), SHA2('kbansal03',256));

