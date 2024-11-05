USE filmajanlo;

-- kategoriak tábla adatai
INSERT INTO kategoriak (nev) VALUES
('akció'),
('dráma'),
('vígjáték'),
('sci-fi'),
('horror');

-- studiok tábla adatai
INSERT INTO studiok (nev) VALUES
('warner bros'),
('universal pictures'),
('paramount pictures'),
('netflix'),
('hbo');

-- szemelyek tábla adatai
INSERT INTO szemelyek (nev, ismerteto, szuldatum, profilkep_url) VALUES
('robert downey jr.', 'amerikai színész, legismertebb szerepe Vasember.', '1965-04-04', 'robert_downey_jr.jpg'),
('scarlett johansson', 'amerikai színésznő, legismertebb szerepe Fekete Özvegy.', '1984-11-22', 'scarlett_johansson.jpg'),
('chris evans', 'amerikai színész, legismertebb szerepe Amerika Kapitány.', '1981-06-13', 'chris_evans.jpg'),
('j.k. rowling', 'az egyik legismertebb brit író, a Harry Potter sorozat szerzője.', '1965-07-31', 'jk_rowling.jpg'),
('george r.r. martin', 'amerikai író, legismertebb műve a Trónok harca.', '1948-09-20', 'george_rr_martin.jpg'),
('steven spielberg', 'amerikai filmrendező, producer, forgatókönyvíró.', '1946-12-18', 'steven_spielberg.jpg'),
('christopher nolan', 'brit filmrendező, legismertebb művei a Batman trilógia és az Eredet.', '1970-07-30', 'christopher_nolan.jpg'),
('emma thompson', 'brit színésznő és író.', '1959-04-15', 'emma_thompson.jpg'); -- Új személy, aki színész és író is

-- szemely_tipusok tábla adatai
INSERT INTO szemely_tipusok (szemely_id, tipus) VALUES
(1, 'szinesz'),
(2, 'szinesz'),
(3, 'szinesz'),
(4, 'iro'),
(5, 'iro'),
(6, 'rendezo'),
(7, 'rendezo'),
(8, 'szinesz'),
(8, 'iro');

-- felhasznalok tábla adatai
INSERT INTO felhasznalok (nev, email, jelszo, profilkep_url) VALUES
('john doe', 'johndoe@example.com', 'hashed_password_123', 'john_doe.jpg'),
('jane smith', 'janesmith@example.com', 'hashed_password_456', 'jane_smith.jpg');

-- muvek tábla adatai
INSERT INTO muvek (tipus, cim, rendezo_id, iro_id, kategoria_id, studio_id, leiras, kiadasi_ev, boritokep_url, link_netflix, link_hbo) VALUES
('film', 'Jurassic Park', 6, NULL, 1, 1, 'Egy kalandfilm ősi dinoszauruszokkal egy szigeten.', 1993, 'jurassicpark.jpg', NULL, 'jurassicpark.hbo.com'),
('film', 'Eredet', 7, NULL, 4, 5, 'Egy csapat tolvaj álmokon keresztül hatol be a tudatalattiba.', 2010, 'inception.jpg', 'inception.netflix.com', NULL),
('sorozat', 'Stranger Things', NULL, NULL, 4, 4, 'Egy csapat fiatal szembesül furcsa, természetfeletti eseményekkel.', 2016, 'strangerthings.jpg', 'strangerthings.netflix.com', NULL);

-- velemenyek tábla adatai
INSERT INTO velemenyek (felhasznalo_id, mu_id, velemeny, datum) VALUES
(1, 1, 'Dino goes brrrrrrrrrrrrr!', '2024-10-01'),
(2, 2, 'Bonyolult, de nagyon elgondolkodtató történet.', '2024-10-02');

-- mu_szineszek kapcsoló tábla adatai
INSERT INTO mu_szineszek (mu_id, szinesz_id) VALUES
(1, 2), -- Scarlett Johansson játszik a Jurassic Parkban
(2, 3), -- Chris Evans játszik az Eredetben
(3, 1); -- Robert Downey Jr. játszik a Stranger Things-ben
