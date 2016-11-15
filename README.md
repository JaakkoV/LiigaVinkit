# Tietokantasovelluksen esittelysivu

Yleisiä linkkejä:

* [Linkki etusivulle](http://jaakvirt.users.cs.helsinki.fi/liigaVinkit/)
* [Linkki muokkaus-sivulle](http://jaakvirt.users.cs.helsinki.fi/liigaVinkit/muokkaus)
* [Linkki listaus-sivulle](http://jaakvirt.users.cs.helsinki.fi/liigaVinkit/listaus)
* [Linkki tietokantatauluihin](http://jaakvirt.users.cs.helsinki.fi/liigaVinkit/tietokantayhteys)
* [Linkki dokumentaatiooni](https://github.com/JaakkoV/Tsoha-Bootstrap/blob/master/doc/Tietokantasovelluksendokumentaatio.pdf)

## Työn aihe
Harjoitustyössä toteutan web-palvelun, josta käyttäjä saa tukea vedonlyöntiinsä edistyksellisten tilastojen muodossa. Toteutuksen laajuus rajoittuu ensimmäisessä vaiheessa kotoiseen SM-liigaan (liiga.fi) Tarkoitus on tallentaa tilastoja automaattisesti tietokantaan, josta niitä on helppo kysellä ja esittää käyttäjän erinäisiin tarpeisiin. Käyttäjä saattaa esimerkiksi haluta liukuvan keskiarvon jonkun joukkueen laukauksista viimeisen 5 ottelun ajalta ja jopa vielä tietyltä laukaisusektorilta. [Päivitystä 15.11.2016: työn laajuutta tullaan sisällöltään kaventamaan, mutta ratkaisuiltaan laajentamaan, iterointi vielä kesken. Suunnitelma tulee olemaan toteutusta laajempi]

Viikko 2 palautuksen tietokantojen, dropit, luonnit ja datan lisäykset ovat kolmen tiedoston sijaan yhdessä vastaavanlaisessa dumpissa: create_from_dump.sql. Syynä on, että käytän Postgren sijaan MySQL:ää ja sain tuolla tavalla dumpin toimimaan suoraan komentotulkissa users-palvelimella.
