CREATE DATABASE campusVirtual_bd

drop database campusVirtual_bd
drop table cargo

CREATE TABLE cargo
(
  cargo_id serial not NULL,
  descripcion character varying(50) NOT NULL,
  CONSTRAINT pk_cargo PRIMARY KEY (cargo_id)
);

select * from usuario;

CREATE TABLE USUARIO
(
	doc_id character varying(20) not null,
    nombres character varying(50) not null,
    apellidos character varying(50) not null,
	direccion character varying(200) not null,
    telefono character varying(25) not null,
   -- sexo char(1) not null, -- Mujer: 0, Hombre: 1 
   -- edad char(2) not null,
    email character varying(150) not null,
    cargo_id integer,
	numInicioSesion int;
	numExamenCalificado int;
	numAprobado int;
	numDesaprobado int,
    constraint pk_usuario_doc_id primary key(doc_id),
    constraint fk_usuario_cargo_id foreign key(cargo_id) references cargo(cargo_id),
	CONSTRAINT uni_email UNIQUE (email)
);

-- select * from CREDENCIALES_ACCESO
CREATE TABLE CREDENCIALES_ACCESO
 ( 	
	codigo_usuario integer not null,
	clave character(32) not NULL,
	tipo char(1) not null, -- Amin: A, Docente: D, Estudiante: E
   -- p_foto bytea,
	estado char(1),
    fecha_registro varchar(50),
    doc_ID varchar(20),
    CONSTRAINT pk_codigo_usuario PRIMARY KEY (codigo_usuario),
    CONSTRAINT fk_usuario_doc_ID foreign key(doc_ID) references 
    USUARIO(doc_ID)
    
 );
 
 CREATE TABLE menu
(
  codigo_menu integer not NULL,
  nombre character varying(50) not NULL,
  CONSTRAINT menu_pkey PRIMARY KEY (codigo_menu)
);

CREATE TABLE menu_item
(
  codigo_menu integer not NULL,
  codigo_menu_item integer not NULL,
  nombre character varying(50) not NULL,
  archivo character varying(100) not NULL,
  CONSTRAINT pk_menu_item PRIMARY KEY (codigo_menu, codigo_menu_item),
  CONSTRAINT fk_menu_item_menu FOREIGN KEY (codigo_menu)
      REFERENCES menu (codigo_menu)
);

CREATE TABLE menu_item_accesos
(
  codigo_menu integer not NULL,
  codigo_menu_item integer not NULL,
  cargo_id integer not NULL,
  acceso character(1) not NULL,
  CONSTRAINT pk_menu_item_accesos PRIMARY KEY (codigo_menu, codigo_menu_item, cargo_id),
  CONSTRAINT fk_menu_item_accesos_cargo_id FOREIGN KEY (cargo_id)
      REFERENCES cargo (cargo_id),
  CONSTRAINT fk_menu_item_accesos_menu_item FOREIGN KEY (codigo_menu, codigo_menu_item)
      REFERENCES menu_item (codigo_menu, codigo_menu_item)
);

CREATE TABLE CURSO
(
	curso_id integer not null,
	nombre_curso varchar(200) not null,
	constraint pk_curso_curso_id primary key(curso_id)
);

CREATE TABLE PRUEBA
(
	prueba_id integer not null,
    cant_preguntas character varying(4) not null,
    tiempo_prueba character varying(50) not null,
    puntaje_aprobacion int not null,
    instrucciones character varying(500) not null,
    curso_id integer,
    constraint pk_prueba_prueba_id primary key(prueba_id),
    constraint fk_prueba_curso_id foreign key(curso_id) references curso (curso_id)
);

CREATE TABLE PREGUNTA
(
	pregunta_id integer not null,
    nombre_pregunta character varying(12000) not null,
    alternativa1 character varying(500),
	alternativa2 character varying(500),
	alternativa3 character varying(500),
	alternativa4 character varying(500),
	respuesta character varying(500),
    prueba_id integer,
    constraint pk_pregunta_pregunta_id primary key(pregunta_id),
    constraint fk_pregunta_prueba_id foreign key(prueba_id) references prueba(prueba_id)
);
 
CREATE TABLE RESPUESTA_PREGUNTA_USUARIO
(
	respuesta_pregunta_usuario_id integer not null,
	respuesta_usuario character varying(500)not null,   
    puntaje_correcto float,
	estado character varying(100),
    pregunta_id int,
	doc_id character varying(20)not null,
	promedio_id int,
	estadoCalificado char(2),
	numPregunta character varying(3)not null,
    -- numero_pregunta character varying(5),
    constraint pk_respuesta_pregunta_usuario_id primary key(respuesta_pregunta_usuario_id),
    constraint fk_pregunta_id foreign key(pregunta_id) references pregunta(pregunta_id),
	constraint fk_doc_id foreign key(doc_id) references usuario(doc_id),
	constraint fk_promedio_promedio_id foreign key(promedio_id) references promedio(promedio_id)
);

CREATE TABLE ANUNCIO
(
	anuncio_id integer not null,
	titulo_evento character varying(200) not null, 
	descripcion_evento varchar(500) not null,
	tipo_anuncio character varying(50)not null,
	constraint pk_anuncio_anuncio_id primary key(anuncio_id)
);

CREATE TABLE DETALLE_USUARIO_CURSO_EVENTO
(
	detalle_usuario_curso_evento_id integer not null,
    fecha character varying(50) not null,
	doc_id character varying(20),
    anuncio_id integer,
    curso_id integer,
    constraint pk_detalle_usuario_curso_evento_detalle_usuario_curso_evento_id primary key(detalle_usuario_curso_evento_id),
    constraint fk_detalle_usuario_curso_evento_doc_id foreign key(doc_id) references usuario(doc_id),
	constraint fk_detalle_usuario_curso_evento_anuncio_id foreign key(anuncio_id) references anuncio(anuncio_id),
    constraint fk_detalle_usuario_curso_evento_curso_id foreign key(curso_id) references curso(curso_id)
);

CREATE TABLE correlativo
 (
	tabla character varying(100) not null,
	numero integer not null,
	CONSTRAINT pk_correlativo PRIMARY KEY (tabla)
 );
 
 CREATE TABLE promedio
 (
	promedio_id integer,
	porcentaje float not null,
	descripcion character varying(200) not null,
	doc_id character varying(20),
	constraint pk_promedio_promedio_id primary key (promedio_id)
 );
 
  CREATE TABLE detalle_docente_profesor
  (
  detalle_docente_profesor_id integer,
  --fecha_inicio character varying(50),
  --fecha_fin character varying(50),
  curso_id int,
  doc_id character varying(20),
  constraint pk_detalle_docente_profesor_detalle_docente_profesor_id primary key (detalle_docente_profesor_id),
  constraint fk_detalle_docente_profesor_curso_id foreign key(curso_id) references curso(curso_id),
  constraint fk_detalle_docente_profesor_doc_id foreign key(doc_id) references usuario(doc_id)	  
  );
  
  -- tabla para el historial de log inicio sesión
  CREATE TABLE log_inicioSeseion
  (
  	doc_id character varying(20) not null,
    nombres character varying(50) not null,
    apellidos character varying(50) not null,
	cargo character varying(50) not null,
	tipo char(1) not null,
	fecha character varying(50) not null,
	tiempo character varying(50) not null,
	ip character varying(200) not null
  );
  
    -- drop table log_usuario
  CREATE TABLE log_usuario
  (
	usuarioQueRegistra_doc_id character varying(20),
    usuarioQueRegistra_nombres character varying(50),
    usuarioQueRegistra_apellidos character varying(50),
	usuarioQueRegistra_cargo_id int,
	usuarioQueRegistra_tipo char(1),
	fecha character varying(50),
	tiempo character varying(50),
  	doc_id character varying(20),
    nombres character varying(50),
    apellidos character varying(50),
	direccion character varying(200),
    telefono character varying(25),
    email character varying(150),
    cargo_id integer,
	tipo_operacion character varying(100),
	ip character varying(200) not null
  );
  
  -- drop table log_credenciales_acceso
  CREATE TABLE log_credenciales_acceso
 ( 	
	clave character(32),
	tipo char(1), -- Amin: A, Docente: D, Estudiante: E
	estado char(1),
    fecha_registro varchar(50),
    doc_ID varchar(20)
 );
 
  -- drop table log_curso
  CREATE TABLE log_curso
  (
	usuarioQueRegistra_doc_id character varying(20),
    usuarioQueRegistra_nombres character varying(50),
    usuarioQueRegistra_apellidos character varying(50),
	usuarioQueRegistra_cargo_id int,
	usuarioQueRegistra_tipo char(1),
	fecha character varying(50),
	tiempo character varying(50),
	curso_id int,
	nombre_curso varchar(200),
	tipo_operacion character varying(100),
	ip character varying(200) not null
  );
  -- drop table log_prueba
  CREATE TABLE log_prueba
(
	usuarioQueRegistra_doc_id character varying(20),
    usuarioQueRegistra_nombres character varying(50),
    usuarioQueRegistra_apellidos character varying(50),
	usuarioQueRegistra_cargo_id int,
	usuarioQueRegistra_tipo char(1),
	fecha character varying(50),
	tiempo character varying(50),
	prueba_id int,
    cant_preguntas character varying(4),
    tiempo_prueba character varying(50),
    puntaje_aprobacion int,
    instrucciones character varying(500),
    curso_id int,
	tipo_operacion character varying(100),
	ip character varying(200) not null
);
	-- drop table log_pregunta
CREATE TABLE log_pregunta
(
	usuarioQueRegistra_doc_id character varying(20),
    usuarioQueRegistra_nombres character varying(50),
    usuarioQueRegistra_apellidos character varying(50),
	usuarioQueRegistra_cargo_id int,
	usuarioQueRegistra_tipo char(1),
	fecha character varying(50),
	tiempo character varying(50),
	pregunta_id integer,
    nombre_pregunta character varying(12000),
    alternativa1 character varying(500),
	alternativa2 character varying(500),
	alternativa3 character varying(500),
	alternativa4 character varying(500),
	respuesta character varying(500),
    prueba_id integer,
	tipo_operacion character varying(100),
	ip character varying(200) not null
);
-- drop table log_detalle_docente_profesor
CREATE TABLE log_detalle_docente_profesor
  (
  detalle_docente_profesor_id integer,
  curso_id int,
  doc_id character varying(20)
  );
  
-- drop table log_usuario_curso_evento

-- drop table log_usuario_curso_evento;
 
-- select * from CURSO
 
 -- Registros
 -- Menú
insert into menu(codigo_menu,nombre)
values(1,'Inicio'); 
insert into menu(codigo_menu,nombre)
values(2,'Anuncio'); 
insert into menu(codigo_menu,nombre)
values(3,'Usuario');
insert into menu(codigo_menu,nombre)
values(4,'Perfil'); 
insert into menu(codigo_menu,nombre)
values(5,'Campus Virtual'); 
insert into menu(codigo_menu,nombre)
values(6,'Simulador'); 

--  Menú item
-- delete from menu_item

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(1,1,'Inicio', 'menu.principal.view.php'); 
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(1,2,'Eventos', 'eventos.view.php'); 
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(1,3,'Noticias', 'noticias.view.php'); 
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(2,4,'Gestionar Anuncios', 'gestionarAnuncios.view.php'); 
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(3,5,'Gestionar Usuario', 'gestionarUsuario.view.php'); 
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(3,6,'Reporte Simulador', 'reporteSimulador.view.php'); 
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(4,7,'Datos Personales', 'datosPersonales.view.php'); 
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(4,8,'Perfil', 'perfil.view.php'); 
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(5,9,'Gestionar Curso', 'gestionarCurso.view.php'); 
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(5,10,'Gestionar Archivo', 'gestionarArchivos.view.php'); 
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(5,11,'Gestionar Asignación', 'detalleAsignacion.view.php'); 
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(6,12,'Simulador', 'pruebaSimulador.view.php');

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(6,14,'Gestionar Pregunta','gestionarPregunta.view.php')

select * from menu_item_accesos
--  Menú item acceso
delete from menu_item_accesos
-- Director General
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,1,1,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,2,1,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,3,1,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(2,4,1,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,5,1,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,6,1,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,7,1,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,8,1,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,9,1,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,10,1,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,11,1,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(6,12,1,1); 

-- select * from menu_item_accesos;
-- Gerente general
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,1,2,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,2,2,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,3,2,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(2,4,2,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,5,2,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,6,2,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,7,2,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,8,2,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,9,2,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,10,2,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,11,2,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(6,12,2,1); 

-- Coordinadora Académica
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,1,3,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,2,3,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,3,3,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(2,4,3,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,5,3,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,6,3,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,7,3,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,8,3,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,9,3,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,10,3,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,11,3,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(6,12,3,1); 

-- Analista Programador
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,1,4,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,2,4,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,3,4,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(2,4,4,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,5,4,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,6,4,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,7,4,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,8,4,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,9,4,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,10,4,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,11,4,2); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(6,12,4,1); 

-- Docente
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,1,5,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,2,5,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,3,5,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(2,4,5,2); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,5,5,2); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,6,5,2); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,7,5,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,8,5,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,9,5,2); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,10,5,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,11,5,2); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(6,12,5,1); 

-- Estudiante
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,1,6,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,2,6,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(1,3,6,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(2,4,6,2); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,5,6,2); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(3,6,6,2); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,7,6,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(4,8,6,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,9,6,2); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,10,6,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(5,11,6,2);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(6,12,6,1); 

-- actualización al 27042020
insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(6,14,'Gestionar Pregunta','gestionarPregunta.view.php');



insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(6,14,5,1); 

update menu_item_accesos
set 
	acceso = '2'
where codigo_menu = 6 and codigo_menu_item = 13 and cargo_id = 5;

-- actualización para menú reporte

insert into menu(codigo_menu,nombre)
values(7,'Reporte')

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(7,15,'Alumno','reporteAlumno.view.php');

insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(7,15,1,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(7,15,2,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(7,15,3,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(7,15,4,1); 
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(7,15,5,1);

-- 29042020

insert into menu_item(codigo_menu,codigo_menu_item,nombre,archivo)
values(7,16,'Docente','reporteDocente.view.php');

insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(7,16,1,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(7,16,2,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(7,16,3,1);
insert into menu_item_accesos(codigo_menu,codigo_menu_item,cargo_id,acceso)
values(7,16,4,1);
--------------------

-- 03052020

insert into cargo
values(7, 'Soporte TI');
insert into menu
values(8,'Log');
insert into menu_item
values(8, 17, 'Log', 'log.view.php');
insert into menu_item_accesos
values(8, 17, 4, 1);
insert into menu_item_accesos
values(8, 17, 7, 1);

------------------------
 -- Correlativo
insert into correlativo(tabla, numero)
values('usuario',0);
insert into correlativo(tabla, numero)
values('cargo',0);
insert into correlativo(tabla, numero)
values('menu',0);
insert into correlativo(tabla, numero)
values('menu_item',0);
insert into correlativo(tabla, numero)
values('menu_item_accesos',0);
insert into correlativo(tabla, numero)
values('credenciales_acceso',0);

insert into correlativo(tabla, numero)
values('curso',0);
insert into correlativo(tabla, numero)
values('prueba',0);
insert into correlativo(tabla, numero)
values('pregunta',0);

insert into correlativo(tabla, numero)
values('anuncio',1);

insert into correlativo(tabla, numero)
values('detalle_usuario_curso_evento',0);

select * from correlativo

-- Rol
select * from usuario

insert into cargo(cargo_id, descripcion)
values(1,'Director general');
insert into cargo(cargo_id, descripcion)
values(2,'Gerente General');
insert into cargo(cargo_id, descripcion)
values(3,'Coordinadora académica');
insert into cargo(cargo_id, descripcion)
values(4,'Analista Programador');
insert into cargo(cargo_id, descripcion)
values(5,'Docente');
insert into cargo(cargo_id, descripcion)
values(6,'Estudiante');
-- Usuario

insert into usuario(doc_id,nombres,apellidos,direccion,telefono,sexo,edad,email,cargo_id)
values('45977448','Juan','Benito casas','Av. Guardia Civil, urb. Proceres #4456. Surco','996456547','M','28', 'juanBenito@hotmail.com',1);

insert into usuario(doc_id,nombres,apellidos,direccion,telefono,email,cargo_id)
values('12345678','Maria','Trinida Asusta','Av. Guardia Civil, urb. Proceres #4450. Surco','996456514','maritri@hotmail.com',2);

insert into usuario(doc_id,nombres,apellidos,direccion,telefono,sexo,edad,email,cargo_id)
values('87654321','Jacinta','Venecia Chel','Av. Guardia Civil, urb. Proceres #4455. Surco','996456522','M','24', 'jacintabe@hotmail.com',3);

-- Credenciales de acceso
insert into credenciales_acceso(codigo_usuario,clave,tipo,estado,fecha_registro,doc_id)
values(1,(select MD5('123')),'A','A',(select now()), '45977448');

insert into credenciales_acceso(codigo_usuario,clave,tipo,estado,fecha_registro,doc_id)
values(2,(select MD5('123')),'D','A',(select now()), '12345678');

insert into credenciales_acceso(codigo_usuario,clave,tipo,estado,fecha_registro,doc_id)
values(3,(select MD5('123')),'E','A',(select now()), '87654321');


select * from correlativo;

select now()
select MD5('123')

update correlativo
set numero = 3
where tabla = 'usuario';

update correlativo
set numero = 3
where tabla = 'credenciales_acceso';

update correlativo
set numero = 6
where tabla = 'cargo';
-- CONSULTAS:
select * from curso
-- registro de curso
insert into curso(curso_id, nombre_curso)
values(1,'Agile Coach');
insert into curso(curso_id, nombre_curso)
values(2,'Innovation Management');
insert into curso(curso_id, nombre_curso)
values(3,'Kanban');
insert into curso(curso_id, nombre_curso)
values(4,'Scrum Master');
insert into curso(curso_id, nombre_curso)
values(5,'Scrum Foundation');
insert into curso(curso_id, nombre_curso)
values(6,'Scrum Developer');
insert into curso(curso_id, nombre_curso)
values(7,'Scrum Advanced');
insert into curso(curso_id, nombre_curso)
values(8,'Scrum Product Owner');
insert into curso(curso_id, nombre_curso)
values(9,'Iso 27001 Auditor');
insert into curso(curso_id, nombre_curso)
values(10,'Iso 27001 Lead Auditor');
insert into curso(curso_id, nombre_curso)
values(11,'Iso 27001 Foundation');
insert into curso(curso_id, nombre_curso)
values(12,'Iso 22301 Auditor');
insert into curso(curso_id, nombre_curso)
values(13,'Iso 22301 Lead Auditor');
insert into curso(curso_id, nombre_curso)
values(14,'Iso 22301 Foundation');
insert into curso(curso_id, nombre_curso)
values(15,'Iso 20000 Auditor');
insert into curso(curso_id, nombre_curso)
values(16,'Iso 20000 Lead Auditor');
insert into curso(curso_id, nombre_curso)
values(17,'Iso 20000 Foundation');
insert into curso(curso_id, nombre_curso)
values(18,'Cybersecurity');
insert into curso(curso_id, nombre_curso)
values(19,'Six Sigma');
insert into curso(curso_id, nombre_curso)
values(20,'DevOps Essentials');
insert into curso(curso_id, nombre_curso)
values(21,'DevOps Culture');
insert into curso(curso_id, nombre_curso)
values(22,'Marketing Digital');
insert into curso(curso_id, nombre_curso)
values(23,'Big Data');
insert into curso(curso_id, nombre_curso)
values(24,'Design Thinking');
insert into curso(curso_id, nombre_curso)
values(25,'Service Desk');
insert into curso(curso_id, nombre_curso)
values(26,'Agile Business Owner');

-- ANUNCIO

insert into anuncio(anuncio_id,titulo_evento,descripcion_evento,tipo_anuncio)
values(1, 'Big Data 2020','jajknakjnkajnksnkanskas','pago');

-- PREGUNTAS

insert into 
	prueba
	(
		prueba_id,
		cant_preguntas,
		tiempo_prueba,
		puntaje_aprobacion,
		instrucciones,
		curso_id
	)
values(1,40,'15m',60, 'Responda correctamente y despacio.', 1);


-- FUNCIONES:

-- f_generar_correlativo(character varying)

 -- DROP FUNCTION f_generar_correlativo(character varying);

 CREATE OR REPLACE FUNCTION f_generar_correlativo(p_tabla character varying)
  RETURNS SETOF integer AS
 $$
	
	begin
		return query
		select 
			c.numero+1 
		from 
			correlativo c 
		where 
			c.tabla = p_tabla;
 end
 $$ language plpgsql;
 
 /* drop FUNCTION fn_registrarUsuario( integer,  character varying(20),  character varying(50),
					 character varying(50),  character varying(200), 
	 				 character varying(25),  character varying(150), 
	 				 integer,	 character(32), char(1), char(1),
	 				 integer)
*/
 -- FUNCION PARA INSERTAR USUARIO AL SISTEMA
 CREATE OR REPLACE FUNCTION fn_registrarUsuario(
					
					p_codigo_usuario integer, p_doc_id character varying(20), p_nombres character varying(50),
					p_apellidos character varying(50), p_direccion character varying(200), 
	 				p_telefono character varying(25), p_email character varying(150), 
	 				p_cargo_id integer,	p_clave character(32),p_tipo char(1),p_estado char(1),
	 				p_codigo_curso integer
					 )  RETURNS void AS   
 $$
 begin
							insert into usuario
									(
										doc_id,nombres,apellidos,direccion,
										telefono, email,cargo_id
									)
							values
								(
									p_doc_id,p_nombres,p_apellidos,p_direccion,
									p_telefono,p_email,p_cargo_id
								);
							
							insert into detalle_docente_profesor
														(
															detalle_docente_profesor_id, 
															curso_id, 
															doc_id
														)
							values(
									(select * from f_generar_correlativo('detalle_docente_profesor') as nc),
									p_codigo_curso,
									p_doc_id
								);
							
							update 
								correlativo 
							set 
								numero = numero + 1 
							where 
								tabla='detalle_docente_profesor';



-- select * from candidato                    
				
								insert into credenciales_acceso(codigo_usuario, clave,tipo,estado,fecha_registro,doc_id) 
								values (p_codigo_usuario,(select md5(p_clave)),p_tipo,p_estado,(select now()),p_doc_id);
 end
 $$ language plpgsql;
 
 select * from correlativo
 
 update correlativo
 set numero = 2
 where tabla = 'credenciales_acceso'
  -- FUNCION PARA ACTUALIZAR USUARIO AL SISTEMA
  /* drop function fn_editarUsuario
 								(
									 integer,  character varying(20), 
									 character varying(50), character varying(50), 
									 character varying(200), character varying(25), 
									 character varying(150), 
									 integer,	p_clave character(32), char(1), char(1),
									 integer
 								);
								*/
 CREATE OR REPLACE FUNCTION fn_editarUsuario
 								(
									p_codigo_usuario integer, p_doc_id character varying(20), 
									p_nombres character varying(50),p_apellidos character varying(50), 
									p_direccion character varying(200),p_telefono character varying(25), 
									p_email character varying(150), 
									p_cargo_id integer,	p_clave character(32),p_tipo char(1),p_estado char(1),
									p_codigoCurso integer
 								)RETURNS void AS
$$
declare
	
	codigo integer;
	
 begin
 							-- update usuario
 								
								update 
									usuario
								set
									doc_id    = p_doc_id,
									nombres   = p_nombres,
									apellidos = p_apellidos,
									direccion = p_direccion,
									telefono  = p_telefono,
									email     = p_email,
									cargo_id  = p_cargo_id
								where 
									doc_id = p_doc_id;
								
								-- update credenciales_acceso
 								
								update 
									credenciales_acceso
								set
									
									clave  = (select md5(p_clave)),
									tipo   = p_tipo,
									estado = p_estado,
									doc_id = p_doc_id
								where 
									doc_id = p_doc_id;
								
								select detalle_docente_profesor_id into codigo from detalle_docente_profesor where doc_id = p_doc_id;
								
								if codigo is null then
									insert into detalle_docente_profesor
														(
															detalle_docente_profesor_id, 
															curso_id, 
															doc_id
														)
									values(
											(select * from f_generar_correlativo('detalle_docente_profesor') as nc),
											p_codigoCurso,
											p_doc_id
										);
										
										update 
											correlativo 
										set 
											numero = numero + 1 
										where 
											tabla='detalle_docente_profesor';
										
								else
								
									update 
										detalle_docente_profesor
									set

										curso_id  = p_codigoCurso
									where 
										doc_id = p_doc_id;
									
								end if;
 
 
 end
 $$ language plpgsql;
 
 -- FUNCIÓN PARA ELIMINAR USUARIO
 CREATE OR REPLACE FUNCTION fn_eliminarUsuario(p_doc_id character varying(20))RETURNS void AS
 
 $$
 BEGIN
 				-- Eliminar detalle_docente_profesor
 						delete from detalle_docente_profesor
						where doc_id = p_doc_id;
						
				-- Eliminar credenciales_acceso
						delete from credenciales_acceso
						where doc_id = p_doc_id;
						
				-- Eliminar usuario
 						delete from usuario
						where doc_id = p_doc_id;
						
 end
 $$ language plpgsql;
 
 select * from curso
 -- FUNCIÓN PARA REGISTRAR EVENTO O ANUNCIO.
 /*
 CREATE OR REPLACE FUNCTION fn_registrarAnuncio
 							(
								p_curso_id integer, p_nombre_curso character varying(200),
								p_detalle_curso_evento_id integer, fecha character varying(50),
								p_evento_id integer, p_titulo_evento character varying(200),
								p_descripcion_evento character varying(500)
								
							
							)RETURNS void AS
 
 $$
 BEGIN
 	
				-- Eliminar credenciales_acceso
						insert into curso(curso_id, nombre_curso)
						values (p_curso_id,p_nombre_curso)
						
				-- Eliminar usuario
 						delete from usuario
						where doc_id = p_doc_id;
						
						
 
 end
 $$ language plpgsql;
 */
-- función para registrar o editar prueba

CREATE OR REPLACE FUNCTION fn_registrarEditarPrueba
						(
							p_prueba_id integer, 
							p_cant_preguntas character varying(4),
							p_tiempo_prueba character varying(50), 
							p_puntaje_aprobacion integer, 
							p_curso_id integer
						)returns void as
$$
begin
						IF 
							(select count(prueba_id) from prueba where curso_id = p_curso_id) = 1 then
							
							update prueba
							set 
								
								cant_preguntas 	     = p_cant_preguntas,
								tiempo_prueba		 = p_tiempo_prueba,
								puntaje_aprobacion   = p_puntaje_aprobacion
							where
								curso_id = p_curso_id;
						ELSE
							
							insert into prueba(
												prueba_id,
												cant_preguntas, 
												tiempo_prueba,
												puntaje_aprobacion,
												curso_id
											)
							values(
									p_curso_id,
									p_cant_preguntas, 
									p_tiempo_prueba,
									p_puntaje_aprobacion,
									p_curso_id
								  );
								  
						END if;

end
$$ language plpgsql;
 
select 
	* 
from 
	pregunta
declare
  -- respCandidato integer;
  -- respPregunta integer;
  puntaje_correcto_candidato double precision;
  puntaje_incorrecto_candidato double precision;
  numero_pregunta_candidato character varying(5);	
-- Función para eliminar un curso, prueba y pregunta

CREATE OR REPLACE FUNCTION fn_eliminarCursoPruebaPregunta
								(
									p_curso_id integer
									
								)returns void as

$$
declare
	
	p_prueba_id integer;
	p_pregunta_id integer;
	
begin
			-- Obtenemos el código de la prueba que pertenece a un curso y así para poder eliminarlo
				select 
					p.prueba_id into p_prueba_id
				from 
					curso c inner join prueba p
				on 
					c.curso_id = p.curso_id
				where 
					c.curso_id = p_curso_id;
			
			-- Obtenemos el código de la pregunta que pertenece a una prueba y así poder eliminarlo
				select 
					r.pregunta_id into p_pregunta_id
				from 
					prueba p inner join pregunta r
				on 
					r.prueba_id = p_prueba_id
				where 
					r.prueba_id = p_prueba_id;
					
			-- Eliminamos:
			-- pregunta
			
				delete from pregunta
				where pregunta_id = p_pregunta_id;
			
			-- prueba
			
				delete from prueba
				where prueba_id = p_prueba_id;
				
			-- curso
			
				delete from curso
				where curso_id = p_curso_id;
end
$$ language plpgsql;
	
insert into pregunta(pregunta_id,nombre_pregunta,respuesta,prueba_id)
values(1,'aaaaaaaaa', 'a', 1);

select * from pregunta

-- drop function fn_RegistrarRespuestaUsuario
-- FUNCIÓN REGISTRAR O ACTUALIZA RESPUESTA Y VERIFICAR QUE SI LA RESPUESTA ES CORRECTA
CREATE OR REPLACE FUNCTION fn_RegistrarRespuestaUsuario
									(
										p_respuesta_usuario character varying(500),
										p_pregunta_id integer,
										p_numPregunta character varying(3),
										p_doc_id character varying(20)
									)returns void as

$$
declare

	p_valor integer;
	p_respuesta_correcta character varying(500); -- respuesta de la pregunta
	-- p_respuesta_usuario char(1); -- respuesta del usuario
	p_puntaje_correcto float;    -- si respuesta pregunta == respuesta usuario ----> 1
	p_estado character varying(100); -- correcto - incorrecto
	p_correlativo integer;
	p_prueba_id integer;
	p_descripcionn character varying(200);
	-- p_numPregunta character varying(3);
	
	
				
begin
				select                         
					p.descripcion into p_descripcionn
				from 
					curso c inner join pregunta e 
				on
					c.curso_id = e.prueba_id inner join respuesta_pregunta_usuario r 
				on
					e.pregunta_id = r.pregunta_id inner join promedio p
				on 
					r.promedio_id = p.promedio_id
				where
					r.doc_id = p_doc_id
					and e.prueba_id = p_prueba_id or  r.respuesta_usuario is null;
								
				select prueba_id into p_prueba_id from pregunta where pregunta_id = p_pregunta_id;
				select count(*) into p_valor from respuesta_pregunta_usuario where pregunta_id = p_pregunta_id and doc_id = p_doc_id;
				select respuesta into p_respuesta_correcta from pregunta where pregunta_id = p_pregunta_id;
				
				
				if p_descripcionn is null then
						if p_respuesta_usuario = p_respuesta_correcta  then
							p_puntaje_correcto = 1;
							p_estado = 'Correcto';
						else
							p_puntaje_correcto = 0;
							p_estado = 'Incorrecto';
						end if;	

						-- Verificar si es para registrar o actualizar registro
						if p_valor = 1 then
							update respuesta_pregunta_usuario
							set 
								respuesta_usuario = p_respuesta_usuario,
								puntaje_correcto = p_puntaje_correcto,
								estado = p_estado
							where
								pregunta_id = p_pregunta_id
							and
								doc_id = p_doc_id;
						else
							/*insert into respuesta_pregunta_usuario
																	(
																		respuesta_pregunta_usuario_id,
																		
																		doc_id,
																		numpregunta
																	)
							values
								(
									(select * from f_generar_correlativo('respuesta_pregunta_usuario') as nc),
									p_respuesta_usuario,
									p_puntaje_correcto,
									p_estado,
									p_pregunta_id,
									p_doc_id,
									p_numPregunta
								);*/
							update 
								respuesta_pregunta_usuario
							set 
								respuesta_usuario = p_respuesta_usuario,
								puntaje_correcto = p_puntaje_correcto,
								estado = p_estado,
								pregunta_id = p_pregunta_id
							where
								doc_id = p_doc_id and
								numPregunta = p_numPregunta;
								
							update 
								correlativo 
							set 
								numero = numero + 1 
							where 
								tabla='respuesta_pregunta_usuario';
						end if;
				end if;


						-- Eliminamos los registros de las respuestas del alumno.

						 -- delete from promedio
						 -- where doc_id = '45977448';
				 
				
end
$$ language plpgsql;

select * from fn_RegistrarRespuestaUsuario
									(
										'Generar o aumentar las ventas en línea.',
										19,
										'5',
										'12345678'
									);

-- FUNCIÓN REGISTRAR caificarUsuaNull
select * from fn_numSesion
											(
												'44444444'
											);
CREATE OR REPLACE FUNCTION fn_numSesion(p_doc_id character varying(20))returns void as
$$
declare
con int;
begin
					select numiniciosesion into con from usuario where doc_id = p_doc_id;
					
					if con is null then
						
						update 
							usuario
						set 
							numiniciosesion = 0
						where 
							doc_id = p_doc_id;
							
					end if;
					
					update 
						usuario
					set 
						numiniciosesion = numiniciosesion + 1
					where 
						doc_id = p_doc_id;
end
$$ language plpgsql;

CREATE OR REPLACE FUNCTION fn_calificarExamenNull
											(
												p_doc_id character varying(20),
												p_prueba_id integer
											)returns void as
											
$$
declare
p_correlativo integer;
respUsuaNull integer;
p_porcentaje_alumno float; -- Porcentaje obtenido del examen
p_descripcion character varying(50);
p_promedio_idd float;
con int;
con2 int;
con3 int;
p_des character varying(200);
begin
							-- verifica si este algún registro de promedio
							select 
                        
								p.promedio_id into p_promedio_idd
							from 
								curso c inner join pregunta e 
							on
								c.curso_id = e.prueba_id inner join respuesta_pregunta_usuario r 
							on
								e.pregunta_id = r.pregunta_id inner join promedio p
							on 
								r.promedio_id = p.promedio_id
							where
								r.doc_id = p_doc_id
								and e.prueba_id = p_prueba_id or  r.respuesta_usuario is null;
								-- -----------------------------------------------
							select 
                        
								count(r.respuesta_usuario) into respUsuaNull
							from 
								curso c inner join pregunta e 
							on
								c.curso_id = e.prueba_id left join respuesta_pregunta_usuario r 
							on
								e.pregunta_id = r.pregunta_id left join promedio p
							on 
								r.promedio_id = p.promedio_id
							where
								r.doc_id = p_doc_id
								and e.prueba_id = p_prueba_id or  r.respuesta_usuario is null;
								
						if p_promedio_idd is null then	
							if respUsuaNull = 0 then
								
								insert into promedio
															(
																promedio_id,
																porcentaje,
																descripcion,
																doc_id
															)
								values
									(
										(select * from f_generar_correlativo('promedio') as nc),
										0,
										'Desaprobado',
										p_doc_id
									);
							else
								select * into p_correlativo from f_generar_correlativo('promedio');
								select 
									((100 * sum(puntaje_correcto))/40) into p_porcentaje_alumno
								from 
									respuesta_pregunta_usuario r inner join pregunta p
								on
									r.pregunta_id = p.pregunta_id inner join prueba u
								on
									p.prueba_id = u.prueba_id
								where
									r.doc_id = p_doc_id and u.prueba_id = p_prueba_id;

								 if p_porcentaje_alumno >= 60 then
									p_descripcion = 'Aprobado';
								else
									p_descripcion = 'Desaprobado';
								end if;

									insert into promedio(promedio_id, porcentaje, descripcion, doc_id)
									values(p_correlativo,p_porcentaje_alumno,p_descripcion, p_doc_id);
				

									update 
										respuesta_pregunta_usuario 
									set 
										promedio_id = p_correlativo,
										estadocalificado = 'Si'
									where 
										doc_id = p_doc_id;

									update 
										correlativo 
									set 
										numero = numero + 1 
									where 
										tabla='promedio';
							end if;
						end if;
						
							select numexamencalificado into con from usuario where doc_id = p_doc_id;

						if con is null then

							update 
								usuario
							set 
								numexamencalificado = 0
							where 
								doc_id = p_doc_id;

						end if;

						update 
							usuario
						set 
							numexamencalificado = numexamencalificado + 1
						where 
							doc_id = p_doc_id;
							
						-- Contador para los usuarios desaprobados
						
						select numAprobado into con2 from usuario where doc_id = p_doc_id;
						select numDesaprobado into con3 from usuario where doc_id = p_doc_id;
						select descripcion into p_des from promedio where doc_id = p_doc_id;

						if con2 is null  or con3 is null then

							update 
								usuario
							set 
								numAprobado = 0
							where 
								doc_id = p_doc_id;
								
							update 
								usuario
							set 
								numDesaprobado = 0
							where 
								doc_id = p_doc_id;

						end if;
						if p_des = 'Aprobado' then
							update 
								usuario
							set 
								numaprobado = numaprobado + 1
							where 
								doc_id = p_doc_id;
						else
							update 
								usuario
							set 
								numdesaprobado = numdesaprobado + 1
							where 
								doc_id = p_doc_id;
						end if;

end
$$ language plpgsql;

-- Eliminar registro de respuestas y promedio
CREATE OR REPLACE FUNCTION fn_eliminarRespuestaPromedio
											(
											p_doc_id character varying(20),
											p_prueba_id integer
											)returns void as
$$
declare
	contador int := 0;
	i int := 0;
	j integer := 40;
	cont character varying(3);
	p_promedio_iddd integer;
	
begin
							delete from respuesta_pregunta_usuario
							where doc_id = p_doc_id and estadoCalificado is null;
							
							select 
								distinct p.promedio_id into p_promedio_iddd
							from 
								promedio p left join respuesta_pregunta_usuario r
							on
								p.promedio_id = r.promedio_id left join pregunta e
							on 
								r.pregunta_id = e.pregunta_id
							where p.doc_id = p_doc_id and e.prueba_id = p_prueba_id or  r.respuesta_usuario is null;
							
							delete from respuesta_pregunta_usuario
							where promedio_id = p_promedio_iddd;
							
							delete from promedio
							where promedio_id = p_promedio_iddd;
							
							LOOP
								EXIT when contador >= j;
								contador = contador +1;
									insert into respuesta_pregunta_usuario(respuesta_pregunta_usuario_id, respuesta_usuario, doc_id, numpregunta)
									values
									(
										(select * from f_generar_correlativo('respuesta_pregunta_usuario') as nc),
										'falta',
										p_doc_id,
										contador
									);
									
									update 
										correlativo 
									set 
										numero = numero + 1 
									where 
										tabla='respuesta_pregunta_usuario';
								
							end loop;
								
								
							-- select * from respuesta_pregunta_usuario
							
end
$$ language plpgsql;

select * from log_inicioseseion
                    order by 
                            4
	-- select * from log_inicioseseion;
-- select * from credenciales_acceso;

CREATE OR REPLACE FUNCTION fn_insert_log_inicioseseion
											(
											p_email character varying(150),
											p_cargo character varying(50),
											p_tipo char(1),
											p_ip character varying(100)
											)returns void as
$$
declare
	p_doc_id character varying(20):= (select doc_id from usuario where email = p_email);
	p_nombres character varying(50):= (select nombres from usuario where email = p_email);
	p_apellidos character varying(50):= (select apellidos from usuario where email = p_email);
	
	-- p_cargo_id int:= (select cargo_id from cargo where doc_id = p_doc_id);
	-- p_tipo char(1):= (select tipo from credenciales_acceso where email = p_email);
	
	p_fecha character varying(50)  := current_date;
	p_tiempo character varying(50) := current_time;
begin
							
							
							insert into log_inicioseseion
							values(p_doc_id, p_nombres, p_apellidos,p_cargo,p_tipo,p_fecha,p_tiempo,p_ip);
end
$$ language plpgsql;
-- Función para insertar, actualizar o eliminar log usuario, log select * from credenciales_acceso
-- _log <-- usuario responsable de haber realizado la operación.

select * from log_usuario;
select * from log_credenciales_acceso;
select * from log_detalle_docente_profesor;

CREATE OR REPLACE FUNCTION fn_insert_log_usuario
											(
											p_doc_id_log character varying(20), 
											p_nombres_log character varying(50),
											p_apellidos_log character varying(50), 
											p_cargo_id_log int, 
											p_tipo_log char(1), 
											p_cod_usuario int,
											p_doc_id character varying(20), 
											p_nombres character varying(50),
											p_apellidos character varying(50), 
											p_direccion character varying(200), 
											p_telefono character varying(25), 
											p_email character varying(150), 
											p_cargo_id int,
											p_clave character varying(32),
											p_tipo char(1),
											p_estado char(1),
											p_codigoCurso int,
											p_tipo_operacion character varying(100),
											p_ip character varying(200)												
											)returns void as
$$
declare
	p_fecha character varying(50)  := current_date;
	p_tiempo character varying(50) := current_time;
begin
							
							-- if estado = 0 then
							
								insert into log_usuario
										(
											usuarioqueregistra_doc_id, 
											usuarioqueregistra_nombres, 
											usuarioqueregistra_apellidos, 
											usuarioqueregistra_cargo_id, 
											usuarioqueregistra_tipo,
											fecha,
											tiempo,
											doc_id, 
											nombres, 
											apellidos, 
											direccion, 
											telefono, 
											email, 
											cargo_id, 
											tipo_operacion,
											ip
										)
									values (
												p_doc_id_log, 
												p_nombres_log,
												p_apellidos_log, 
												p_cargo_id_log, 
												p_tipo_log,
												p_fecha,
												p_tiempo,
												p_doc_id, 
												p_nombres,
												p_apellidos, 
												p_direccion, 
												p_telefono, 
												p_email, 
												p_cargo_id,
												p_tipo_operacion,
												p_ip
											); 
										INSERT INTO log_credenciales_acceso
																( 
																	clave, 
																	tipo, 
																	estado, 
																	fecha_registro, 
																	doc_id
																)
										VALUES (
													p_clave, 
													p_tipo, 
													p_estado, 
													(select now()), 
													p_doc_id
												);
										
										INSERT INTO log_detalle_docente_profesor
																(
																	detalle_docente_profesor_id, 
																	curso_id,
																	doc_id
																)
										VALUES (
													(select numero from correlativo where tabla = 'detalle_docente_profesor'),
													p_codigoCurso,
													p_doc_id
												);
								
										
end
$$ language plpgsql;

-- Función para insertar, actualizar o eliminar log usuario
-- _log <-- curso responsable de haber realizado la operación.

select * from log_curso;

CREATE OR REPLACE FUNCTION fn_insert_log_curso
											(
											p_doc_id_log character varying(20), 
											p_nombres_log character varying(50),
											p_apellidos_log character varying(50), 
											p_cargo_id_log int, 
											p_tipo_log char(1), 
											p_curso_id int,
											p_nombre_curso character varying(200),
											p_tipo_operacion character varying(100),
											p_ip character varying(200)
											)returns void as
$$
declare
	p_fecha character varying(50)  := current_date;
	p_tiempo character varying(50) := current_time;
begin
							
							-- if estado = 0 then
							
								insert into log_curso
										(
											usuarioqueregistra_doc_id, 
											usuarioqueregistra_nombres,
											usuarioqueregistra_apellidos, 
											usuarioqueregistra_cargo_id, 
											usuarioqueregistra_tipo,
											fecha,
											tiempo,
											curso_id,
											nombre_curso,
											tipo_operacion,
											ip
										)
									values (
												p_doc_id_log, 
												p_nombres_log,
												p_apellidos_log, 
												p_cargo_id_log, 
												p_tipo_log,
												p_fecha,
												p_tiempo,
												p_curso_id,
												p_nombre_curso,
												p_tipo_operacion,
												p_ip
											); 
										
end
$$ language plpgsql;

-- Función para insertar, actualizar o eliminar log prueba
-- _log <-- prueba responsable de haber realizado la operación.

select * from log_prueba;
select * from correlativo;


CREATE OR REPLACE FUNCTION fn_insert_log_prueba
											(
											p_doc_id_log character varying(20), 
											p_nombres_log character varying(50),
											p_apellidos_log character varying(50), 
											p_cargo_id_log int, 
											p_tipo_log char(1), 
											p_prueba_id int,
											p_cant_preguntas character varying(4),
											p_tiempo_prueba character varying(50),
											p_puntaje_aprobacion int,
											p_curso_id int,
											p_tipo_operacion character varying(100),
											p_ip character varying(200)
											)returns void as
$$
declare
	p_fecha character varying(50)  := current_date;
	p_tiempo character varying(50) := current_time;
begin
							
							-- if estado = 0 then
							
								insert into log_prueba
										(
											usuarioqueregistra_doc_id, 
											usuarioqueregistra_nombres,
											usuarioqueregistra_apellidos, 
											usuarioqueregistra_cargo_id, 
											usuarioqueregistra_tipo,
											fecha,
											tiempo,
											prueba_id,
											cant_preguntas,
											tiempo_prueba,
											puntaje_aprobacion,
											curso_id,
											tipo_operacion,
											ip
										)
									values (
												p_doc_id_log, 
												p_nombres_log,
												p_apellidos_log, 
												p_cargo_id_log, 
												p_tipo_log,
												p_fecha,
												p_tiempo,
												p_prueba_id,
												p_cant_preguntas,
												p_tiempo_prueba,
												p_puntaje_aprobacion,
												p_curso_id,
												p_tipo_operacion,
												p_ip
											); 
										
end
$$ language plpgsql;

-- Función para insertar, actualizar o eliminar log prueba
-- _log <-- prueba responsable de haber realizado la operación.

select * from pregunta order by pregunta_id desc;
select * from log_pregunta;

update correlativo
set numero = 79
where
	tabla = 'pregunta';

CREATE OR REPLACE FUNCTION fn_insert_log_pregunta
											(
											p_doc_id_log character varying(20), 
											p_nombres_log character varying(50),
											p_apellidos_log character varying(50), 
											p_cargo_id_log int, 
											p_tipo_log char(1), 
											p_pregunta_id int,
											p_nombre_pregunta character varying(1200),
											p_alternativa1 character varying(500),
											p_alternativa2 character varying(500),
											p_alternativa3 character varying(500),
											p_alternativa4 character varying(500),
											p_respuesta character varying(500),
											p_prueba_id int,
											p_tipo_operacion character varying(100),
											p_ip character varying(200)
											)returns void as
$$
declare
	p_fecha character varying(50)  := current_date;
	p_tiempo character varying(50) := current_time;
begin
							
							-- if estado = 0 then
							
								insert into log_pregunta
										(
											usuarioqueregistra_doc_id, 
											usuarioqueregistra_nombres,
											usuarioqueregistra_apellidos, 
											usuarioqueregistra_cargo_id, 
											usuarioqueregistra_tipo,
											fecha,
											tiempo,
											pregunta_id,
											nombre_pregunta,
											alternativa1,
											alternativa2,
											alternativa3,
											alternativa4,
											respuesta,
											prueba_id,
											tipo_operacion,
											ip
										)
									values (
												p_doc_id_log, 
												p_nombres_log,
												p_apellidos_log, 
												p_cargo_id_log, 
												p_tipo_log,
												p_fecha,
												p_tiempo,
												p_pregunta_id,
												p_nombre_pregunta,
												p_alternativa1,
												p_alternativa2,
												p_alternativa3,
												p_alternativa4,
												p_respuesta,
												p_prueba_id,
												p_tipo_operacion,
												p_ip
											); 
										
end
$$ language plpgsql;

select * from fn_insert_log_pregunta
                                    (
                                        '12345678', 
										'Maria',
										'Trinida Asustaa', 
										 2, 
										'A',
										1,
										'bebecitas lindas',
										'holis1',
										'holis2',
										'holis3',
										'holis4',
										'holis1',
										22,
										'Insert'
                                    );



select * from credenciales_Acceso;

update 
	credenciales_Acceso
set 
	tipo = 'S'
where 
	doc_id = '45977448'; 

