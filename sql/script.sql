

DROP DATABASE IF EXISTS Ferme;

CREATE DATABASE Ferme;

use Ferme;

CREATE TABLE ferme_user (
    id_user INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    first_name VARCHAR(255) NOT NULL,
    role ENUM('Admin', 'User') NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    phone_number VARCHAR(20) NOT NULL
);

CREATE TABLE ferme_gestion_capitaux (
    id_capitaux INT PRIMARY KEY AUTO_INCREMENT,
    montant DECIMAL(10, 2) NOT NULL,
    capitaux_date Date,
    id_user INT,
    FOREIGN KEY (id_user) REFERENCES ferme_user (id_user)
);

CREATE TABLE ferme_type_animal (
    id_typeAnimal INT PRIMARY KEY AUTO_INCREMENT,
    espece VARCHAR(100) NOT NULL,
    image VARCHAR(100) NOT NULL,
    poids_minimal_vente DECIMAL(10, 2) NOT NULL,
    poids_maximal DECIMAL(10, 2) NOT NULL,
    prix_achat DECIMAL(10,2) NOT NULL,
    prix_vente_kg DECIMAL(10, 2) NOT NULL,
    poids_initial DECIMAL(10,2) NOT NULL,
    jours_sans_manger INT NOT NULL,
    perte_poids_jour DECIMAL(5, 2) NOT NULL,
    consommation_jour DECIMAL(5, 2) NOT NULL
);

CREATE TABLE ferme_animal (
    id_animal INT PRIMARY KEY AUTO_INCREMENT,
    id_typeAnimal INT NOT NULL,
    FOREIGN KEY (id_typeAnimal) REFERENCES ferme_type_animal (id_typeAnimal)
);

CREATE TABLE ferme_alimentation (
    id_alimentation INT PRIMARY KEY AUTO_INCREMENT,
    image VARCHAR(100) NOT NULL,

    id_typeAnimal INT NOT NULL,
    prix_achat DECIMAL(10,2) NOT NULL,
    nom VARCHAR(100) NOT NULL,
    pourcentage_gain DECIMAL(5, 2) NOT NULL,
    poids DECIMAL(10, 2) NOT NULL,
    quantiteKg DECIMAL(5, 2) NOT NULL,
    FOREIGN KEY (id_typeAnimal) REFERENCES ferme_type_animal (id_typeAnimal)
);

CREATE TABLE ferme_achat_alimentation (
    id_achatAlimentation INT PRIMARY KEY AUTO_INCREMENT,
    id_alimentation INT NOT NULL,
    quantiteKg DECIMAL(5, 2) NOT NULL,
    id_user INT,
    FOREIGN KEY (id_user) REFERENCES ferme_user (id_user),
    FOREIGN KEY (id_alimentation) REFERENCES ferme_alimentation (id_alimentation)
);

CREATE TABLE ferme_achat_animal (
    id_achatAnimal INT PRIMARY KEY AUTO_INCREMENT,
    id_animal INT NOT NULL,
    prix DECIMAL(10, 2) NOT NULL,
    date_achat DATE NOT NULL,
    id_user INT,
    FOREIGN KEY (id_user) REFERENCES ferme_user (id_user),
    FOREIGN KEY (id_animal) REFERENCES ferme_animal (id_animal)
);

CREATE TABLE ferme_vente_animal (
    id_venteAnimal INT PRIMARY KEY AUTO_INCREMENT,
    id_animal INT NOT NULL,
    poids_vente DECIMAL(10, 2) NOT NULL,
    prix_vente DECIMAL(10, 2) NOT NULL,
    date_vente DATE NOT NULL,
    id_user INT,
    FOREIGN KEY (id_user) REFERENCES ferme_user (id_user),
    FOREIGN KEY (id_animal) REFERENCES ferme_animal (id_animal)
);