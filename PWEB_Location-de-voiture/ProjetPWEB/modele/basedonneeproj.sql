

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


CREATE TABLE IF NOT EXISTS `Client`(
   `idClient` INT(11) NOT NULL AUTO_INCREMENT,
   `nom` VARCHAR(50) NOT NULL,
   `mdp` VARCHAR(50) NOT NULL,
   `email` VARCHAR(50) NOT NULL,
   PRIMARY KEY(`idClient`)
)ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=73 ;

CREATE TABLE IF NOT EXISTS `facturation`(
   `idFacturation` INT(11) AUTO_INCREMENT,
   `dateDebut` DATE NOT NULL,
   `valeur` FLOAT(2) NOT NULL,
   `dateFin` DATE DEFAULT NULL,
   `etat` BOOLEAN,
   `idVehicule` INT(11) NOT NULL,
   `idClient` INT(11) NOT NULL,
   PRIMARY KEY(`idFacturation`, `dateDebut`),
   KEY `idVehicule`(`idVehicule`),
   KEY `idClient` (`idClient`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=73;

CREATE TABLE IF NOT EXISTS `loueur`(
   `idLoueur` INT(11) AUTO_INCREMENT,
   `nomLoueur` VARCHAR(50) NOT NULL,
   `mdpLoueur` VARCHAR(50) NOT NULL UNIQUE,
   `emailLoueur` VARCHAR(50) NOT NULL UNIQUE,
   PRIMARY KEY(`idLoueur`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=73;

CREATE TABLE IF NOT EXISTS `Vehicule`(
   `idVehicule` INT(11) AUTO_INCREMENT,
   `typeVehicule` VARCHAR(50) NOT NULL,
   `nbVehicule` INT,
   `caract` text COLLATE utf8_bin NOT NULL,
   `location` VARCHAR(50) NOT NULL,
   `prix` FLOAT(2) NOT NULL,
   `photo` BLOB,
   `idLoueur` INT(11) NOT NULL,
   `idClient` INT(11),
   PRIMARY KEY(`idVehicule`),
   KEY `idLoueur`(`idLoueur`),
   KEY `idClient`(`idClient`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=73;



INSERT INTO `loueur` (`idLoueur`, `nomLoueur`, `mdpLoueur`, `emailLoueur`) VALUES 
(1, 'Berger', '74U6YidAt','jberger@free.fr');


INSERT INTO `Client` (`idCLient`, `nom`, `mdp`, `email`) VALUES

(1, 'Suly', 'e7yabzB1g5Ink', 'suly@free.fr'),
(2, 'Pinson', '6f.GBojfb9XWA', 'pinson.martha@yahoo.fr'),
(3, 'Emery', '2coXXuq2ZDjT.', 'emery@gmail.com'),
(4, 'Daire', '2akkshins72fA', 'pauledaire@gmail.com'),
(5, 'Yart', 'd7VnhQweQY.hY', 'm.yart@free.fr');


INSERT INTO `Vehicule` (`idVehicule`, `typeVehicule`, `nbVehicule`, `caract`, `location`, `prix`, `photo`, `idLoueur`, `idCLient`) VALUES 

(1, 'Clio', 5, '{"moteur":"hybride","vitesse":"automatique","places":5}', 'non_disponible', 12, './vue/images/voitures/clio.jpg', 1, 2),
(2, 'Megane',3, '{"moteur":"electrique","vitesse":"automatique","places":5}', 'non_disponible', 14, './vue/images/voitures/megane.jpg', 1, 5),
(3, 'Twingo', 2,  '{"moteur":"electrique","vitesse":"automatique","places":5}', 'non_disponible', 11, './vue/images/voitures/twingo.jpg', 1, 5),
(4, 'Golf', 7, '{"moteur":"diesel","vitesse":"manuelle","places":5}', 'non_disponible', 10, './vue/images/voitures/golf.jpg', 1, 1),
(5, 'Polo', 6, '{"moteur":"diesel","vitesse":"automatique","places":5}', 'disponible', 20, './vue/images/voitures/polo.jpg', 1, null),
(6, 'Corsa', 3, '{"moteur":"diesel","vitesse":"automatique","places":5}', 'non_disponible', 17, './vue/images/voitures/corsa.jpg', 1, 2),
(7, 'Astra', 2, '{"moteur":"diesel","vitesse":"automatique","places":5}', 'disponible', 13, './vue/images/voitures/astra.jpg', 1, null),
(8, '207', 6, '{"moteur":"essence","vitesse":"manuelle","places":5}', 'disponible', 16, './vue/images/voitures/207.jpg', 1, null),
(9, 'Fiesta', 2, '{"moteur":"electrique","vitesse":"automatique","places":5}', 'non_disponible', 15, './vue/images/voitures/fiesta.jpg', 1, 3),
(10, '208', 5, '{"moteur":"diesel","vitesse":"automatique","places":5}', 'non_disponible', 14, './vue/images/voitures/208.jpg', 1, 1);



INSERT INTO `facturation` (`idFacturation`, `dateDebut`, `valeur`, `dateFin`, `etat`, `idVehicule`, `idCLient`) VALUES  

(1, '2020/02/26', 900, '2020/06/26', 1, 9, 3),
(2, '2019/12/15', 2100, '2020/05/01', 1, 10, 1),
(3, '2020/08/07', 1260, '2020/11/15', 0, 2, 5),
(4, '2020/08/01', 2100, '2022/06/01', 1, 10, 1),
(5, '2018/08/15', 780, '2020/02/30', 1, 7, 5),
(6, '2020/03/22', 1800, '2020/06/26', 1, 1, 3),
(7, '2019/10/05', 1530, '2020/12/01', 1, 6, 2),
(8, '2020/01/16', 2880, '2020/05/25', 1, 8, 4),
(9, '2019/10/01', 2100, '2022/06/30', 1, 4, 1),
(10, '2020/08/05', 660, null, 0, 3, 5),
(11, '2020/06/28', 1800, '2020/12/22', 1, 1, 2),
(12, '2020/08/15', 900, '2021/1/10', 0, 9, 3);










