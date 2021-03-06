CREATE TABLE rexi_danie (id INT AUTO_INCREMENT NOT NULL, produkt_id INT DEFAULT NULL, dzien_id INT DEFAULT NULL, gram SM
ALLINT NOT NULL, INDEX IDX_BF0722F175F42D9B (produkt_id), INDEX IDX_BF0722F1454BC4F0 (dzien_id), PRIMARY KEY(id)) DEFAUL
T CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE rexi_dzien (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, data DATETIME NOT NULL, INDEX IDX_637
726EA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE rexi_posilek (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, nazwa VARCHAR(255) NOT NULL, INDEX
IDX_65CEAAC3A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE rexi_posilek_produkty (id INT AUTO_INCREMENT NOT NULL, produkt_id INT DEFAULT NULL, posilek_id INT DEFAULT
NULL, gram SMALLINT NOT NULL, INDEX IDX_D60196A75F42D9B (produkt_id), INDEX IDX_D60196AF12B67E2 (posilek_id), PRIMARY KE
Y(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
CREATE TABLE rexi_produkt (id INT AUTO_INCREMENT NOT NULL, nazwa VARCHAR(255) NOT NULL, porcja SMALLINT NOT NULL, cena N
UMERIC(5, 2) NOT NULL, kalorii NUMERIC(5, 2) NOT NULL, bialka NUMERIC(5, 2) NOT NULL, wegle NUMERIC(5, 2) NOT NULL, tlus
zcze NUMERIC(5, 2) NOT NULL, usun TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_
ci ENGINE = InnoDB;
CREATE TABLE rexi_users (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(20) DEFAULT NULL, email VARCHAR(120) NOT NULL,
 password VARCHAR(64) NOT NULL, account_non_expired TINYINT(1) NOT NULL, account_non_locked TINYINT(1) NOT NULL, credent
ials_non_expired TINYINT(1) NOT NULL, enabled TINYINT(1) NOT NULL, roles LONGTEXT NOT NULL COMMENT '(DC2Type:array)', ac
tion_token VARCHAR(20) DEFAULT NULL, register_date DATETIME NOT NULL, avatar VARCHAR(100) DEFAULT NULL, update_date DATE
TIME DEFAULT NULL, UNIQUE INDEX UNIQ_492092FDF85E0677 (username), UNIQUE INDEX UNIQ_492092FDE7927C74 (email), PRIMARY KE
Y(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
ALTER TABLE rexi_danie ADD CONSTRAINT FK_BF0722F175F42D9B FOREIGN KEY (produkt_id) REFERENCES rexi_produkt (id) ON DELET
E SET NULL;
ALTER TABLE rexi_danie ADD CONSTRAINT FK_BF0722F1454BC4F0 FOREIGN KEY (dzien_id) REFERENCES rexi_dzien (id) ON DELETE CA
SCADE;
ALTER TABLE rexi_dzien ADD CONSTRAINT FK_637726EA76ED395 FOREIGN KEY (user_id) REFERENCES rexi_users (id) ON DELETE CASC
ADE;
ALTER TABLE rexi_posilek ADD CONSTRAINT FK_65CEAAC3A76ED395 FOREIGN KEY (user_id) REFERENCES rexi_users (id) ON DELETE C
ASCADE;
ALTER TABLE rexi_posilek_produkty ADD CONSTRAINT FK_D60196A75F42D9B FOREIGN KEY (produkt_id) REFERENCES rexi_produkt (id
) ON DELETE SET NULL;
ALTER TABLE rexi_posilek_produkty ADD CONSTRAINT FK_D60196AF12B67E2 FOREIGN KEY (posilek_id) REFERENCES rexi_posilek (id
) ON DELETE CASCADE;