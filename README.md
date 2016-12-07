# Tietokantasovelluksen esittelysivu

## Yleisiä linkkejä:
Dokumentaatio:
* [Linkki dokumentaatiooni](https://github.com/JaakkoV/Tsoha-Bootstrap/blob/master/doc/Tietokantasovelluksendokumentaatio.pdf) / Työn aihetta viilattu melko rajusti kolmannella viikolla. Dokumentaatio ajan tasalla kohtaan 5 asti (07.12.2016)

Sovellus:
* [Linkki etusivulle](http://jaakvirt.users.cs.helsinki.fi/liigaVinkit/) Dummy
* Kirjautumiseen voi käyttää seuraavia tunnuksia (useampia tulevaisuuden käyttäjäryhmien testausta varten)

| käyttäjätunnus| salasana      | ryhmä |
| ------------- |:-------------:| -----:|
| nicki         | 123           |   3   |
| nacki         | 321           |   2   |
| kuka          |               |   0   |

Kirjautuneella käyttäjällä on eri näkymät kuin kirjautumattomalla.

## Työn aihe
Työssä toteutan työkalun jääkiekko-otteluiden laukaisukartan esittämiseen. Käyttäjä voi valita haluamiensa kriteerien mukaan esitettävät laukaisut koordinaatteina jääkiekkokaukalossa.

## Palautuksia / Repon evolvoiminen
### Viikko 1
Harjoitustyössä toteutan web-palvelun, josta käyttäjä saa tukea vedonlyöntiinsä edistyksellisten tilastojen muodossa. Toteutuksen laajuus rajoittuu ensimmäisessä vaiheessa kotoiseen SM-liigaan (liiga.fi) Tarkoitus on tallentaa tilastoja automaattisesti tietokantaan, josta niitä on helppo kysellä ja esittää käyttäjän erinäisiin tarpeisiin. Käyttäjä saattaa esimerkiksi haluta liukuvan keskiarvon jonkun joukkueen laukauksista viimeisen 5 ottelun ajalta ja jopa vielä tietyltä laukaisusektorilta. [Päivitystä 15.11.2016: työn laajuutta tullaan sisällöltään kaventamaan, mutta ratkaisuiltaan laajentamaan, iterointi vielä kesken. Suunnitelma tulee olemaan toteutusta laajempi]

### Viikko 2
palautuksen tietokantojen, dropit, luonnit ja datan lisäykset ovat kolmen tiedoston sijaan yhdessä vastaavanlaisessa dumpissa: create_from_dump.sql. Syynä on, että käytän Postgren sijaan MySQL:ää ja sain tuolla tavalla dumpin toimimaan suoraan komentotulkissa users-palvelimella.

### Viikko 3
Otan työlleni uuden suunnan ja supistan toteutusta saadakseni paremman fokuksen kurssin tavoitteena oleviin oppeihin. Toisin sanoen kavennan tietokantarakennettani ja pyrin panostamaan tarkempaan ja eheämpään suunnitteluun, sekä koodin hallintaan. Dokumentaation pyrin päivittämään lähipäivien aikana vastaamaan uutta suunnitelmaani.

### Viikko 4
Rakensin työni tuhkasta uuteen muotoon

### Viikko 5
Olen tyytyväinen viime viikkoiseen Feeniks-linnun nousuun ja työ etenee kohtuullista vauhtia maalia kohti. Hieman kirittävää kaikkien kriteerien toteuttamiseen, mutta homma luistaa ok. Työssä alkaa olla melkein kaikki palaset paikoillaan ja pääsen keskittymään koodin siistimiseen, muutamien toiminnallisuuksien lisäämiseen, sekä dokumentaation loppuun kirjoittamiseen.
