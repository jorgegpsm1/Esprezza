/*STATIC*/
create table IF NOT EXISTS user_access(
	id_user tinyint unsigned NOT NULL AUTO_INCREMENT,
	user_login_name varchar(20) NOT NULL,
	user_login_pass varchar(255) NOT NULL,
	user_status tinyint(1) NOT NULL DEFAULT 1,
	PRIMARY KEY(id_user)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci AUTO_INCREMENT=1;

/*STATIC*/
create table IF NOT EXISTS user_job(
	id_job tinyint unsigned NOT NULL AUTO_INCREMENT,
	job_name varchar(60) NOT NULL,
	job_status tinyint NOT NULL DEFAULT 0,
	PRIMARY KEY(id_job)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci AUTO_INCREMENT=1;

/*STATIC*/
create table IF NOT EXISTS user_info(
	id_user tinyint unsigned NOT NULL,
	id_job tinyint unsigned NOT NULL,
	user_name varchar(60) NOT NULL,
	user_last_name varchar(60) NOT NULL,
	user_img varchar(120) NOT NULL,
	PRIMARY KEY(id_user),
	FOREIGN KEY(id_job) REFERENCES user_job(id_job),
	FOREIGN KEY(id_user) REFERENCES user_access(id_user)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci AUTO_INCREMENT=1;

/*STATIC*/
create table IF NOT EXISTS user_session_access(
	id_user tinyint unsigned NOT NULL,
	user_sessions tinyint NOT NULL DEFAULT 0,
	user_session_pass varchar(255) NOT NULL,
	PRIMARY KEY(id_user),
	FOREIGN KEY(id_user) REFERENCES user_access(id_user)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;

/*DYNAMIC*/
/*
KEY_1 = USER_SESSIONS FROM TABLE USER_SESSION_ACCESS
 */
create table IF NOT EXISTS user_sessions_access_{KEY_1}(
	id_session tinyint unsigned NOT NULL,
	user_key  varchar(255) NOT NULL,
	user_date_created TIMESTAMP ,
	user_date_current TIMESTAMP,
	user_date_temp TIMESTAMP,
	user_ip varchar(40) NOT NULL,
	user_browser varchar(255) NOT NULL,
	user_session_temp tinyint(1) NOT NULL DEFAULT 1,
	UNIQUE (id_session)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;

/*STATIC*/
create table IF NOT EXISTS department(
	id_department tinyint unsigned NOT NULL,
	department_name varchar(255) NOT NULL,
	department_status tinyint(1) NOT NULL DEFAULT 1,
	PRIMARY KEY(id_department)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;

/*DYNAMIC*/
/*
KEY_1 = ID_DEPARTMENT FROM TABLE DEPARTMENT
 */
create table IF NOT EXISTS department_user_access_{KEY_1}(
	id_user tinyint unsigned NOT NULL,
	user_department_status tinyint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY(id_user),
	FOREIGN KEY(id_user) REFERENCES user_access(id_user)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;

/*DYNAMIC*/
/*
KEY_1 = ID_DEPARTMENT FROM TABLE DEPARTAMENT
 */
create table IF NOT EXISTS department_area_{KEY_1}(
	id_area tinyint unsigned NOT NULL,
	area_name varchar(100) NOT NULL,
	area_status tinyint(1) NOT NULL DEFAULT 1,
	PRIMARY KEY(id_area)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;

/*DYNAMIC*/
/*
KEY_1 = ID_DEPARTMENT FROM TABLE DEPARTMENT
KEY_2 = ID_AREA FROM TABLE DEPARTENT_AREA_{KEY_1}
 */
create table IF NOT EXISTS department_area_user_access_{KEY_1}_{KEY_2}(
	id_user tinyint unsigned NOT NULL,
	user_department_area_status tinyint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY(id_user),
	FOREIGN KEY(id_user) REFERENCES user_access(id_user)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;

/*DYNAMIC*/
/*
KEY_1 = ID_DEPARTMENT FROM TABLE DEPARMENT
KEY_2 = ID_AREA FROM TABLE DEPARMENT_AREA_{KEY_1}
 */
create table IF NOT EXISTS DEPARTMENT_AREA_MODULES_{KEY_1}_{KEY_2}(
	ID_MODULE tinyint unsigned NOT NULL,
	MODULE_NAME varchar(100) NOT NULL,
	MODULE_STATUS tinyint(1) NOT NULL DEFAULT 1
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;

/*DYNAMIC*/
/*
KEY_1 = ID_DEPARTMENT FROM TABLE DEPARTMENT
KEY_2 = ID_AREA FROM TABLE DEPARTMENT_AREA_{KEY_1}
KEY_3 = ID_MODULE FROM TABLE DEPARTMENT_AREA_{KEY_1}_{KEY_2}
 */
create table IF NOT EXISTS DEPARTMENT_AREA_MODULE_USER_ACCESS_{KEY_1}_{KEY_2}_{KEY_3}(
	ID_USER tinyint unsigned NOT NULL,
	USER_DEPARTMENT_AREA_MODULE_ACCESS_STATUS tinyint(1) NOT NULL DEFAULT 0,
	MODULE_READ tinyint(1) NOT NULL DEFAULT 0,
	MODULE_CREATE tinyint(1) NOT NULL DEFAULT 0,
	MODULE_UPDATE tinyint(1) NOT NULL DEFAULT 0,
	MODULE_DELETE tinyint(1) NOT NULL DEFAULT 0,
	PRIMARY KEY(ID_USER),
	FOREIGN KEY(ID_USER) REFERENCES USER_ACCESS(ID_USER)
)ENGINE=InnoDB CHARACTER SET utf8 COLLATE utf8_spanish2_ci;