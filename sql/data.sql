CREATE TABLE user_accounts (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255),
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	password TEXT,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE job_applicants (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(255),
    phone_number VARCHAR(20),
    address VARCHAR(255),
    city VARCHAR(100),
    state VARCHAR(100),
    country VARCHAR(100),
    job_position VARCHAR(255),
    date_applied TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE activity_logs (
	activity_log_id INT AUTO_INCREMENT PRIMARY KEY,
	operation VARCHAR(255),
	applicant_id INT,
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	email VARCHAR (255),
    phone_number VARCHAR (255),
    address VARCHAR (255),
    city VARCHAR (255),
    state VARCHAR (255),
    country VARCHAR (255),
    job_position VARCHAR (255),
	username VARCHAR(255),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE search_activity_logs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    search_query VARCHAR(255),
    username VARCHAR(100),
    timestamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


INSERT INTO job_applicants (first_name, last_name, email, phone_number, address, city, state, country, job_position)
VALUES 
('Alice', 'Johnson', 'alice.johnson@example.com', '1239874560', '789 Pine St', 'Chicago', 'IL', 'USA', 'Registered Nurse'),
('Bob', 'Williams', 'bob.williams@example.com', '4563217890', '321 Elm St', 'Houston', 'TX', 'USA', 'Physical Therapist'),
('Charlie', 'Brown', 'charlie.brown@example.com', '9876543210', '654 Maple St', 'Phoenix', 'AZ', 'USA', 'Medical Assistant'),
('David', 'Jones', 'david.jones@example.com', '3216549870', '987 Birch St', 'Seattle', 'WA', 'USA', 'Clinical Research Coordinator'),
('Eva', 'Davis', 'eva.davis@example.com', '1357924680', '123 Cedar St', 'Austin', 'TX', 'USA', 'Pharmacy Technician'),
('Frank', 'Miller', 'frank.miller@example.com', '2468013579', '456 Redwood St', 'Denver', 'CO', 'USA', 'Radiologic Technologist'),
('Grace', 'Martinez', 'grace.martinez@example.com', '5678901234', '789 Willow St', 'Miami', 'FL', 'USA', 'Nurse Practitioner'),
('Henry', 'Garcia', 'henry.garcia@example.com', '8765432109', '123 Palm St', 'San Francisco', 'CA', 'USA', 'Respiratory Therapist');
