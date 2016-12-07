USE liiga;

CREATE TABLE `Joukkueet` (
  `idJoukkueet` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nimi` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idJoukkueet`),
  UNIQUE KEY `idJoukkueet_UNIQUE` (`idJoukkueet`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Joukkueiden id:t ja nimet';

CREATE TABLE `Laukaisut` (
  `idLaukaisut` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pelaajaTunnus` int(10) unsigned NOT NULL,
  `top` double DEFAULT NULL,
  `lefty` double DEFAULT NULL,
  `otteluTunnus` int(10) unsigned NOT NULL,
  `joukkue` tinyint(4) DEFAULT NULL,
  `aika` time DEFAULT NULL,
  `tulos` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idLaukaisut`),
  UNIQUE KEY `idLaukaisut_UNIQUE` (`idLaukaisut`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `Ottelut` (
  `idOttelut` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `otteluTunnus` int(5) unsigned DEFAULT NULL,
  `kotijoukkueid` tinyint(3) unsigned DEFAULT NULL,
  `vierasjoukkueid` tinyint(3) unsigned DEFAULT NULL,
  `pvm` date DEFAULT NULL,
  `yleiso` int(5) DEFAULT NULL,
  PRIMARY KEY (`idOttelut`),
  UNIQUE KEY `idOttelut_UNIQUE` (`idOttelut`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `PelaajanJoukkueet` (
  `idPelaajanJoukkueet` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pelaajatunnus` int(10) unsigned DEFAULT NULL,
  `joukkueid` tinyint(3) unsigned DEFAULT NULL,
  `alkupvm` date DEFAULT NULL,
  `loppupvm` date DEFAULT '2100-01-01',
  PRIMARY KEY (`idPelaajanJoukkueet`),
  UNIQUE KEY `idPelaajanJoukkueet_UNIQUE` (`idPelaajanJoukkueet`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liitostaulu Pelaajat|Joukkueet valille. Pelaajan joukkueet ovat listattuna tahan tauluun aikaleimoilla. Pelaajalla voi olla monta joukkuetta ja joukkueilla monta pelaajaa. ';

CREATE TABLE `Pelaajat` (
  `idPelaajat` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pelaajaTunnus` int(10) unsigned DEFAULT NULL,
  `joukkueid` tinyint(3) unsigned NOT NULL,
  `etunimi` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `sukunimi` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `kausi` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `pelipaikka` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `syntymaaika` date NOT NULL,
  `maila` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `paino` smallint(5) unsigned NOT NULL,
  `pituus` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`idPelaajat`),
  UNIQUE KEY `idPelaajat_UNIQUE` (`idPelaajat`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Pelaajan perustiedot';

CREATE TABLE `Kayttaja` (
  `idKayttaja` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kayttajatunnus` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `etunimi` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `sukunimi` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `salasana` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `kayttajaryhma` tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (`idKayttaja`),
  UNIQUE KEY `idKayttaja_UNIQUE` (`idKayttaja`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Kayttajan tiedot\n';


CREATE TABLE `KayttajanPelaajat` (
  `idKayttajanPelaajat` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `kayttajaId` int(10) unsigned NOT NULL,
  `pelaajaTunnus` int(10) unsigned NOT NULL,
  `alkupvm` date DEFAULT NULL,
  `loppupvm` date DEFAULT NULL,
  PRIMARY KEY (`idKayttajanPelaajat`),
  UNIQUE KEY `idKayttajanPelaajat_UNIQUE` (`idKayttajanPelaajat`)
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


