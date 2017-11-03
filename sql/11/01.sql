ALTER TABLE users ADD update_date DATETIME DEFAULT NULL, CHANGE username username VARCHAR(20) DEFAULT NULL;

CREATE TABLE user_info (id INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, imie VARCHAR(64) NOT NULL, nazwisko VA
RCHAR(64) NOT NULL, pesel VARCHAR(16) NOT NULL, nr_dowodu VARCHAR(16) NOT NULL, imie_drugie VARCHAR(64) NOT NULL, miasto
 VARCHAR(64) NOT NULL, ulica VARCHAR(128) NOT NULL, nr_domu VARCHAR(8) NOT NULL, nr_lokalu VARCHAR(8) NOT NULL, telefon
VARCHAR(16) NOT NULL, stanowisko VARCHAR(64) NOT NULL, funkcja VARCHAR(64) NOT NULL, wyksztalcenie INT DEFAULT NULL, imi
e_ojca VARCHAR(64) DEFAULT NULL, imie_matki VARCHAR(64) DEFAULT NULL, data_urodzenia DATE DEFAULT NULL, plec INT DEFAULT
 NULL, kod_pocztowy VARCHAR(6) DEFAULT NULL, miejscowosc VARCHAR(64) DEFAULT NULL, kod_pocztowy_zamieszkania VARCHAR(6)
DEFAULT NULL, miasto_zamieszkania VARCHAR(64) DEFAULT NULL, miejscowosc_zamieszkania VARCHAR(64) DEFAULT NULL, ulica_zam
ieszkania VARCHAR(128) DEFAULT NULL, nr_domu_zamieszkania VARCHAR(8) DEFAULT NULL, nr_lokalu_zamieszkania VARCHAR(8) DEF
AULT NULL, kod_pocztowy_korespondencji VARCHAR(6) DEFAULT NULL, miasto_korespondencji VARCHAR(64) DEFAULT NULL, miejscow
osc_korespondencji VARCHAR(64) DEFAULT NULL, ulica_korespondencji VARCHAR(128) DEFAULT NULL, nr_domu_korespondencji VARC
HAR(8) DEFAULT NULL, nr_lokalu_korespondencji VARCHAR(8) DEFAULT NULL, miejsce_urodzenia VARCHAR(64) DEFAULT NULL, data_
wydania_dowodu DATE DEFAULT NULL, data_waznosci_dowodu DATE DEFAULT NULL, organizacja_wydajaca_dowodu VARCHAR(64) DEFAUL
T NULL, UNIQUE INDEX UNIQ_B1087D9E6B3CA4B (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci
 ENGINE = InnoDB;
ALTER TABLE user_info ADD CONSTRAINT FK_B1087D9E6B3CA4B FOREIGN KEY (id_user) REFERENCES users (id) ON DELETE CASCADE;