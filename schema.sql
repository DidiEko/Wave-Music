-- -----------------------------------------------------
-- Base de données : WAVE
-- -----------------------------------------------------

CREATE DATABASE IF NOT EXISTS wave CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE wave;

-- -----------------------------------------------------
-- Table utilisateurs administrateurs
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL, -- à remplacer par password_hash()
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- -----------------------------------------------------
-- Table artistes
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS artists (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    bio TEXT,
    image_url VARCHAR(255),
    is_spotlight BOOLEAN DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- -----------------------------------------------------
-- Table sons
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS songs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    artist_id INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    url VARCHAR(255),
    rank INT DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (artist_id) REFERENCES artists(id) ON DELETE CASCADE
);

-- -----------------------------------------------------
-- Table sondages
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS polls (
    id INT AUTO_INCREMENT PRIMARY KEY,
    type ENUM('artist','top10') NOT NULL,
    question VARCHAR(255) NOT NULL,
    starts_at DATE,
    ends_at DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- -----------------------------------------------------
-- Options de sondages
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS poll_options (
    id INT AUTO_INCREMENT PRIMARY KEY,
    poll_id INT NOT NULL,
    option_text VARCHAR(150) NOT NULL,
    votes INT DEFAULT 0,
    FOREIGN KEY (poll_id) REFERENCES polls(id) ON DELETE CASCADE
);

-- -----------------------------------------------------
-- Résultats Top 10
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS top10_results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    poll_id INT NOT NULL,
    rank INT NOT NULL,
    artist VARCHAR(100) NOT NULL,
    song VARCHAR(150) NOT NULL,
    FOREIGN KEY (poll_id) REFERENCES polls(id) ON DELETE CASCADE
);

-- -----------------------------------------------------
-- Table concerts / agenda
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    location VARCHAR(150),
    date DATE NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- -----------------------------------------------------
-- Table chipies (actu / gossip)
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS chipies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(150) NOT NULL,
    body TEXT NOT NULL,
    image_url VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- -----------------------------------------------------
-- Table newsletter
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS newsletter_subs (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(150) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
