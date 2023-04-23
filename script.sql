CREATE TABLE annonces (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
type_animal VARCHAR(30) NOT NULL,
etat_animal VARCHAR(30) NOT NULL,
ville VARCHAR(30) NOT NULL,
secteur VARCHAR(30) NOT NULL,
date VARCHAR(30) NOT NULL,
heure VARCHAR(30) NOT NULL,
nom_animal VARCHAR(30) NOT NULL,
caracteristiques TEXT,
photo_animal VARCHAR(255),
nom_proprietaire VARCHAR(30) NOT NULL,
email VARCHAR(50) NOT NULL,
telephone VARCHAR(20) NOT NULL,
facebook VARCHAR(50)
);