SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- Tabla de usuario (solo vos)
CREATE TABLE usuarios (
  id int(11) NOT NULL AUTO_INCREMENT,
  nombre varchar(50) NOT NULL,
  email varchar(100) NOT NULL,
  password varchar(255) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insertamos tu usuario (puedes cambiar los datos)
INSERT INTO usuarios (nombre, email, password) VALUES
('Dennis', 'admin@dmproducciones.com', MD5('94185133De'));

-- Tabla de portafolio de imágenes
DROP TABLE IF EXISTS portafolios;
CREATE TABLE portafolios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  titulo VARCHAR(255),
  descripcion TEXT,
  imagen1 VARCHAR(255),
  imagen2 VARCHAR(255),
  imagen3 VARCHAR(255),
  imagen4 VARCHAR(255),
  imagen5 VARCHAR(255),
  imagen6 VARCHAR(255),
  imagen7 VARCHAR(255),
  imagen8 VARCHAR(255),
  imagen9 VARCHAR(255),
  imagen10 VARCHAR(255),
  fecha_subida TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
COMMIT;