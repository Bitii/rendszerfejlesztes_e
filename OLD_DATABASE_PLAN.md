// kategoriak tábla
Table kategoriak {
    id INT [pk, increment]
    nev VARCHAR(255) [not null]
}

// studio tábla
Table studiok {
    id INT [pk, increment]
    nev VARCHAR(255) [not null]
}

// szinesz tábla
Table szineszek {
    id INT [pk, increment]
    nev VARCHAR(255) [not null]
    ismerteto TEXT
    szuldatum DATE
}

// iro tábla
Table irok {
    id INT [pk, increment]
    nev VARCHAR(255) [not null]
    ismerteto TEXT
    szuldatum DATE
}

// rendezo tábla
Table rendezok {
    id INT [pk, increment]
    nev VARCHAR(255) [not null]
    ismerteto TEXT
    szuldatum DATE
}

// filmek tábla
Table filmek {
    id INT [pk, increment]
    cim VARCHAR(255) [not null]
    rendezo_id INT
    iro_id INT
    kategoria_id INT
    studio_id INT
    leiras TEXT
    kiadasi_ev YEAR
    boritokep_url VARCHAR(255)
    link_netflix VARCHAR(255)
    link_hbo VARCHAR(255)
}

// sorozatok tábla
Table sorozatok {
    id INT [pk, increment]
    cim VARCHAR(255) [not null]
    rendezo_id INT
    iro_id INT
    kategoria_id INT
    studio_id INT
    leiras TEXT
    kiadasi_ev YEAR
    boritokep_url VARCHAR(255)
    link_netflix VARCHAR(255)
    link_hbo VARCHAR(255)
}

// felhasznalok tábla
Table felhasznalok {
    id INT [pk, increment]
    nev VARCHAR(255) [not null]
    email VARCHAR(255) [not null, unique]
    jelszo VARCHAR(255) [not null]
    profil_kep VARCHAR(255)
    regisztracios_datum DATETIME [default: `CURRENT_TIMESTAMP`]
}

// velemenyek tábla
Table velemenyek {
    id INT [pk, increment]
    felhasznalo_id INT
    mu_id INT // film vagy sorozat ID
    velemeny TEXT
    datum DATETIME [default: `CURRENT_TIMESTAMP`]
}

// kapcsoló tábla: film-szinesz
Table film_szineszek {
    film_id INT
    szinesz_id INT
    Note: "film_id es szinesz_id osszetett kulcs"
}

// kapcsoló tábla: sorozat-szinesz
Table sorozat_szineszek {
    sorozat_id INT
    szinesz_id INT
    Note: "sorozat_id es szinesz_id osszetett kulcs"
}

Table ertekelesek {
  id INT [pk, increment]
  felhasznalo_id INT
  mu_id INT // Film vagy sorozat id
  ertekeles TINYINT
  Note: "ertekeles 1-10 kozott"
}


// Kapcsolatok

// 1-N kapcsolat: Egy rendező több filmet/sorozatot is rendezhet.
Ref: filmek.rendezo_id > rendezok.id
Ref: sorozatok.rendezo_id > rendezok.id

// 1-N kapcsolat: Egy író több filmet/sorozatot is írhat.
Ref: filmek.iro_id > irok.id
Ref: sorozatok.iro_id > irok.id

// 1-N kapcsolat: Egy kategória több filmhez/sorozathoz tartozhat.
Ref: filmek.kategoria_id > kategoriak.id
Ref: sorozatok.kategoria_id > kategoriak.id

// 1-N kapcsolat: Egy stúdió több filmet/sorozatot is gyárthat.
Ref: filmek.studio_id > studiok.id
Ref: sorozatok.studio_id > studiok.id

// 1-N kapcsolat: Egy felhasználó több véleményt is írhat.
Ref: velemenyek.felhasznalo_id > felhasznalok.id

// N-M kapcsolat: Egy filmhez több színész is tartozhat, és egy színész több filmben is szerepelhet.
Ref: film_szineszek.film_id > filmek.id
Ref: film_szineszek.szinesz_id > szineszek.id

// N-M kapcsolat: Egy sorozathoz több színész is tartozhat, és egy színész több sorozatban is szerepelhet.
Ref: sorozat_szineszek.sorozat_id > sorozatok.id
Ref: sorozat_szineszek.szinesz_id > szineszek.id

// 1-N kapcsolat: Egy felhasználó több értékelést is adhat, és egy értékelés egy filmhez vagy sorozathoz tartozik.
Ref: ertekelesek.felhasznalo_id > felhasznalok.id
// Note: mu_id az ertekelesekben lehet film.id es sorozat.id is

