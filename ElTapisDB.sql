CREATE DATABASE ElTapisDB;

USE ElTapisDB;

-- Tabla: Roles
CREATE TABLE Roles (
    rol_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_rol VARCHAR(50) NOT NULL
);

-- Tabla: Usuarios
CREATE TABLE Usuarios (
    usuario_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_usuario VARCHAR(50) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    contraseña VARCHAR(255) NOT NULL,
    rol_id INT,
    FOREIGN KEY (rol_id) REFERENCES Roles(rol_id)
);

-- Tabla: Clientes
CREATE TABLE Clientes (
    cliente_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(usuario_id)
);

-- Tabla: Administradores
CREATE TABLE Administradores (
    administrador_id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    nombre VARCHAR(100) NOT NULL,
    apellido VARCHAR(100) NOT NULL,
    telefono VARCHAR(20),
    FOREIGN KEY (usuario_id) REFERENCES Usuarios(usuario_id)
);

-- Tabla: Proveedores
CREATE TABLE Proveedores (
    proveedor_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    direccion VARCHAR(255) NOT NULL,
    telefono VARCHAR(20),
    email VARCHAR(100) NOT NULL UNIQUE
);

-- Tabla: Categorías
CREATE TABLE Categorías (
    categoria_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_categoria VARCHAR(50) NOT NULL,
    descripcion TEXT
);

-- Tabla: Productos
CREATE TABLE Productos (
    producto_id INT AUTO_INCREMENT PRIMARY KEY,
    nombre_producto VARCHAR(100) NOT NULL,
    descripcion TEXT,
    precio DECIMAL(10, 2) NOT NULL,
    categoria_id INT,
    proveedor_id INT,
    stock INT NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES Categorías(categoria_id),
    FOREIGN KEY (proveedor_id) REFERENCES Proveedores(proveedor_id)
);

--Tabla : carrito
CREATE TABLE carrito (
    id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT,
    cantidad INT,
    FOREIGN KEY (producto_id) REFERENCES productos(producto_id)
);
-- Tabla: Pedidos
CREATE TABLE Pedidos (
    pedido_id INT AUTO_INCREMENT PRIMARY KEY,
    cliente_id INT,
    fecha_pedido DATETIME NOT NULL,
    total DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (cliente_id) REFERENCES Clientes(cliente_id)
);

-- Tabla: DetallesPedidos
CREATE TABLE DetallesPedidos (
    detalle_id INT AUTO_INCREMENT PRIMARY KEY,
    pedido_id INT,
    producto_id INT,
    cantidad INT NOT NULL,
    precio_unitario DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (pedido_id) REFERENCES Pedidos(pedido_id),
    FOREIGN KEY (producto_id) REFERENCES Productos(producto_id)
);

-- Tabla: Inventario
CREATE TABLE Inventario (
    inventario_id INT AUTO_INCREMENT PRIMARY KEY,
    producto_id INT,
    cantidad INT NOT NULL,
    fecha_actualizacion DATETIME NOT NULL,
    FOREIGN KEY (producto_id) REFERENCES Productos(producto_id)
);


-- INSERTS
INSERT INTO Roles (nombre_rol) VALUES 
('Administrador'),
('Cliente'),
('Proveedor');


INSERT INTO Usuarios (nombre_usuario, email, contraseña, rol_id) VALUES 
('admin1', 'admin1@eltapis.com', 'contraseña123', 1),
('cliente1', 'cliente1@eltapis.com', 'contraseña456', 2),
('proveedor1', 'proveedor1@eltapis.com', 'contraseña789', 3);


INSERT INTO Clientes (usuario_id, nombre, apellido, direccion, telefono) VALUES 
(2, 'Juan', 'Pérez', 'Calle Falsa 123', '555-1234');


INSERT INTO Administradores (usuario_id, nombre, apellido, telefono) VALUES 
(1, 'Carlos', 'Gómez', '555-5678');


INSERT INTO Proveedores (nombre, direccion, telefono, email) VALUES 
('Proveedor A', 'Avenida Siempre Viva 456', '555-9876', 'contacto@proveedora.com');


INSERT INTO Categorías (nombre_categoria, descripcion) VALUES 
('Electrónica', 'Productos electrónicos como teléfonos, computadoras, etc.'),
('Ropa', 'Ropa y accesorios de moda');


INSERT INTO Productos (nombre_producto, descripcion, precio, categoria_id, proveedor_id, stock) VALUES 
('Smartphone X', 'Teléfono inteligente con pantalla de 6.5 pulgadas', 699.99, 1, 1, 50),
('Camisa Casual', 'Camisa de algodón para uso diario', 29.99, 2, NULL, 100);


INSERT INTO Pedidos (cliente_id, fecha_pedido, total) VALUES 
(1, '2024-07-22 10:00:00', 699.99);


INSERT INTO DetallesPedidos (pedido_id, producto_id, cantidad, precio_unitario) VALUES 
(1, 1, 1, 699.99);


INSERT INTO Inventario (producto_id, cantidad, fecha_actualizacion) VALUES 
(1, 50, '2024-07-22 10:00:00'),
(2, 100, '2024-07-22 10:00:00');