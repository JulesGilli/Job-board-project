-- création de la base de donnée --

create database if not exists `bd_JobBoard`;

use `bd_JobBoard`;

-- création de la table People --

create table if not exists `People`(
    idP int primary key not null AUTO_INCREMENT,
    nom varchar(20) not null,
    prenom varchar(20) not null,
    mel varchar(320) not null,
    tel varchar(10) not null,
    cityP varchar(30) not null,
    cp varchar(5) not null,
    pays varchar(30) not null,
    mdp varchar(32) not null,
    cv varchar(35) null
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- création de la table Companies --

create table if not exists `Companies` (
    idC int primary key not null AUTO_INCREMENT,
    nomE varchar(50) not null,
    secteur varchar(50) not null,
    headOffice varchar(30) not null,
    taille varchar(7) not null,
    cityC varchar(30) not null
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- création de la table Advertisement --

create table if not exists `Advertisement` (
    idA int primary key not null AUTO_INCREMENT,
    title varchar(60) not null,
    descr varchar(2000) not null,
    salaire varchar(20) not null,
    typeA varchar(10) not null,
    dateA varchar(10) not null,
    workingH varchar(14) not null,
    idC int
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- création de la table Cible --

create table if not exists `Cible` (
    idA int not null,
    idP int not null,
    mess varchar(1000),
    FOREIGN KEY (idP) REFERENCES People(idP),
    FOREIGN KEY (idA) REFERENCES Advertisement(idA)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- mise en place des clés primaires dans la table Cible --

alter table `Cible` 
    add primary key (idA, idP);

-- mise en place des clés étrangères dans la table Cible --

ALTER TABLE `cible` ADD INDEX `idA` (`idA`) USING BTREE;

ALTER TABLE `cible` ADD INDEX `idP` (`idP`) USING BTREE;

-- mise en place de la clé étrangère dans la table Advertisement --

alter table `Advertisement`
    add foreign key (idC) references Companies(idC);