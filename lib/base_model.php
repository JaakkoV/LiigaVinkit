<?php

class BaseModel {

    // "protected"-attribuutti on käytössä vain luokan ja sen perivien luokkien sisällä
    protected $validators;

    public function __construct($attributes = null) {
        // Käydään assosiaatiolistan avaimet läpi
        foreach ($attributes as $attribute => $value) {
            // Jos avaimen niminen attribuutti on olemassa...
            if (property_exists($this, $attribute)) {
                // ... lisätään avaimen nimiseen attribuuttin siihen liittyvä arvo
                $this->{$attribute} = $value;
            }
        }
    }

    public function errors() {
        // Lisätään $errors muuttujaan kaikki virheilmoitukset taulukkona
        $errors = array();

        foreach ($this->validators as $validator) {
            // Kutsu validointimetodia tässä ja lisää sen palauttamat virheet errors-taulukkoon
            $validator_errors = $this->{$validator}();
            $errors = array_merge($errors, $validator_errors);
        }
        return $errors;
    }

    public static function validate_general($olio, $syote) {
        $errors = array();
        if ($olio == '' || $olio == null) {
            $errors[] = $syote == 'käyttäjätunnuks' ? 'Käyttäjätunnus ei saa olla tyhjä!' : $syote . 'i ei saa olla tyhjä!';
            return $errors;
        }
        if (strlen($olio) < 3) {
            $errors[] = $syote == 'salasanas' ? 'Salasanan pituuden tulee olla vähintään 3 merkkiä' : $syote . 'en pituuden tulee olla vähintään kolme merkkiä!';
            return $errors;
        }
        return $errors;
    }

    public function validate_etunimi() {
        return self::validate_general($this->etunimi, 'Etunim');
    }

    public function validate_sukunimi() {
        return self::validate_general($this->sukunimi, 'Sukunim');
    }

    public function validate_kayttajatunnus() {
        return self::validate_general($this->kayttajatunnus, 'Käyttäjätunnuks');
    }

    public function validate_onkoTunnusVapaa() {
        return $this->onkoTunnusVapaa();
    }

    public function validate_email() {
        $errors = array();
        filter_var($this->email, FILTER_VALIDATE_EMAIL) && preg_match('/@.+\./', $this->email) ? '' : array_push($errors, 'sähköpostiosoite on virheellinen, pitää olla muotoa \'nnnnn@nnn.nn');
        return $errors;
    }

    public function validate_salasana() {
        return self::validate_general($this->salasana, 'Salasanas');
    }

    public static function validate_pvm($olio, $teksti) {
        $errors = array();
        if (preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $olio)) {
            return $errors;
        }
        $errors[] = $teksti . ' ei ole oikeassa muodossa VVVV-MM-DD';
        return $errors;
    }

    public function validate_alkupvm() {
        return self::validate_pvm($this->alkupvm, 'alkupäivämäärä');
    }

    public function validate_loppupvm() {
        return self::validate_pvm($this->loppupvm, 'loppupäivämäärä');
    }

    public function validate_alkuOltavaPienempiKuinLoppuPvm() {
        $errors = array();
        $date1 = $this->alkupvm;
        $date2 = $this->loppupvm;
        $timestamp1 = strtotime($date1);
        $timestamp2 = strtotime($date2);
        if ($timestamp1 > $timestamp2) {
            $errors[] = 'Alkupäivämäärä ei saa olla suurempi kuin loppupäivämäärä';
            return $errors;
        } else {
            return $errors;
        }
    }
}
