CREATE DATABASE tienda_master;

use tienda_master;

CREATE TABLE usuarios(
    id_usuario      INT(255) auto_increment NOT NULL,
    nombre          VARCHAR(100) NOT NULL,
    apellidos       VARCHAR(255),
    correo          VARCHAR(255) NOT NULL,
    pass            VARCHAR(255) NOT NULL,
    rol             VARCHAR(20),
    imagen          VARCHAR(255),
    CONSTRAINT pk_usuarios PRIMARY KEY(id_usuario),
    CONSTRAINT uq_correo UNIQUE(correo) 
)ENGINE=InnoDb; 

INSERT INTO usuarios VALUES (NULL, "admin", "admin", "admin@admin.com", "123", "Administrador", NULL) 

CREATE TABLE categorias(
    id_categoria    INT(255) auto_increment NOT NULL,
    nombre          VARCHAR(255) NOT NULL,
    CONSTRAINT pk_categorias PRIMARY KEY(id_categoria)
)ENGINE=InnoDb;

INSERT INTO categorias VALUES (NULL, "Manga Corta");
INSERT INTO categorias VALUES (NULL, "Musculosa");
INSERT INTO categorias VALUES (NULL, "Escote en V");
INSERT INTO categorias VALUES (NULL, "Manga Larga");
INSERT INTO categorias VALUES (NULL, "Lisa");

CREATE TABLE productos(
    id_producto     INT(255) auto_increment NOT NULL,
    categoria_id    INT(255) NOT NULL,
    nombre          VARCHAR(255) NOT NULL,
    descripcion     TEXT,
    precio          FLOAT(100, 2) NOT NULL,
    stock           INT(255) NOT NUll,
    oferta          VARCHAR(2),
    fecha_i         DATE NOT NULL,
    imagen          VARCHAR(255),
    CONSTRAINT pk_productos PRIMARY KEY(id_producto),
    CONSTRAINT fk_productos_categorias FOREIGN KEY(categoria_id) REFERENCES categorias(id_categoria)
)ENGINE=InnoDb;

-- INSERT INTO productos VALUES(NULL, 5, "Remeras Deportivas", "Remeras de algodon lisa para deportes", 450,99, 300, "No", )

CREATE TABLE pedidos(
    id_pedido       INT(255) auto_increment NOT NULL,
    usuario_id      INT(255) NOT NULL,
    provincia       VARCHAR(255) NOT NULL,
    localidad       VARCHAR(255) NOT NULL,
    direccion       VARCHAR(255) NOT NULL,
    costo           FLOAT(100, 2) NOT NULL,
    estado          VARCHAR(30) NOT NULL,
    fecha           DATE NOT NULL,
    hora            TIME NOT NULL,
    CONSTRAINT pk_pedidos PRIMARY KEY(id_pedido),
    CONSTRAINT fk_pedidos_usuarios FOREIGN KEY(usuario_id) REFERENCES usuarios(id_usuario)
)ENGINE=Innodb;

CREATE TABLE lineas_pedidos(
    id_linea_pedido INT(255) auto_increment NOT NULL,
    pedido_id       INT(255) NOT NULL,
    producto_id     INT(255) NOT NULL,
    unidades        INT(255) NOT NULL,
    CONSTRAINT pk_lineas_pedidos PRIMARY KEY(id_linea_pedido),
    CONSTRAINT fk_lineas_pedidos_pedidos FOREIGN KEY(pedido_id) REFERENCES pedidos(id_pedido),
    CONSTRAINT fk_lineas_pedidos_productos FOREIGN KEY(producto_id) REFERENCES productos(id_producto)
)ENGINE=InnoDb;