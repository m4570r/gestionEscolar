CREATE DATABASE IF NOT EXISTS escuela;
USE escuela;

-- Tablas básicas
CREATE TABLE Regiones (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE Comunas (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    idRegion INT UNSIGNED,
    FOREIGN KEY (idRegion) REFERENCES Regiones(id)
);

-- Tablas maestras
CREATE TABLE ProgramasSociales (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE Etnias (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE Cursos (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE ColegiosAnteriores (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL UNIQUE
);


-- Tabla de Usuarios
CREATE TABLE Usuarios (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    rut VARCHAR(12) NOT NULL UNIQUE,
    fechaNacimiento DATE NOT NULL,
    domicilio VARCHAR(255),
    calle VARCHAR(255),
    numero VARCHAR(10),
    idComuna INT UNSIGNED,
    email VARCHAR(100) NULL,
    telefono VARCHAR(20),
    nivel INT NOT NULL DEFAULT 0,
    FOREIGN KEY (idComuna) REFERENCES Comunas(id)
);

-- Tabla Alumnos
CREATE TABLE Alumnos (
    idUsuario INT UNSIGNED PRIMARY KEY,
    sexo ENUM('Masculino', 'Femenino', 'Otro') NOT NULL,
    viveCon ENUM('Padre', 'Madre', 'Ambos', 'Otros') NOT NULL,
    viveConEspecificar TEXT,
    idProgramaSocial INT UNSIGNED,
    idEtnia INT UNSIGNED,
    repetidoCurso VARCHAR(255),
    idColegioAnterior INT UNSIGNED,
    necesitaTransporte ENUM('Si', 'No'),
    sectorTransporte VARCHAR(100),
    FOREIGN KEY (idUsuario) REFERENCES Usuarios(id),
    FOREIGN KEY (idProgramaSocial) REFERENCES ProgramasSociales(id),
    FOREIGN KEY (idEtnia) REFERENCES Etnias(id),
    FOREIGN KEY (idColegioAnterior) REFERENCES ColegiosAnteriores(id)
);

-- Tabla Matriculas
CREATE TABLE Matriculas (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    idAlumno INT UNSIGNED,
    idFuncionario INT UNSIGNED,
    idCurso INT UNSIGNED,
    fechaMatricula DATE,
    fechaRetiro DATE,
    FOREIGN KEY (idAlumno) REFERENCES Alumnos(idUsuario),
    FOREIGN KEY (idFuncionario) REFERENCES Usuarios(id),
    FOREIGN KEY (idCurso) REFERENCES Cursos(id)
);

-- Tabla Salud del Estudiante
CREATE TABLE Salud (
    idAlumno INT UNSIGNED PRIMARY KEY,
    tratamientoMedico TEXT,
    programaEscolar VARCHAR(255),
    contraindicacionMedica ENUM('Si', 'No'),
    alergiaMedicamento VARCHAR(255),
    alergiaAlimento VARCHAR(255),
    antecedentesTrastornos TEXT,
    previsionSocial ENUM('FONASA', 'ISAPRE', 'Otros', 'No'),
    FOREIGN KEY (idAlumno) REFERENCES Alumnos(idUsuario)
);

-- Tabla Documentos Apoderado
CREATE TABLE DocumentosApoderado (
    idAlumno INT UNSIGNED PRIMARY KEY,
    certificadoEstudios ENUM('Si', 'No'),
    informePersonalidad ENUM('Si', 'No'),
    informeNotas ENUM('Si', 'No'),
    fotocopiaHojaVida ENUM('Si', 'No'),
    boletaAporte ENUM('Si', 'No'),
    certificadoMedico ENUM('Si', 'No'),
    FOREIGN KEY (idAlumno) REFERENCES Alumnos(idUsuario)
);

-- Tabla Documentos Compartidos
CREATE TABLE DocumentosCompartidos (
    idAlumno INT UNSIGNED PRIMARY KEY,
    reglamentoInterno ENUM('Si', 'No'),
    textoEscolarGratis ENUM('Si', 'No'),
    reglamentoEvaluacion ENUM('Si', 'No'),
    FOREIGN KEY (idAlumno) REFERENCES Alumnos(idUsuario)
);

CREATE TABLE RolesUsuario (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(255) NOT NULL,
    nivel INT NOT NULL
);

