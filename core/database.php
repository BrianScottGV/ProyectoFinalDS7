Modelo de la base de datos

CREATE DATABASE IF NOT EXISTS recomendaciones_db

USE recomendaciones_db;

-- Tabla de usuarios
CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    rol ENUM('usuario', 'admin') DEFAULT 'usuario',
    fecha_registro DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de géneros
CREATE TABLE IF NOT EXISTS generos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(50) NOT NULL UNIQUE
);

-- Tabla de contenido (películas o series)
CREATE TABLE IF NOT EXISTS contenido (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    descripcion TEXT,
    tipo ENUM('pelicula', 'serie') NOT NULL,
    fecha_lanzamiento DATE,
    fecha_creacion DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Relación N:M entre contenido y géneros
CREATE TABLE IF NOT EXISTS contenido_generos (
    contenido_id INT NOT NULL,
    genero_id INT NOT NULL,
    PRIMARY KEY (contenido_id, genero_id),
    FOREIGN KEY (contenido_id) REFERENCES contenido(id) ON DELETE CASCADE,
    FOREIGN KEY (genero_id) REFERENCES generos(id) ON DELETE CASCADE
);

-- Tabla de preferencias del usuario (géneros favoritos)
CREATE TABLE IF NOT EXISTS preferencias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    genero_id INT NOT NULL,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (genero_id) REFERENCES generos(id) ON DELETE CASCADE
);

-- Tabla de historial (contenido visto por usuario)
CREATE TABLE IF NOT EXISTS historial (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    contenido_id INT NOT NULL,
    fecha_visto DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE,
    FOREIGN KEY (contenido_id) REFERENCES contenido(id) ON DELETE CASCADE
);
