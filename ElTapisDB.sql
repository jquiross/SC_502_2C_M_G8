Create  DATABASE ElTapisDB;

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
    descuento DECIMAL(10, 2) NOT NULL,
    categoria_id INT,
    proveedor_id INT,
    stock INT NOT NULL,
    img_ruta VARCHAR(1000) NOT NULL,
    FOREIGN KEY (categoria_id) REFERENCES Categorías(categoria_id),
    FOREIGN KEY (proveedor_id) REFERENCES Proveedores(proveedor_id)
);

 -- Tabla:carrito
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
('juanperez', 'juan.perez@eltapis.com', '7d66743e1971c59a9235197c71031f05', 2),  -- Juan_123
('mariarodriguez', 'maria.rodriguez@eltapis.com', '9a220942e90268625fd96c57e259c9a3', 2), -- Maria_456
('luishernandez', 'luis.hernandez@eltapis.com', '25e2fbc0745229f7b2bd809f7d98e9ef', 2), -- Luis_789
('anagarcia', 'ana.garcia@eltapis.com', 'eb3c80064c821afb0936b105b04f1a45', 2), -- Ana_012
('carlosgomez', 'carlos.gomez@eltapis.com', 'bba020785cd36a52df715bb06cf30071', 1), -- Carlos123
('lauramartinez', 'laura.martinez@eltapis.com', '1dee7f215a368f499de8ac3fe6182bc7', 1),-- Laura456
('ImperialProvee', 'Imperial@gmail.com', '0b6c964828ab074c1adde2e379106254', 3),-- Imperial_cerveza789
('VinosProvee', 'contacto@vinogama.com', '6f68080cc623ba4427d9e50f6b872df2', 3),-- Vinos_012
('WhiskeysProvee', 'contacto@whiskypremium.com', 'ad05847ec42cfaf16cee62b0557efc1d', 3);-- Whiskeys_345

INSERT INTO Clientes (usuario_id, nombre, apellido, direccion, telefono) VALUES
(1, 'Juan', 'Pérez', 'San José', '8812-1234'),
(2, 'María', 'Rodríguez', 'Alajuela', '8238-6789'),
(3, 'Luis', 'Hernández', 'Heredia', '8888-2345'),
(4, 'Ana', 'García', 'Cartago', '8789-3456');

INSERT INTO Administradores (usuario_id, nombre, apellido, telefono) VALUES
(5, 'Carlos', 'Gómez', '8888-5678'),
(6, 'Laura', 'Martínez', '8478-4567');

INSERT INTO Proveedores (nombre, direccion, telefono, email) VALUES
('Imperial', 'San José', '8341-9876', 'Imperial@gmail.com'),
('Proveedor de Vinos de Alta Gama', 'Alajuela', '8528-4321', 'contacto@vinogama.com'),
('Proveedor de Whiskies Premium', 'Heredia', '8896-5432', 'contacto@whiskypremium.com');

INSERT INTO Categorías (nombre_categoria, descripcion) VALUES 
('Vinos', 'Vinos de alta gama de diferentes regiones del mundo');
INSERT INTO Categorías (nombre_categoria, descripcion) VALUES 
('Bebidas Alcohólicas de Alta Gama', 'Bebidas alcohólicas de lujo como whiskies, cognacs, y bourbons');
INSERT INTO Categorías (nombre_categoria, descripcion) VALUES 
('Cerveza Nacional', 'Cervezas de Costa Rica');

INSERT INTO Productos (nombre_producto, descripcion, precio, descuento, categoria_id, proveedor_id, stock, img_ruta) VALUES
('Château Margaux 2015', 'Vino tinto de Burdeos, Francia', 1499.99, 0.00, 1, 2, 20, 'https://i.imgur.com/9sdniR8.png'),
('Dom Pérignon Vintage 2012', 'Champán de prestigio de la región de Champagne, Francia', 2099.99, 0.00, 1, 2, 15, 'https://i.imgur.com/laSGa4i.png'),
('Screaming Eagle Cabernet Sauvignon 2018', 'Vino tinto de Napa Valley, California', 3299.99, 0.00, 1, 2, 10, 'https://i.imgur.com/fcUTeUP.png'),
('Penfolds Grange 2016', 'Vino tinto icónico de Australia', 899.99, 0.00, 1, 2, 25, 'https://i.imgur.com/clJHHYt.png'),
('Château d\'Yquem 2001', 'Vino de postre de Sauternes, Francia', 499.99, 0.00, 1, 2, 20, 'https://i.imgur.com/URT2NVf.png');

INSERT INTO Productos (nombre_producto, descripcion, precio, descuento, categoria_id, proveedor_id, stock, img_ruta) VALUES
('Macallan Sherry Oak 18 Years Old', 'Whisky escocés de malta de alta gama', 299.99, 0.00, 2, 3, 30, 'https://i.imgur.com/o2zWbGl.png'),
('Louis XIII de Rémy Martin', 'Cognac de lujo con una mezcla de hasta 100 años', 3499.99, 0.00, 2, 3, 5, 'https://i.imgur.com/oz471DU.png'),
('Hennessy Paradis', 'Cognac de alta gama', 999.99, 0.00, 2, 3, 10, 'https://i.imgur.com/AHKJmgO.png'),
('Pappy Van Winkle\'s Family Reserve 23 Year', 'Bourbon estadounidense raro y costoso', 2999.99, 0.00, 2, 3, 8, 'https://i.imgur.com/aTLzUjN.png'),
('Johnnie Walker Blue Label', 'Whisky escocés de lujo', 239.99, 0.00, 2, 3, 50, 'https://i.imgur.com/fs6mOvX.png');

INSERT INTO Productos (nombre_producto, descripcion, precio, descuento, categoria_id, proveedor_id, stock, img_ruta) VALUES
('Imperial', 'Cerveza rubia tipo lager, muy popular en Costa Rica', 1.50, 0.00, 3, 1, 200, 'https://i.imgur.com/GYe7lqH.png'),
('Pilsen', 'Cerveza rubia tipo pilsner, conocida en Costa Rica', 1.60, 0.00, 3, 1, 180, 'https://i.imgur.com/RbDesjv.png'),
('Bavaria Dark', 'Cerveza oscura con un sabor robusto, de Costa Rica', 1.70, 0.00, 3, 1, 150, 'https://i.imgur.com/fQCjcnc.png'),
('Craft Beer Costa Rica', 'Cerveza artesanal premium de Costa Rica', 2.50, 0.00, 3, 1, 100, 'https://i.imgur.com/hwyQZ9f.png');


INSERT INTO Inventario (producto_id, cantidad, fecha_actualizacion) VALUES
(1, 20, '2024-05-15 09:30:00'),
(2, 30, '2024-06-10 14:45:00'),
(3, 15, '2024-07-01 18:20:00');