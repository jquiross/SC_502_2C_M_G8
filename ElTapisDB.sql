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
('juanperez', 'juan.perez@eltapis.com', 'Juan_123', 2),
('mariarodriguez', 'maria.rodriguez@eltapis.com', 'Maria_456', 2),
('luishernandez', 'luis.hernandez@eltapis.com', 'Luis_789', 2),
('anagarcia', 'ana.garcia@eltapis.com', 'Ana_012', 2),
('carlosgomez', 'carlos.gomez@eltapis.com', 'Carlos123', 1),
('lauramartinez', 'laura.martinez@eltapis.com', 'Laura456', 1),
('ImperialProvee', 'Imperial@gmail.com', 'Imperial_cerveza789', 3),
('VinosProvee', 'contacto@vinogama.com', 'Vinos_012', 3),
('WhiskeysProvee', 'contacto@whiskypremium.com', 'Whiskeys_345', 3);

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
('Château Margaux 2015', 'Vino tinto de Burdeos, Francia', 1499.99, 0.00, 1, 2, 20, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.whiskyhammer.com%2Fitem%2F160168%2FOther%2FChateau-Margaux---2015-3-x-75cl.html&psig=AOvVaw1RhIFSOdiJ7DRidReDXY-5&ust=1721856545450000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCKCHuNCNvocDFQAAAAAdAAAAABAJ'),
('Dom Pérignon Vintage 2012', 'Champán de prestigio de la región de Champagne, Francia', 2099.99, 0.00, 1, 2, 15, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.thecorkscrew.ie%2Fdom-perignon-vintage-1.html&psig=AOvVaw35V-VVeWcJ618LMAyZ2gJM&ust=1721856610250000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCPCn_-6NvocDFQAAAAAdAAAAABAJ'),
('Screaming Eagle Cabernet Sauvignon 2018', 'Vino tinto de Napa Valley, California', 3299.99, 0.00, 1, 2, 10, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.mundovini.nl%2Fen%2Fproducts%2Fscreaming-eagle-2018&psig=AOvVaw0CdooWxvl-yOJ-iARucpGy&ust=1721856651961000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCNDwyoKOvocDFQAAAAAdAAAAABAE'),
('Penfolds Grange 2016', 'Vino tinto icónico de Australia', 899.99, 0.00, 1, 2, 25, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fhic-winemerchants.com%2Fproducts%2Fpenfolds-grange-bin-95-2016&psig=AOvVaw3nV_ez69IpYnadG25Paqoj&ust=1721856694815000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCJDr-JaOvocDFQAAAAAdAAAAABAX'),
('Château d\'Yquem 2001', 'Vino de postre de Sauternes, Francia', 499.99, 0.00, 1, 2, 20, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.straussart.co.za%2Fauctions%2Flot%2F28-aug-2023-wine%2F100&psig=AOvVaw02OPto2zCGwV70lMiFe4s4&ust=1721856751241000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCOCN9bGOvocDFQAAAAAdAAAAABAK');

INSERT INTO Productos (nombre_producto, descripcion, precio, descuento, categoria_id, proveedor_id, stock, img_ruta) VALUES
('Macallan Sherry Oak 18 Years Old', 'Whisky escocés de malta de alta gama', 299.99, 0.00, 2, 3, 30, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.amathusdrinks.com%2Fb2c%2Fthe-macallan-18yr-sherry-oak-2022-release&psig=AOvVaw17SN4Im7ZFfLzlWTrTs3GR&ust=1721856834885000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCLDi49mOvocDFQAAAAAdAAAAABAR'),
('Louis XIII de Rémy Martin', 'Cognac de lujo con una mezcla de hasta 100 años', 3499.99, 0.00, 2, 3, 5, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Flacavegillet.com%2Fproducto%2Fremy-martin-louis-xiii-cognac%2F&psig=AOvVaw0R7luDNtiPioEv3eoeMFiF&ust=1721856871036000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCIicreuOvocDFQAAAAAdAAAAABAE'),
('Hennessy Paradis', 'Cognac de alta gama', 999.99, 0.00, 2, 3, 10, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.luxuryformen.com%2Fen%2Fhennessy-paradis-cognac&psig=AOvVaw3F72kqNC93upiWmALdKdGM&ust=1721856902800000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCJi5uvqOvocDFQAAAAAdAAAAABAE'),
('Pappy Van Winkle\'s Family Reserve 23 Year', 'Bourbon estadounidense raro y costoso', 2999.99, 0.00, 2, 3, 8, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwhiskyandwhiskey.com%2Fproducts%2Fpappy-van-winkles-23-year-old-family-reserve-bourbon&psig=AOvVaw2aOH24HjYxyc998PHi_I3Z&ust=1721856942302000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCMiupo6PvocDFQAAAAAdAAAAABAE'),
('Johnnie Walker Blue Label', 'Whisky escocés de lujo', 239.99, 0.00, 2, 3, 50, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fvinumcr.com%2Fproduct%2Fjohnnie-walker-blue-label-whisky%2F&psig=AOvVaw0bF-aSW8rOt5ZwP4ltD9da&ust=1721856978446000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCKiylJ6PvocDFQAAAAAdAAAAABAE');

INSERT INTO Productos (nombre_producto, descripcion, precio, descuento, categoria_id, proveedor_id, stock, img_ruta) VALUES
('Imperial', 'Cerveza rubia tipo lager, muy popular en Costa Rica', 1.50, 0.00, 3, 1, 200, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.lafatfluencer.com%2F2022%2F04%2F29%2Fcerveza-imperial-presenta-cambio-de-imagen-con-la-mirada-hacia-el-futuro%2F&psig=AOvVaw1vtmYEcHvIE2wy6YyqtVZ8&ust=1721857021767000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCJiSlrSPvocDFQAAAAAdAAAAABAE'),
('Pilsen', 'Cerveza rubia tipo pilsner, conocida en Costa Rica', 1.60, 0.00, 3, 1, 180, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.walmart.co.cr%2F15-pack-cerveza-pilsen-lata-350ml%2Fp&psig=AOvVaw2Tc58B4J-v085soMNZzCXp&ust=1721857069883000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCLDgw9OPvocDFQAAAAAdAAAAABAE'),
('Bavaria Dark', 'Cerveza oscura con un sabor robusto, de Costa Rica', 1.70, 0.00, 3, 1, 150, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fkasaicr.com%2Fproduct%2Fbavaria-dark%2F&psig=AOvVaw0NCT_ZvoK6c1e-Ur3MMW8U&ust=1721857125608000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCODGveSPvocDFQAAAAAdAAAAABAE'),
('Craft Beer Costa Rica', 'Cerveza artesanal premium de Costa Rica', 2.50, 0.00, 3, 1, 100, 'https://www.google.com/url?sa=i&url=https%3A%2F%2Fwww.facebook.com%2FLaCraftCR%2Fposts%2Fhasta-la-puerta-de-tu-casa-no-olvid%25C3%25A9s-que-tambi%25C3%25A9n-las-pod%25C3%25A9s-pedir-al-6261-2485-d%2F5253388844705640%2F&psig=AOvVaw2ONJbSluN8scJq8Bhk7AS0&ust=1721857159706000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCODNyfuPvocDFQAAAAAdAAAAABAQ');


INSERT INTO Inventario (producto_id, cantidad, fecha_actualizacion) VALUES
(1, 20, '2024-05-15 09:30:00'),
(2, 30, '2024-06-10 14:45:00'),
(3, 15, '2024-07-01 18:20:00');