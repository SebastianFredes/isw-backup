create database recepcionequipos;
use recepcionequipos;

CREATE TABLE rcp_perfil
 (
 RCP_id_perfil int auto_increment primary key not null,
 RCP_nombre_ref varchar (50),
 RCP_marca varchar (50),
 RCP_nombre_modelo varchar (50),
 RCP_gabinete varchar (50),
 RCP_cpu varchar (50),
 RCP_gpu varchar (50),
 RCP_ram varchar (50),
 RCP_hdd varchar (50),
 RCP_ssd varchar (50),
 RCP_und_opt varchar (50),
 RCP_psu varchar (50),
 RCP_so varchar (50),
 RCP_monitor varchar (50) default null,
 RCP_perifericos varchar (50) default null,
 RCP_observacion varchar (200)
 );
 
 CREATE TABLE rcp_contrato
 (
 RCP_id_contrato int auto_increment primary key not null,
 RCP_nombre_contrato varchar(50)
 );
 
CREATE TABLE rcp_estado
 (
 RCP_id_estado int auto_increment primary key not null,
 RCP_nom_estado varchar (50)
 );
 
 CREATE TABLE rcp_jefe_serv
 (
 RCP_rut_js varchar (20) primary key not null
 );
 
CREATE TABLE rcp_sede
 (
 RCP_id_sede int auto_increment primary key not null,
 RCP_nom_sede varchar (50),
 RCP_rut_js varchar (20),
 foreign key (RCP_rut_js) references rcp_jefe_serv(RCP_rut_js)
 ); 
 
CREATE TABLE rcp_encargado_sop
 (
 RCP_rut_es varchar (20) primary key not null,
 RCP_id_sede int not null,
 foreign key (RCP_id_sede) references rcp_sede(RCP_id_sede)
 );
 
CREATE TABLE rcp_equipo
 (
 RCP_id_equipo int auto_increment primary key not null,
 RCP_id_interno varchar (50),
 RCP_fecha_llegada date,
 RCP_observacion varchar (200),
 RCP_id_sede int not null,
 RCP_id_estado int not null,
 RCP_id_contrato int not null,
 RCP_id_perfil int not null,
 foreign key (RCP_id_sede) references rcp_sede(RCP_id_sede),
 foreign key (RCP_id_estado) references rcp_estado(RCP_id_estado),
 foreign key (RCP_id_contrato) references rcp_contrato(RCP_id_contrato),
 foreign key (RCP_id_perfil) references rcp_perfil(RCP_id_perfil)
 );
 
  CREATE TABLE rcp_contiene
 (
 RCP_id_contrato int not null,
 RCP_id_perfil int not null,
 RCP_cantidad_listos int,
 RCP_cantidad_recepcionada int,
 RCP_cantidad_total int,
 primary key(RCP_id_contrato,RCP_id_perfil),
 foreign key (RCP_id_contrato) references rcp_contrato(RCP_id_contrato),
 foreign key (RCP_id_perfil) references rcp_perfil(RCP_id_perfil)
 );
 
 
-- PERFILES

INSERT INTO rcp_perfil (RCP_id_perfil, RCP_nombre_ref, RCP_marca, RCP_nombre_modelo, RCP_gabinete, RCP_cpu, RCP_gpu, RCP_ram, RCP_hdd, RCP_ssd, RCP_und_opt, RCP_psu, RCP_so, RCP_monitor, RCP_perifericos, RCP_observacion) 
VALUES 
(NULL, 'Notebook estudiante', 'HP', 'HP Omen 15-EK0010LA', NULL, ' Intel Core i5-10300H', 'NVIDIA GeForce RTX 2060 ', '8 GB DDR4', NULL, 'SSD 512GB', NULL, NULL, 'Windows 10', NULL, NULL, 'Intel Optane 32GB');
 
INSERT INTO rcp_perfil 
(RCP_id_perfil, RCP_nombre_ref, RCP_marca, RCP_nombre_modelo, RCP_gabinete, RCP_cpu, RCP_gpu, RCP_ram, RCP_hdd, RCP_ssd, RCP_und_opt, RCP_psu, RCP_so, RCP_monitor, RCP_perifericos, RCP_observacion) 
VALUES 
(NULL, 'Computador laboratorio', 'Gear', ' SLIM-125i', 'Gear Slim mATX S610 ', ' Intel Core i5-10400', 'Gráficos UHD Intel® 630', '8GB', 'Disco Duro 1TB Sata3 7200 rpm', NULL, 'DVDRW SATA', 'PSU 300W 80 plus', 'windows 10', NULL, 'Mouse spektra, teclado spektra', 'Sin monitor');
 
INSERT INTO rcp_perfil 
(RCP_id_perfil, RCP_nombre_ref, RCP_marca, RCP_nombre_modelo, RCP_gabinete, RCP_cpu, RCP_gpu, RCP_ram, RCP_hdd, RCP_ssd, RCP_und_opt, RCP_psu, RCP_so, RCP_monitor, RCP_perifericos, RCP_observacion) 
VALUES 
(NULL, 'Computador laboratorio informatica', 'Gear', 'SLIM-124i', 'Gabinete ATX Wavetreck ', 'Intel Core i7-10700', 'Gráficos UHD Intel® 630', '8GB DDR4 2666MHz', 'Disco Duro 1TB Sata3 7200 rpm', NULL, NULL, 'PSU P450B 450W 80 plus', 'Windows 10', 'Monitor Led Viewsonic 18.5', 'mouse spektra', 'Sin unidad optica');
 
INSERT INTO rcp_perfil (RCP_id_perfil, RCP_nombre_ref, RCP_marca, RCP_nombre_modelo, RCP_gabinete, RCP_cpu, RCP_gpu, RCP_ram, RCP_hdd, RCP_ssd, RCP_und_opt, RCP_psu, RCP_so, RCP_monitor, RCP_perifericos, RCP_observacion) 
VALUES 
(NULL, 'Laboratorio Arquitectura', 'Gear', 'GAMER-201i', 'Deepcool® Matrexx 55', 'Intel Core i5-10400', 'NVIDIA GTX1650 TUF Gaming 4GB', '8GB', '1TB Sata3 7200 rpm', NULL, NULL, '500W 80+ Bronce', 'Windows 10', 'Gear Monitor 23,8”', 'Mouse y teclado genius', 'no incluye audio externo');
 
 
-- ESTADOS
 
INSERT INTO rcp_estado (RCP_id_estado, RCP_nom_estado) VALUES (NULL, 'nuevo');
INSERT INTO rcp_estado (RCP_id_estado, RCP_nom_estado) VALUES (NULL, 'faltante');
INSERT INTO rcp_estado (RCP_id_estado, RCP_nom_estado) VALUES (NULL, 'espera revision hw');
INSERT INTO rcp_estado (RCP_id_estado, RCP_nom_estado) VALUES (NULL, 'espera revision sw');
INSERT INTO rcp_estado (RCP_id_estado, RCP_nom_estado) VALUES (NULL, 'listo');
INSERT INTO rcp_estado (RCP_id_estado, RCP_nom_estado) VALUES (NULL, 'devolucion');
 
-- JEFE DE SERVICIOS
 
INSERT INTO rcp_jefe_serv (RCP_rut_js) VALUES ('17222315-k');
INSERT INTO rcp_jefe_serv (RCP_rut_js) VALUES ('7181222-7');

-- SEDE

INSERT INTO rcp_sede (RCP_id_sede, RCP_nom_sede, RCP_rut_js) VALUES (NULL, 'Concepcion', '7181222-7');
INSERT INTO rcp_sede (RCP_id_sede, RCP_nom_sede, RCP_rut_js) VALUES (NULL, 'Chillan', '17222315-k');

-- ENCARGADO

INSERT INTO rcp_encargado_sop (RCP_rut_es, RCP_id_sede) VALUES ('13767954-k', '2');
INSERT INTO rcp_encargado_sop (RCP_rut_es, RCP_id_sede) VALUES ('15612662-4', '1');

-- CONTRATO

INSERT INTO rcp_contrato (RCP_id_contrato, RCP_nombre_contrato) VALUES (NULL,'contrato 1');
INSERT INTO rcp_contrato (RCP_id_contrato, RCP_nombre_contrato) VALUES (NULL,'contrato 2');

-- CONTIENE (CANTIDAD POR CONTRATO)
 
INSERT INTO contiene (RCP_id_contrato, RCP_id_perfil, RCP_cantidad_listos, RCP_cantidad_recepcionada, RCP_cantidad_total) VALUES ('1', '1', 0, 0, '5');
INSERT INTO contiene (RCP_id_contrato, RCP_id_perfil, RCP_cantidad_listos, RCP_cantidad_recepcionada, RCP_cantidad_total) VALUES ('1', '4', 0, 0, '5');
 
INSERT INTO contiene (RCP_id_contrato, RCP_id_perfil, RCP_cantidad_listos, RCP_cantidad_recepcionada, RCP_cantidad_total) VALUES ('2', '3', 0, 0, '5');
INSERT INTO contiene (RCP_id_contrato, RCP_id_perfil, RCP_cantidad_listos, RCP_cantidad_recepcionada, RCP_cantidad_total) VALUES ('2', '2', 0, 0, '5');
 

-- EQUIPO

-- (x5)
INSERT INTO rcp_equipo (RCP_id_equipo, RCP_id_interno, RCP_fecha_llegada, RCP_observacion, RCP_id_sede, RCP_id_estado, RCP_id_contrato, RCP_id_perfil) 
VALUES (NULL, NULL, NULL, NULL, '1', '1', '1', '1');

-- (x5)
INSERT INTO rcp_equipo (RCP_id_equipo, RCP_id_interno, RCP_fecha_llegada, RCP_observacion, RCP_id_sede, RCP_id_estado, RCP_id_contrato, RCP_id_perfil) 
VALUES (NULL, NULL, NULL, NULL, '1', '1', '2', '3');

-- (x5)
INSERT INTO rcp_equipo (RCP_id_equipo, RCP_id_interno, RCP_fecha_llegada, RCP_observacion, RCP_id_sede, RCP_id_estado, RCP_id_contrato, RCP_id_perfil) 
VALUES (NULL, NULL, NULL, NULL, '2', '1', '1', '4');

-- (x5)
INSERT INTO rcp_equipo (RCP_id_equipo, RCP_id_interno, RCP_fecha_llegada, RCP_observacion, RCP_id_sede, RCP_id_estado, RCP_id_contrato, RCP_id_perfil) 
VALUES (NULL, NULL, NULL, NULL, '2', '1', '2', '2');


--                          

UPDATE  rcp_contiene c
INNER JOIN rcp_contrato con ON c.RCP_id_contrato = con.RCP_id_contrato
INNER JOIN rcp_equipo e ON con.RCP_id_contrato = e.RCP_id_contrato
SET c.RCP_cantidad_recepcionada = c.RCP_cantidad_recepcionada + 1,
e.RCP_id_interno = '$idinterna', 
e.RCP_observacion = '$observacion', 
e.RCP_id_estado=3
WHERE c.RCP_id_contrato= e.RCP_id_contrato 
AND c.RCP_id_perfil= e.RCP_id_perfil
AND e.RCP_id_equipo = $id_bd;


SELECT count(RCP_id_interno) as contador FROM rcp_equipo where RCP_id_interno='AAA-AA'
