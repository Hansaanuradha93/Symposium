---- Create Tables

CREATE TABLE `symposium`.`Faculty` (
    `f_id` INT( 10 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `name` VARCHAR( 100 ) NOT NULL ,
) ENGINE = MYISAM ;

CREATE TABLE `symposium`.`Supervisor` (
    `s_id` INT( 10 ) NOT NULL AUTO_INCREMENT,
    `f_name` VARCHAR( 200 ) NOT NULL ,
    `l_name` VARCHAR( 200 ) NOT NULL ,
    `email` VARCHAR( 200 ) NOT NULL ,
    `password` VARCHAR( 255 ) ,
    `faculty_id` INT( 1 ) ,
    PRIMARY KEY (s_id),
    FOREIGN KEY (faculty_id) REFERENCES Faculty(f_id)
) ENGINE = MYISAM ;

CREATE TABLE `symposium`.`Student` (
    `s_id` INT( 10 ) NOT NULL AUTO_INCREMENT,
    `f_name` VARCHAR( 200 ) NOT NULL ,
    `l_name` VARCHAR( 200 ) NOT NULL ,
    `email` VARCHAR( 200 ) NOT NULL ,
    `password` VARCHAR( 255 ) ,
    `faculty_id` INT( 1 ) ,
    PRIMARY KEY (s_id),
    FOREIGN KEY (faculty_id) REFERENCES Faculty(f_id)
) ENGINE = MYISAM ;

CREATE TABLE `symposium`.`Status` (
    `s_id` INT( 1 ) NOT NULL,
    `name` VARCHAR( 20 ) NOT NULL ,
    PRIMARY KEY (s_id)
) ENGINE = MYISAM ;


CREATE TABLE `symposium`.`File` (
    `f_id` INT( 10 ) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR( 200 ) NOT NULL ,
    `size` INT NOT NULL ,
    `type` VARCHAR( 200 ) NOT NULL ,
    `title` VARCHAR( 255 ) NOT NULL ,
    `category` VARCHAR( 255 ) NOT NULL ,
    `status_id` INT( 1 ) NOT NULL ,
    `student_id` INT( 10 ) ,
    `supervisor_id` INT( 10 ) ,
    `faculty_id` INT( 10 ) ,
    PRIMARY KEY (f_id),
    FOREIGN KEY (status_id) REFERENCES Status(s_id),
    FOREIGN KEY (student_id) REFERENCES Student(s_id),
    FOREIGN KEY (supervisor_id) REFERENCES Supervisor(s_id),
    FOREIGN KEY (faculty_id) REFERENCES Faculty(f_id)
) ENGINE = MYISAM ;




select f.f_id as file_id,f.name as file_name, f.title as file_title, f.category as file_category, s.name as status_name, st.f_name as first_name, st.l_name as last_name, fc.name as faculty_name, sp.f_name as supervisor_first_name, sp.l_name as supervisor_last_name
from File f
Join Status s ON s.s_id = f.status_id
JOIN Student st ON f.student_id = st.s_id
JOIN Faculty fc ON fc.f_id = f.faculty_id
JOIN Supervisor sp ON sp.s_id = f.supervisor_id
WHERE f.student_id = '' AND f.f_id = '';

UPDATE File 
SET status_id='1' 
WHERE f_id = '49';

