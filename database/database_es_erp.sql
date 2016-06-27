CREATE TABLE proyectos
(
	proyecto_id TINYINT identity PRIMARY KEY,
	nombreProyecto VARCHAR(80) NOT NULL UNIQUE
)
CREATE TABLE equipos
(
	equipo_id TINYINT identity PRIMARY KEY,
	proyecto_id TINYINT NOT NULL UNIQUE,
	usuario_id TINYINT NOT NULL UNIQUE,
	FOREIGN KEY (proyecto_id) REFERENCES proyectos(proyecto_id)
)
CREATE TABLE noministas
(
	nominista_id TINYINT identity PRIMARY KEY,
	equipo_id TINYINT NOT NULL,
	usuario_id TINYINT NOT NULL UNIQUE,
	FOREIGN KEY (equipo_id) REFERENCES equipos(equipo_id)
)
CREATE TABLE atc
(
	atc_id TINYINT identity PRIMARY KEY,
	equipo_id TINYINT NOT NULL,
	usuario_id TINYINT NOT NULL UNIQUE,
	FOREIGN KEY (equipo_id) REFERENCES equipos(equipo_id)
)