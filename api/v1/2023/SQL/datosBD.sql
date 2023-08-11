USE escuela;

-- Poblando Roles de Usuarios
INSERT INTO RolesUsuario (nombre, nivel) VALUES 
('none', 0),
('Tecnico', 1),
('Admin', 2),
('Apoderado', 3),
('Alumno', 4);


-- Insertando Regiones
INSERT INTO Regiones (nombre) VALUES 
('Región A'),
('Región B'),
('Región C'),
('Región D'),
('Región E');

-- Insertando Comunas
-- Asociadas a las regiones anteriormente insertadas
INSERT INTO Comunas (nombre, idRegion) VALUES 
-- Comunas para Región A (ID 1)
('Comuna A1', 1),
('Comuna A2', 1),
('Comuna A3', 1),
-- Comunas para Región B (ID 2)
('Comuna B1', 2),
('Comuna B2', 2),
-- Comunas para Región C (ID 3)
('Comuna C1', 3),
('Comuna C2', 3),
('Comuna C3', 3),
('Comuna C4', 3),
-- Comunas para Región D (ID 4)
('Comuna D1', 4),
-- Comunas para Región E (ID 5)
('Comuna E1', 5),
('Comuna E2', 5),
('Comuna E3', 5);


-- Poblando ProgramasSociales
INSERT INTO ProgramasSociales (nombre) VALUES 
('Programa A'),
('Programa B'),
-- ... Agrega todos los programas sociales que desees
('Programa Z');

-- Poblando Etnias
INSERT INTO Etnias (nombre) VALUES 
('Etnia A'),
('Etnia B'),
-- ... Agrega todas las etnias que desees
('Etnia Z');

-- Poblando Cursos
INSERT INTO Cursos (nombre) VALUES 
('Curso 1A'),
('Curso 2B'),
-- ... Agrega todos los cursos que desees
('Curso 8D');

-- Poblando ColegiosAnteriores
INSERT INTO ColegiosAnteriores (nombre) VALUES 
('Colegio Antiguo A'),
('Colegio Antiguo B'),
-- ... Agrega todos los colegios anteriores que desees
('Colegio Antiguo Z');


-- Insertando Usuarios
INSERT INTO Usuarios (nombre, rut, fechaNacimiento, domicilio, calle, numero, idComuna, email, telefono, nivel) VALUES
-- 5 Alumnos
('Juan Perez', '12345678-9', '2008-02-15', 'Calle Alumnos', 'Calle A', '15', 1, 'juanperez@gmail.com', '123456789', 4),
('Maria Rodriguez', '12345679-8', '2008-04-20', 'Calle Alumnos', 'Calle A', '16', 1, 'mariarodriguez@gmail.com', '123456788', 4),
('Pedro Gomez', '12345677-7', '2008-06-10', 'Calle Alumnos', 'Calle B', '17', 1, 'pedrogomez@gmail.com', '123456787', 4),
('Ana Soto', '12345676-6', '2008-08-05', 'Calle Alumnos', 'Calle B', '18', 1, 'anasoto@gmail.com', '123456786', 4),
('Roberto Medina', '12345675-5', '2008-10-01', 'Calle Alumnos', 'Calle C', '19', 1, 'robertomedina@gmail.com', '123456785', 4),
-- 5 Apoderados (Padres)
('Carla Perez', '98765432-1', '1980-02-15', 'Calle Padres', 'Calle D', '20', 2, 'carlaperez@gmail.com', '987654321', 3),
('Miguel Rodriguez', '98765431-0', '1981-04-20', 'Calle Padres', 'Calle D', '21', 2, 'miguelrodriguez@gmail.com', '987654310', 3),
('Lucia Gomez', '98765430-2', '1982-06-10', 'Calle Padres', 'Calle E', '22', 2, 'luciagomez@gmail.com', '987654302', 3),
('Oscar Soto', '98765429-3', '1983-08-05', 'Calle Padres', 'Calle E', '23', 2, 'oscarsoto@gmail.com', '987654293', 3),
('Lorena Medina', '98765428-4', '1984-10-01', 'Calle Padres', 'Calle F', '24', 2, 'lorenamedina@gmail.com', '987654284', 3),
-- 3 Personal Administrativo
('Manuel Admin', '87654321-5', '1975-02-15', 'Calle Admin', 'Calle G', '25', 3, 'manueladmin@gmail.com', '876543215', 2),
('Carmen Admin', '87654320-6', '1976-04-20', 'Calle Admin', 'Calle G', '26', 3, 'carmenadmin@gmail.com', '876543206', 2),
('Joaquin Admin', '87654319-7', '1977-06-10', 'Calle Admin', 'Calle H', '27', 3, 'joaquinadmin@gmail.com', '876543197', 2),
-- 2 Usuarios Nivel Técnico
('Andres Tech', '76543210-8', '1972-02-15', 'Calle Tech', 'Calle I', '28', 4, 'andrestech@gmail.com', '765432108', 1),
('Laura Tech', '76543209-9', '1973-04-20', 'Calle Tech', 'Calle I', '29', 4, 'lauratech@gmail.com', '765432099', 1),
-- 1 Usuario Nivel 0
('Sin Nivel Zero', '65432109-0', '1965-02-15', 'Calle Zero', 'Calle J', '30', 5, 'sinnivelzero@gmail.com', '654321090', 0);


INSERT INTO Alumnos (idUsuario, sexo, viveCon, viveConEspecificar, idProgramaSocial, idEtnia, repetidoCurso, idColegioAnterior, necesitaTransporte, sectorTransporte) VALUES
(1, 'Masculino', 'Ambos', NULL, 1, 1, 'No', 1, 'Si', 'Norte'),
(2, 'Femenino', 'Madre', NULL, 2, 1, 'Si: 3er grado', 2, 'No', NULL),
(3, 'Masculino', 'Otros', 'Tía y abuelo', 1, 2, 'No', 3, 'Si', 'Sur'),
(4, 'Femenino', 'Padre', NULL, 3, 1, 'Si: 2do grado', 1, 'No', NULL),
(5, 'Masculino', 'Ambos', NULL, 1, 2, 'No', 3, 'Si', 'Oeste');



-- Poblando Salud
-- Dada la naturaleza de la tabla, probablemente necesitemos información más específica para poblarla.
-- Este es solo un ejemplo general.
INSERT INTO Salud (idAlumno, tratamientoMedico, programaEscolar, contraindicacionMedica, alergiaMedicamento, alergiaAlimento, antecedentesTrastornos, previsionSocial) VALUES 
(1, 'Tratamiento A', 'Programa 1', 'No', 'Alergia medicamento A', 'Alergia alimento A', 'Antecedente A', 'FONASA'),
(2, 'Tratamiento B', 'Programa 2', 'Si', 'Alergia medicamento B', 'Alergia alimento B', 'Antecedente B', 'ISAPRE'),
(3, 'Tratamiento C', 'Programa 3', 'No', 'Alergia medicamento C', 'Alergia alimento C', 'Antecedente C', 'Otros'),
(4, 'Tratamiento D', 'Programa 4', 'Si', 'Alergia medicamento D', 'Alergia alimento D', 'Antecedente D', 'FONASA'),
(5, 'Tratamiento E', 'Programa 5', 'No', 'Alergia medicamento E', 'Alergia alimento E', 'Antecedente E', 'ISAPRE');


-- Poblando DocumentosApoderado
INSERT INTO DocumentosApoderado (idAlumno, certificadoEstudios, informePersonalidad, informeNotas, fotocopiaHojaVida, boletaAporte, certificadoMedico) VALUES 
(1, 'Si', 'No', 'Si', 'No', 'Si', 'No'),
(2, 'Si', 'Si', 'No', 'No', 'Si', 'Si'),
(3, 'No', 'No', 'Si', 'Si', 'No', 'Si'),
(4, 'Si', 'No', 'Si', 'Si', 'Si', 'No'),
(5, 'No', 'Si', 'No', 'Si', 'No', 'Si');

-- Poblando DocumentosCompartidos
INSERT INTO DocumentosCompartidos (idAlumno, reglamentoInterno, textoEscolarGratis, reglamentoEvaluacion) VALUES 
(1, 'Si', 'Si', 'No'),
(2, 'Si', 'No', 'Si'),
(3, 'No', 'Si', 'No'),
(4, 'Si', 'Si', 'Si'),
(5, 'No', 'No', 'Si');


-- Poblando la tabla Matriculas
INSERT INTO Matriculas (idAlumno, idFuncionario, idCurso, fechaMatricula, fechaRetiro) VALUES 
(1, 1, 1, '2023-08-01', NULL),
(2, 2, 2, '2023-08-02', NULL),
(3, 3, 3, '2023-08-03', '2023-07-01'),
(4, 4, 1, '2023-08-04', NULL),
(5, 5, 1, '2023-08-05', '2023-06-15');