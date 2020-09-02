
create database RESUME_DB;
use RESUME_DB;


CREATE TABLE users (
  id int(11) PRIMARY KEY AUTO_INCREMENT,
  username varchar(50) NOT NULL UNIQUE,
  password varchar(255) NOT NULL,
  created_at datetime DEFAULT current_timestamp()
);


INSERT INTO users (id, username, password, created_at) VALUES
(1, 'sugyan', '$2y$10$LixrBtXJBPN/0apDhReIEupluZSNMQq79ino88tor3Y/2NEQ.LuaG', '2020-04-25 00:07:19');


CREATE TABLE applicant(
  uid int primary key AUTO_INCREMENT,
  title_select varchar(2) DEFAULT NULL,
  name varchar(100) default null,
  gender_select varchar(10) default null,
  dob date default null,
  email varchar(60) not NULL,
  mobile varchar(15) not null,
  marks_10 float(4,2) default null,
  marks_12 float(4,2) default null,
  yearofpassing_10 int default null,
  yearofpassing_12 int default null,
  degree_ug varchar(100) default null,
  university_ug varchar(100) default null,
  branch_ug varchar(100) default null,
  marks_ug float(4,2) default null,
  yearofpassing_ug int default null,
  degree_pg varchar(100) default null,
  university_pg varchar(100) default null,
  branch_pg varchar(100) default null,
  marks_pg float(4,2) default null,
  yearofpassing_pg int default null,
  university_phd varchar(100) default null,
  part_fulltime boolean default null,
  areaofspecialization varchar(100) default null,
  status int default 0,
  status_others varchar(100) default NULL,
  yearofcompletion_phd int default null,
  yearofreg_phd int default null,
  total_exp_years float(4,2) default 0,
  teaching_exp_years float(4,2) default 0,
  non_teaching_exp_years float(4,2) default 0,
  photo varchar(100) default null,
  resume varchar(100) default null, 
  UNIQUE KEY (email,mobile)
);

CREATE TABLE posts(
  post_id int primary key AUTO_INCREMENT,
  teaching boolean default null,
  post_select varchar(30),
  avaliable boolean default True
);

INSERT into posts(teaching,post_select) values
  (0,'Admission Counsilling'),
  (0,'HR Executive'),
  (0,'Office Executive'),
  (0,'Placement Officer'),
  (0,'Others'),
  (1,'Professor'),
  (1,'Assistant Professor'),
  (1,'Associate Professor'),
  (1,'Teaching Assistant');

CREATE TABLE application (
  application_date date NOT NULL,
  application_time time NOT NULL,
  uid int,
  application_id int primary key AUTO_INCREMENT,
  post_id int ,
  department varchar(20),
  seen boolean default False,
  foreign key (uid) references applicant(uid),
  foreign key (post_id) references posts(post_id),
  UNIQUE KEY (uid,post_id)
);
