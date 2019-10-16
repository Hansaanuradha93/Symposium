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

