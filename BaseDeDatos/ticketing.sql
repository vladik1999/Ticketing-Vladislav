drop database if exists ticketing;
create database if not exists ticketing;
use ticketing;


drop table if exists users;

create table users (

id INT not null AUTO_INCREMENT,

usuario VARCHAR(20) not null,

contrasena VARCHAR(20) not null,

privilegio VARCHAR(20),

PRIMARY KEY (id)

)ENGINE=innodb;


drop table if exists incidencias;

create table incidencias (

id INT not null AUTO_INCREMENT,

fecha DATE,

componente VARCHAR(20),

aula VARCHAR(20),

descripcion VARCHAR(200),

estado VARCHAR(20),

usuario VARCHAR(20) not null,

PRIMARY KEY (id)

)ENGINE=innodb;

drop table if exists privilegios;

create table privilegios (

id INT not null AUTO_INCREMENT,

nombre_corto VARCHAR(200),

descripcion VARCHAR(20),

PRIMARY KEY (id)

)ENGINE=innodb;



INSERT INTO `users` (`id`, `usuario`, `contrasena`, `privilegio`) VALUES 
(NULL, 'vlad', 'vlad', 'Admin'),
(NULL, 'vlad2', 'vlad', 'Normal'),
(NULL, 'vlad3', 'vlad3', 'Normal');

INSERT INTO `incidencias` (`id`, `fecha`, `componente`, `aula`, `descripcion`, `estado`, `usuario`) VALUES 
(NULL, CURRENT_DATE(), 'PC',  '22', 'Problema con audio, no hace sonido', 'abierta', 'vlad2'),
(NULL, CURRENT_DATE(), 'Impresora',  '24', 'No imprime', 'abierta', 'vlad2'),
(NULL, CURRENT_DATE(), 'PC',  '25', 'No va', 'en_curso', 'vlad3'),
(NULL, CURRENT_DATE(), 'Impresora',  '22', 'No saca tinta', 'en_curso', 'vlad3'),
(NULL, CURRENT_DATE(), 'Portatil',  '24', 'No quiere arrancar', 'cerrada', 'vlad2');

INSERT INTO `privilegios` (`id`, `nombre_corto`, `descripcion`) VALUES 
(NULL, 'adm', 'Administrador: Control TOTAL'),
(NULL, 'nrm', 'Normal: Control parcial'),
(NULL, 'blq', 'Bloqueado: Bloqueo casi total');
