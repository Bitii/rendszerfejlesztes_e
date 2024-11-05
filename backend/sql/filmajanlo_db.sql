CREATE DATABASE IF NOT EXISTS filmajanlo;
USE filmajanlo;

-- kategoriak tábla
CREATE TABLE kategoriak (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(255) NOT NULL UNIQUE
);

-- studiok tábla
CREATE TABLE studiok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(255) NOT NULL UNIQUE
);

-- szemelyek tábla (általános tábla színészeknek, íróknak, rendezőknek)
CREATE TABLE szemelyek (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(255) NOT NULL,
    ismerteto TEXT,
    szuldatum DATE,
    profilkep_url VARCHAR(255)
);

-- szemely_tipusok kapcsoló tábla
CREATE TABLE szemely_tipusok (
    szemely_id INT,
    tipus ENUM('szinesz', 'iro', 'rendezo') NOT NULL,
    PRIMARY KEY (szemely_id, tipus),
    FOREIGN KEY (szemely_id) REFERENCES szemelyek(id) ON DELETE CASCADE
);

-- muvek (alaptábla filmeknek és sorozatoknak)
CREATE TABLE muvek (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tipus ENUM('film', 'sorozat') NOT NULL,
    cim VARCHAR(255) NOT NULL,
    rendezo_id INT,
    iro_id INT,
    kategoria_id INT,
    studio_id INT,
    leiras TEXT,
    kiadasi_ev YEAR,
    boritokep_url VARCHAR(255),
    link_netflix VARCHAR(255),
    link_hbo VARCHAR(255),
    FOREIGN KEY (rendezo_id) REFERENCES szemelyek(id) ON DELETE SET NULL,
    FOREIGN KEY (iro_id) REFERENCES szemelyek(id) ON DELETE SET NULL,
    FOREIGN KEY (kategoria_id) REFERENCES kategoriak(id) ON DELETE SET NULL,
    FOREIGN KEY (studio_id) REFERENCES studiok(id) ON DELETE SET NULL
);

-- felhasznalok tábla
CREATE TABLE felhasznalok (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nev VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    jelszo VARCHAR(255) NOT NULL,
    profilkep_url VARCHAR(255),
    regisztracios_datum DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- velemenyek tábla
CREATE TABLE velemenyek (
    id INT AUTO_INCREMENT PRIMARY KEY,
    felhasznalo_id INT,
    mu_id INT,
    velemeny TEXT,
    datum DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (felhasznalo_id) REFERENCES felhasznalok(id) ON DELETE CASCADE,
    FOREIGN KEY (mu_id) REFERENCES muvek(id) ON DELETE CASCADE
);

-- kapcsoló tábla: mu-szinesz
CREATE TABLE mu_szineszek (
    mu_id INT,
    szinesz_id INT,
    PRIMARY KEY (mu_id, szinesz_id),
    FOREIGN KEY (mu_id) REFERENCES muvek(id) ON DELETE CASCADE,
    FOREIGN KEY (szinesz_id) REFERENCES szemelyek(id) ON DELETE CASCADE
);
