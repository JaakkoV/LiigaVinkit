USE liiga;

CREATE TABLE `Joukkueet` (
  `idJoukkueet` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `nimi` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`idJoukkueet`),
  UNIQUE KEY `idJoukkueet_UNIQUE` (`idJoukkueet`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Joukkueiden id:t ja nimet';

CREATE TABLE `Laukaisut` (
  `idLaukaisut` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pelaajaTunnus` int(10) unsigned NOT NULL,
  `top` double DEFAULT NULL,
  `lefty` double DEFAULT NULL,
  `ottelu` int(10) unsigned NOT NULL,
  `joukkue` tinyint(4) DEFAULT NULL,
  `aika` time DEFAULT NULL,
  `tulos` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idLaukaisut`),
  UNIQUE KEY `idLaukaisut_UNIQUE` (`idLaukaisut`)
) ENGINE=InnoDB AUTO_INCREMENT=180 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `Ottelut` (
  `idOttelut` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `otteluTunnus` int(5) unsigned DEFAULT NULL,
  `kotijoukkueid` tinyint(3) unsigned DEFAULT NULL,
  `vierasjoukkueid` tinyint(3) unsigned DEFAULT NULL,
  `pvm` date DEFAULT NULL,
  `yleiso` int(5) DEFAULT NULL,
  PRIMARY KEY (`idOttelut`),
  UNIQUE KEY `idOttelut_UNIQUE` (`idOttelut`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `PelaajanJoukkueet` (
  `idPelaajanJoukkueet` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pelaajatunnus` int(10) unsigned DEFAULT NULL,
  `joukkueid` tinyint(3) unsigned DEFAULT NULL,
  `alkupvm` date DEFAULT NULL,
  `loppupvm` date DEFAULT '2100-01-01',
  PRIMARY KEY (`idPelaajanJoukkueet`),
  UNIQUE KEY `idPelaajanJoukkueet_UNIQUE` (`idPelaajanJoukkueet`)
) ENGINE=InnoDB AUTO_INCREMENT=467 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Liitostaulu Pelaajat|Joukkueet valille. Pelaajan joukkueet ovat listattuna tahan tauluun aikaleimoilla. Pelaajalla voi olla monta joukkuetta ja joukkueilla monta pelaajaa. ';

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
) ENGINE=InnoDB AUTO_INCREMENT=931 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Pelaajan perustiedot';

