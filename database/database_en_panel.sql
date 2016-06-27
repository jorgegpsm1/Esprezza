/*STATIC UNIQUE*/
create table IF NOT EXISTS users(
	user_id tinyint unsigned NOT NULL AUTO_INCREMENT,
	user_name varchar(30) NOT NULL,
	user_passwd varchar(255) NOT NULL,
	user_status tinyint(1) NOT NULL DEFAULT 1,
	UNIQUE(user_name),
	PRIMARY KEY(user_id)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci AUTO_INCREMENT=1;

/*STATIC*/
create table IF NOT EXISTS jobs(
	job_id tinyint unsigned NOT NULL AUTO_INCREMENT,
	job_name varchar(60) NOT NULL UNIQUE,
	PRIMARY KEY(job_id)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci AUTO_INCREMENT=1;

/*DYNAMIC*/
/*
KEY_1 = job_id FROM jobs
 */
create table IF NOT EXISTS roles_{KEY_1}(
	role_id tinyint unsigned NOT NULL AUTO_INCREMENT,
	role_name varchar(60) NOT NULL UNIQUE,
	PRIMARY KEY(role_id)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci AUTO_INCREMENT=1;

/*STATIC*/
create table IF NOT EXISTS users_info(
	user_id tinyint unsigned NOT NULL,
	job_id tinyint unsigned NOT NULL,
	role_id tinyint unsigned NOT NULL,
	user_name varchar(60) NOT NULL,
	user_first_name varchar(60) NOT NULL,
	user_last_name varchar(60) NOT NULL,
	user_img varchar(120) NOT NULL,
	PRIMARY KEY(user_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci AUTO_INCREMENT=1;

/*STATIC*/
create table IF NOT EXISTS users_session(
	user_id tinyint unsigned NOT NULL,
	user_session tinyint NOT NULL DEFAULT 0,
	user_passwd varchar(255) NOT NULL,
	PRIMARY KEY(user_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;

/*DYNAMIC*/
/*
KEY_1 = USER_SESSIONS FROM TABLE USER_SESSION_ACCESS
 */
create table IF NOT EXISTS users_access_{KEY_1}(
	session_id tinyint unsigned NOT NULL UNIQUE,
	user_passwd varchar(255) NOT NULL,
	user_date_created TIMESTAMP,
	user_date_current TIMESTAMP,
	user_date_temp TIMESTAMP,
	user_ip varchar(50) NOT NULL,
	user_browser varchar(50) NOT NULL,
	user_device varchar(50) NOT NULL
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;

/*STATIC*/
create table IF NOT EXISTS departments(
	department_id tinyint unsigned NOT NULL,
	department_name varchar(255) NOT NULL UNIQUE,
	department_status tinyint(1) NOT NULL DEFAULT 1,
	PRIMARY KEY(department_id)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;

/*DYNAMIC*/
/*
KEY_1 = ID_DEPARTMENT FROM TABLE DEPARTMENT
 */
create table IF NOT EXISTS department_user_{KEY_1}(
	user_id tinyint unsigned NOT NULL,
	user_status tinyint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY(user_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;

/*DYNAMIC*/
/*
KEY_1 = ID_DEPARTMENT FROM TABLE DEPARTAMENT
 */
create table IF NOT EXISTS area_{KEY_1}(
	area_id tinyint unsigned NOT NULL,
	area_name varchar(100) NOT NULL,
	area_status tinyint(1) NOT NULL DEFAULT 1,
	PRIMARY KEY(area_id)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;

/*DYNAMIC*/
/*
KEY_1 = ID_DEPARTMENT FROM TABLE DEPARTMENT
KEY_2 = ID_AREA FROM TABLE DEPARTENT_AREA_{KEY_1}
 */
create table IF NOT EXISTS area_user_{KEY_1}_{KEY_2}(
	user_id tinyint unsigned NOT NULL,
	user_status tinyint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY(user_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;

/*DYNAMIC*/
/*
KEY_1 = ID_DEPARTMENT FROM TABLE DEPARMENT
KEY_2 = ID_AREA FROM TABLE DEPARMENT_AREA_{KEY_1}
 */
create table IF NOT EXISTS module_{KEY_1}_{KEY_2}(
	module_id tinyint unsigned NOT NULL,
	module_name varchar(100) NOT NULL,
	module_status tinyint(1) NOT NULL DEFAULT 1
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;

/*DYNAMIC*/
/*
KEY_1 = ID_DEPARTMENT FROM TABLE DEPARTMENT
KEY_2 = ID_AREA FROM TABLE DEPARTMENT_AREA_{KEY_1}
KEY_3 = ID_MODULE FROM TABLE DEPARTMENT_AREA_{KEY_1}_{KEY_2}
 */
create table IF NOT EXISTS module_access_{KEY_1}_{KEY_2}_{KEY_3}(
	user_id tinyint unsigned NOT NULL,
	user_status tinyint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY(user_id),
	FOREIGN KEY(user_id) REFERENCES users(user_id)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;