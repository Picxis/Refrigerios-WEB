/* Borrar base de datos si existe */
DROP DATABASE IF EXISTS CONTROL_MANEJO_REFRIGERIOS;

/* Crear base de datos */
CREATE DATABASE CONTROL_MANEJO_REFRIGERIOS;

/* Usar la base de datos */
USE CONTROL_MANEJO_REFRIGERIOS;

/* Crear tabla Usuario */
CREATE TABLE Usuario (
  idUsuario INT PRIMARY KEY AUTO_INCREMENT,
  nombreUsuario VARCHAR(50) NOT NULL,
  apellidoUsuario VARCHAR(50) NOT NULL,
  correoUsuario VARCHAR(50) NOT NULL,
  direccionUsuario VARCHAR(50) NOT NULL,
  passwordUsuario VARCHAR(150) NOT NULL,
  rolUsuario VARCHAR(20) NOT NULL,
  estadoUsuario VARCHAR(10) NOT NULL
);

/* Crear tabla Coordinador */
CREATE TABLE Coordinador (
  idCoordinador INT PRIMARY KEY AUTO_INCREMENT,
  oficinaCoordinador VARCHAR(50) NOT NULL,
  estadoUsuario VARCHAR(10) NOT NULL,
  jornadaCoordinador VARCHAR(50) NOT NULL,
  idUsuarioFK INT NOT NULL,
  FOREIGN KEY (idUsuarioFK) REFERENCES Usuario(idUsuario)
);

/* Crear tabla Auxiliar */
CREATE TABLE Auxiliar (
  idAuxiliar INT PRIMARY KEY AUTO_INCREMENT,
  cursoAuxiliar VARCHAR(20) NOT NULL,
  jornadaAuxiliar VARCHAR(20) NOT NULL,
  estadoAuxiliar VARCHAR(10) NOT NULL,
  idUsuarioFK INT NOT NULL,
  FOREIGN KEY (idUsuarioFK) REFERENCES Usuario(idUsuario)
);

/* Crear tabla Refrigerio */
CREATE TABLE Refrigerio (
  idRefrigerio INT PRIMARY KEY AUTO_INCREMENT,
  fechaRefrigerio DATE NOT NULL,
  horaRefrigerio TIME NOT NULL,
  tipoRefrigerio VARCHAR(20) NOT NULL,
  cantidadRefrigerio INT NOT NULL,
  descripcionRefrigerio VARCHAR(100) NOT NULL,
  estadoRefrigerio VARCHAR(10) NOT NULL,
  idCoordinadorFK INT NOT NULL,
  idAuxiliarFK INT NOT NULL,
  FOREIGN KEY (idAuxiliarFK) REFERENCES Auxiliar(idAuxiliar),
  FOREIGN KEY (idCoordinadorFK) REFERENCES Coordinador(idCoordinador)
);

/* Crear tabla Curso */
CREATE TABLE Curso (
  idCurso INT PRIMARY KEY AUTO_INCREMENT,
  cantidaAlumnosCurso INT NOT NULL,
  profesorDeHora VARCHAR(50) NOT NULL,
  estadoCurso VARCHAR(10) NOT NULL
);

/* Crear tabla AsigRefrigerioCurso */
CREATE TABLE AsigRefrigerioCurso (
  idAsigRefCur INT PRIMARY KEY AUTO_INCREMENT,
  fechaAsignacion DATE NOT NULL, 
  cantidadAsignado INT NOT NULL,
  idRefrigerioFK INT NOT NULL,
  idCursoFK INT NOT NULL,
  FOREIGN KEY (idRefrigerioFK) REFERENCES Refrigerio(idRefrigerio),
  FOREIGN KEY (idCursoFK) REFERENCES Curso(idCurso)
);

/* Insertar datos en tabla Usuario */
/* Insertar datos en tabla Usuario */
/* Insertar datos en tabla Usuario */
INSERT INTO Usuario (nombreUsuario, apellidoUsuario, correoUsuario, direccionUsuario, passwordUsuario, rolUsuario, estadoUsuario)
VALUES
    ('Maradona', 'Junior', 'maradonajunior@gmail.com', 'Dirección 1', 'holatilin', 'Usuario', 'Activo');


/* Insertar datos en tabla Coordinador */
INSERT INTO Coordinador (oficinaCoordinador, estadoUsuario, jornadaCoordinador, idUsuarioFK)
VALUES
	('Oficina 2', 'Activo', 'Mañana', 1);

/* Insertar datos en la tabla Auxiliar */
INSERT INTO Auxiliar (cursoAuxiliar, jornadaAuxiliar, estadoAuxiliar, idUsuarioFK)
VALUES
	('10-03', 'Mañana', 'Activo', 1);

/* Insertar datos en la tabla Curso */
INSERT INTO Curso (cantidaAlumnosCurso, profesorDeHora, estadoCurso)
VALUES
	(25, 'AndresFuentes', 'Activo');

/* Insertar datos en la tabla Refrigerio */
INSERT INTO Refrigerio (fechaRefrigerio, horaRefrigerio, tipoRefrigerio, cantidadRefrigerio, descripcionRefrigerio, estadoRefrigerio, idCoordinadorFK, idAuxiliarFK)
VALUES
	('2023-01-01', '10:00', 'A', 50, 'Jugo', 'Activo', 1, 1);

/* Insertar datos en la tabla Curso*/
INSERT INTO Curso (cantidaAlumnosCurso, profesorDeHora, estadoCurso)
VALUES
	(35, 'Camila Gutierrez', 'Activo');
    
/* Insertar datos en la tabla AsigRefrigerioCurso */
INSERT INTO AsigRefrigerioCurso (fechaAsignacion, cantidadAsignado, idRefrigerioFK, idCursoFK)
VALUES
	('2023-01-15', 20, 1, 1);




