CREATE DATABASE IF NOT EXISTS TIC;
USE TIC;

CREATE TABLE IF NOT EXISTS stagiaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    email VARCHAR(100),
    naissance DATE,
    lieu_naissance VARCHAR(100),
    specialite ENUM('developpement web', 'multimedia', 'cyber securite', 'reseaux'),
    moyenne FLOAT,
    mention ENUM('tres bien', 'bien', 'passable', 'mediocre'),
    statut ENUM('admi', 'redoublant', 'exclu')
);
