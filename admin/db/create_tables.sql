-- Active: 1764321134191@@127.0.0.1@3307@queso1

CREATE TABLE clientes (
  id INT NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  nombre VARCHAR(50) NOT NULL,
  apellidos VARCHAR(75) NOT NULL,
  email VARCHAR(75) NOT NULL,
  password VARCHAR(255) NOT NULL,
  genero CHAR(1) NOT NULL,
  direccion VARCHAR(100) NOT NULL,
  codpostal CHAR(5) NOT NULL,
  poblacion VARCHAR(50) NOT NULL,
  provincia VARCHAR(40) NOT NULL,
  create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uk_clientes_email (email)
)


CREATE TABLE usuarios (
  id INT NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  email VARCHAR(75) NOT NULL,
  password VARCHAR(255) NOT NULL,
  id_rol TINYINT NOT NULL,
  create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  name VARCHAR(255),
  PRIMARY KEY (id),
  CONSTRAINT fk_usuarios_roles
    FOREIGN KEY (id_rol) REFERENCES roles(id)
)

CREATE TABLE roles (
  id TINYINT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(50) NOT NULL,
  descripcion VARCHAR(255),
  create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)

CREATE TABLE permisos (
  id TINYINT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(50) NOT NULL UNIQUE,
  create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
)

CREATE TABLE roles_permisos (
  id INT NOT NULL AUTO_INCREMENT,
  rol_id TINYINT NOT NULL,
  permiso_id TINYINT NOT NULL,
  create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uk_rol_permiso (rol_id, permiso_id),
  CONSTRAINT fk_roles_permisos_rol FOREIGN KEY (rol_id) REFERENCES roles(id),
  CONSTRAINT fk_roles_permisos_permiso FOREIGN KEY (permiso_id) REFERENCES permisos(id)
)


CREATE TABLE productos (
  id INT NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(255) NOT NULL,
  precio DECIMAL(10,2) NOT NULL,
  stock INT NOT NULL,
  create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
) 


CREATE TABLE pedidos (
  id BIGINT NOT NULL AUTO_INCREMENT,
  codigo VARCHAR(255) NOT NULL,
  id_cliente INT NOT NULL,
  create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uk_pedidos_codigo (codigo),
  CONSTRAINT fk_clientes_id Foreign Key (id_cliente) REFERENCES clientes(id)
)

CREATE TABLE productos_pedidos (
  id BIGINT NOT NULL AUTO_INCREMENT,
  producto_id INT NOT NULL,
  pedido_id BIGINT NOT NULL,
  cantidad INT NOT NULL,
  precio_unitario DECIMAL(10,2) NOT NULL,
  create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY uk_producto_pedido (producto_id, pedido_id),
  CONSTRAINT fk_pp_producto
    FOREIGN KEY (producto_id) REFERENCES productos(id),
  CONSTRAINT fk_pp_pedido
    FOREIGN KEY (pedido_id) REFERENCES pedidos(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


CREATE TABLE imagenes (
    id BIGINT NOT NULL AUTO_INCREMENT,
    nombre VARCHAR(255) NOT NULL,  
    create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
)

CREATE TABLE productos_imagenes (
  producto_id INT NOT NULL,
  imagen_id BIGINT NOT NULL,
  orden INT NOT NULL,
  create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (producto_id, imagen_id),
  UNIQUE KEY uk_producto_orden (producto_id, orden),
  CONSTRAINT fk_pi_producto
    FOREIGN KEY (producto_id) REFERENCES productos(id),
  CONSTRAINT fk_pi_imagen
    FOREIGN KEY (imagen_id) REFERENCES imagenes(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



-- INSERT INTO  clientes (nombre, apellidos, email, password, genero, direccion, codpostal, poblacion,provincia)
-- VALUES ("Maria", "Sanchez", "maria@gmail.com", "123456", "M", "Pisos picados", "03185", "Torrevieja", "provincia");


