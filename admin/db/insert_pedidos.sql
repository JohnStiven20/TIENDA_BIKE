INSERT INTO roles (nombre, descripcion) VALUES
('ADMIN', 'Administrador del sistema'),
('USER', 'Usuario estándar');

INSERT INTO permisos (nombre) VALUES
('CREAR_PRODUCTO'),
('EDITAR_PRODUCTO'),
('ELIMINAR_PRODUCTO'),
('VER_PEDIDOS'),
('GESTIONAR_USUARIOS');


INSERT INTO roles_permisos (rol_id, permiso_id) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 4);


INSERT INTO usuarios (email, password, id_rol, name) VALUES
('admin@queso.com', 'admin123', 1, 'Administrador'),
('user@queso.com', 'user123', 2, 'Usuario Normal');


INSERT INTO clientes 
(nombre, apellidos, email, password, genero, direccion, codpostal, poblacion, provincia)
VALUES
('Maria', 'Sanchez', 'maria@gmail.com', '123456', 'M', 'Pisos Picados', '03185', 'Torrevieja', 'Alicante'),
('Juan', 'Perez', 'juan@gmail.com', '123456', 'H', 'Calle Mayor 10', '28001', 'Madrid', 'Madrid'),
('Laura', 'Gomez', 'laura@gmail.com', '123456', 'M', 'Avenida Sol 5', '08001', 'Barcelona', 'Barcelona');




INSERT INTO productos (nombre, precio, stock) VALUES
('Queso Manchego', 12.50, 100),
('Queso Azul', 9.90, 50),
('Queso Cabra', 8.75, 80);

INSERT INTO pedidos (codigo, id_cliente) VALUES
('PED-001', 1),
('PED-002', 2),
('PED-003', 1),
('PED-004', 2),
('PED-005', 1),
('PED-006', 2),
('PED-007', 1),
('PED-008', 2);
('PED-009', 1),
('PED-010', 2),
('PED-011', 1),
('PED-012', 2),
('PED-013', 1),
('PED-014', 2),
('PED-015', 1),
('PED-016', 2);

INSERT INTO productos_pedidos (producto_id, pedido_id, cantidad, precio_unitario) VALUES
(1, 1, 2, 12.50),
(2, 1, 1, 9.90),
(3, 2, 3, 8.75);


INSERT INTO imagenes (nombre) VALUES
('manchego.jpg'),
('azul.jpg'),
('cabra.jpg');

INSERT INTO productos_imagenes (producto_id, imagen_id, orden) VALUES
(1, 1, 1),
(2, 2, 1),
(3, 3, 1);
