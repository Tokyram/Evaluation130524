CREATE SCHEMA btp;

CREATE  TABLE btp.finition ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	designation          VARCHAR(255)       ,
	pourcentage          DOUBLE       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE  TABLE btp.type_maison ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	nom_maison           VARCHAR(255)       ,
	duree                DOUBLE       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE  TABLE btp.type_travaux ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	designation          VARCHAR(255)       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE  TABLE btp.unite ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	designation          VARCHAR(255)       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE  TABLE btp.utilisateur ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	nom                  VARCHAR(255)       ,
	prenom               VARCHAR(100)       ,
	email                VARCHAR(255)       ,
	telephone            INT       ,
	mdp                  VARCHAR(255)       ,
	type_utilisateur     INT       
 ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

CREATE  TABLE btp.maison ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	id_type_maison       INT       ,
	chambre              INT       ,
	cuisine              INT       ,
	salon                INT       ,
	toilette             INT       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX fk_maison_type_maison ON btp.maison ( id_type_maison );

CREATE  TABLE btp.travaux ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	designation          VARCHAR(255)       ,
	id_unite             INT       ,
	prix_unitaire        FLOAT(15,2)       ,
	id_type_travaux      INT       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX fk_travaux_type_travaux ON btp.travaux ( id_type_travaux );

CREATE INDEX fk_travaux_unite ON btp.travaux ( id_unite );

CREATE  TABLE btp.demande_maison_finition ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	id_maison            INT       ,
	id_finition          INT       ,
	id_user              INT       ,
	date_debut           DATE       ,
	date_fin             DATE       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX fk_demande_maison_finition_maison ON btp.demande_maison_finition ( id_maison );

CREATE INDEX fk_demande_maison_finition_finition ON btp.demande_maison_finition ( id_finition );

CREATE INDEX fk_demande_maison_finition_utilisateur ON btp.demande_maison_finition ( id_user );

CREATE  TABLE btp.devis ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	nom_devis            VARCHAR(255)       ,
	id_maison            INT       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX fk_devis_maison ON btp.devis ( id_maison );

CREATE  TABLE btp.payemant ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	id_demande_maison_finition INT       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX fk_payemant_demande_maison_finition ON btp.payemant ( id_demande_maison_finition );

CREATE  TABLE btp.details_devis ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	id_travaux           INT       ,
	quantite             DOUBLE       ,
	total                DOUBLE       ,
	id_devis             INT       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX fk_suivi_travaux_travaux ON btp.details_devis ( id_travaux );

CREATE INDEX fk_details_devis_devis ON btp.details_devis ( id_devis );

CREATE  TABLE btp.historique_payement ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	id_payement          INT       ,
	montant              FLOAT(10,2)       ,
	date_payement        DATE       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX fk_historique_payement_payemant ON btp.historique_payement ( id_payement );

ALTER TABLE btp.demande_maison_finition ADD CONSTRAINT fk_demande_maison_finition_utilisateur FOREIGN KEY ( id_user ) REFERENCES btp.utilisateur( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE btp.demande_maison_finition ADD CONSTRAINT fk_demande_maison_finition_finition FOREIGN KEY ( id_finition ) REFERENCES btp.finition( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE btp.demande_maison_finition ADD CONSTRAINT fk_demande_maison_finition_maison FOREIGN KEY ( id_maison ) REFERENCES btp.maison( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE btp.details_devis ADD CONSTRAINT fk_details_devis_devis FOREIGN KEY ( id_devis ) REFERENCES btp.devis( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE btp.details_devis ADD CONSTRAINT fk_suivi_travaux_travaux FOREIGN KEY ( id_travaux ) REFERENCES btp.travaux( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE btp.devis ADD CONSTRAINT fk_devis_maison FOREIGN KEY ( id_maison ) REFERENCES btp.maison( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE btp.historique_payement ADD CONSTRAINT fk_historique_payement_payemant FOREIGN KEY ( id_payement ) REFERENCES btp.payemant( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE btp.maison ADD CONSTRAINT fk_maison_type_maison FOREIGN KEY ( id_type_maison ) REFERENCES btp.type_maison( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE btp.payemant ADD CONSTRAINT fk_payemant_demande_maison_finition FOREIGN KEY ( id_demande_maison_finition ) REFERENCES btp.demande_maison_finition( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE btp.travaux ADD CONSTRAINT fk_travaux_type_travaux FOREIGN KEY ( id_type_travaux ) REFERENCES btp.type_travaux( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE btp.travaux ADD CONSTRAINT fk_travaux_unite FOREIGN KEY ( id_unite ) REFERENCES btp.unite( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;




INSERT INTO btp.type_maison (nom_maison, duree) VALUES ('Maison traditionnelle', 150);
INSERT INTO btp.type_maison (nom_maison, duree) VALUES ('Maison moderne', 200);
INSERT INTO btp.type_maison (nom_maison, duree) VALUES ('Maison en bois', 150);
INSERT INTO btp.type_maison (nom_maison, duree) VALUES ('Maison écologique', 50);


INSERT INTO btp.maison (id_type_maison, chambre, cuisine, salon, toilette) VALUES (1, 3, 1, 1, 2);
INSERT INTO btp.maison (id_type_maison, chambre, cuisine, salon, toilette) VALUES (2, 4, 2, 2, 3);
INSERT INTO btp.maison (id_type_maison, chambre, cuisine, salon, toilette) VALUES (4, 2, 1, 1, 1);
INSERT INTO btp.maison (id_type_maison, chambre, cuisine, salon, toilette) VALUES (3, 5, 3, 3, 4);


INSERT INTO btp.finition (designation, pourcentage) VALUES ('Standart', 1);
INSERT INTO btp.finition (designation, pourcentage) VALUES ('Gold', 5);
INSERT INTO btp.finition (designation, pourcentage) VALUES ('Premium', 15);
INSERT INTO btp.finition (designation, pourcentage) VALUES ('VIP', 30);

insert into type_travaux (num, designation)
values
    ('000', 'TRAVAUX PREPARATIORE'),
    ('100', 'TRAVAUX DE TERRASSEMENT'),
    ('200', 'TRAVAUX EN INFRASTRUCTURE');


insert into unite (designation) 
values ('fft'),('m2'),('m3');

insert into travaux (num, designation, id_unite, prix_unitaire, id_type_travaux)
values
    ('001', 'Mur de soutenement et demi Cloture ht 1m', 3, 190000.00, 1);
insert into travaux (num, designation, id_unite, prix_unitaire, id_type_travaux)
values
    ('101', 'Décapage des terrains meubles', 2, 3072.87, 2),
    ('102', 'Dressage du plateforme', 2, 3736.26, 2),
    ('103', 'Fouille d''ouvrage terrain ferme', 3, 9390.93, 2),
    ('104', 'Remblai d''ouvrage', 3, 37563.26, 2),
    ('105', 'Travaux d''implantation', 1, 152656.00, 2);
insert into travaux (num, designation, id_unite, prix_unitaire, id_type_travaux)
values
    ('201', 'Maçonnerie de moellons, ep= 35cm', 3, 172114.40, 3),
    ('202', 'Beton armée dosée à 350kgm3- semelles isolée', 3, 573215.80, 3),
    ('202', 'Beton armée dosée à 350kgm3- amorces poteaux', 3, 573215.80, 3),
    ('202', 'Beton armée dosée à 350kgm3- chaînage bas de 20x20', 3, 573215.80, 3),
    ('203', 'Remblai technique', 3, 37563.26, 3),
    ('204', 'Herrissonage ep=10', 3, 73245.40, 3),
    ('205', 'Beton ordinaire dosée à 300kg3pour for', 3, 487815.80, 3),
    ('205', 'Chape de 2cm', 3, 33566.4, 3);


insert into devis (designation, id_type_maison)
values
    ('Devis Maison traditionnelle', 1),
    ('Devis Maison moderne', 2),
    ('Devis Maison en bois', 3),
    ('Maison écologique', 4);



INSERT INTO details_devis (id_devis, id_travaux, quantite, prix_unitaire, prix_total)
VALUES 
    (1, 6, 26.98, (SELECT prix_unitaire FROM travaux WHERE id = 6), 26.98 * (SELECT prix_unitaire FROM travaux WHERE id = 6)),
    (1, 7, 101.36, (SELECT prix_unitaire FROM travaux WHERE id = 7), 101.36 * (SELECT prix_unitaire FROM travaux WHERE id = 7)),
    (1, 8, 101.36, (SELECT prix_unitaire FROM travaux WHERE id = 8), 101.36 * (SELECT prix_unitaire FROM travaux WHERE id = 8)),
    (1, 9, 24.44, (SELECT prix_unitaire FROM travaux WHERE id = 9), 24.44 * (SELECT prix_unitaire FROM travaux WHERE id = 9)),
    (1, 10, 15.59, (SELECT prix_unitaire FROM travaux WHERE id = 10), 15.59 * (SELECT prix_unitaire FROM travaux WHERE id = 10)),
    (1, 11, 1, (SELECT prix_unitaire FROM travaux WHERE id = 11), 1 * (SELECT prix_unitaire FROM travaux WHERE id = 11)),
    (1, 12, 9.62, (SELECT prix_unitaire FROM travaux WHERE id = 12), 9.62 * (SELECT prix_unitaire FROM travaux WHERE id = 12)),
    (1, 13, 0.53, (SELECT prix_unitaire FROM travaux WHERE id = 13), 0.53 * (SELECT prix_unitaire FROM travaux WHERE id = 13)),
    (1, 14, 0.56, (SELECT prix_unitaire FROM travaux WHERE id = 14), 0.56 * (SELECT prix_unitaire FROM travaux WHERE id = 14)),
    (1, 15, 2.44, (SELECT prix_unitaire FROM travaux WHERE id = 15), 2.44 * (SELECT prix_unitaire FROM travaux WHERE id = 15)),
    (1, 16, 15.59, (SELECT prix_unitaire FROM travaux WHERE id = 16), 15.59 * (SELECT prix_unitaire FROM travaux WHERE id = 16)),
    (1, 17, 7.90, (SELECT prix_unitaire FROM travaux WHERE id = 17), 7.90 * (SELECT prix_unitaire FROM travaux WHERE id = 17)),
    (1, 18, 9.62, (SELECT prix_unitaire FROM travaux WHERE id = 18), 9.62 * (SELECT prix_unitaire FROM travaux WHERE id = 18)),
    (1, 19, 9.22, (SELECT prix_unitaire FROM travaux WHERE id = 19), 9.22 * (SELECT prix_unitaire FROM travaux WHERE id = 19));

    --
INSERT INTO details_devis (id_devis, id_travaux, quantite, prix_unitaire, prix_total)
VALUES 
    (2, 6, 30, (SELECT prix_unitaire FROM travaux WHERE id = 6), 30 * (SELECT prix_unitaire FROM travaux WHERE id = 6)),
    (2, 7, 105, (SELECT prix_unitaire FROM travaux WHERE id = 7), 105 * (SELECT prix_unitaire FROM travaux WHERE id = 7)),
    (2, 8, 110, (SELECT prix_unitaire FROM travaux WHERE id = 8), 110 * (SELECT prix_unitaire FROM travaux WHERE id = 8)),
    (2, 9, 28, (SELECT prix_unitaire FROM travaux WHERE id = 9), 28 * (SELECT prix_unitaire FROM travaux WHERE id = 9)),
    (2, 10, 20, (SELECT prix_unitaire FROM travaux WHERE id = 10), 20 * (SELECT prix_unitaire FROM travaux WHERE id = 10)),
    (2, 11, 2, (SELECT prix_unitaire FROM travaux WHERE id = 11), 2 * (SELECT prix_unitaire FROM travaux WHERE id = 11)),
    (2, 12, 12, (SELECT prix_unitaire FROM travaux WHERE id = 12), 12 * (SELECT prix_unitaire FROM travaux WHERE id = 12)),
    (2, 13, 1, (SELECT prix_unitaire FROM travaux WHERE id = 13), 1 * (SELECT prix_unitaire FROM travaux WHERE id = 13)),
    (2, 14, 1, (SELECT prix_unitaire FROM travaux WHERE id = 14), 1 * (SELECT prix_unitaire FROM travaux WHERE id = 14)),
    (2, 15, 4, (SELECT prix_unitaire FROM travaux WHERE id = 15), 4 * (SELECT prix_unitaire FROM travaux WHERE id = 15)),
    (2, 16, 20, (SELECT prix_unitaire FROM travaux WHERE id = 16), 20 * (SELECT prix_unitaire FROM travaux WHERE id = 16)),
    (2, 17, 10, (SELECT prix_unitaire FROM travaux WHERE id = 17), 10 * (SELECT prix_unitaire FROM travaux WHERE id = 17)),
    (2, 18, 12, (SELECT prix_unitaire FROM travaux WHERE id = 18), 12 * (SELECT prix_unitaire FROM travaux WHERE id = 18)),
    (2, 19, 11, (SELECT prix_unitaire FROM travaux WHERE id = 19), 11 * (SELECT prix_unitaire FROM travaux WHERE id = 19));


INSERT INTO details_devis (id_devis, id_travaux, quantite, prix_unitaire, prix_total)
VALUES 
    (3, 6, 35, (SELECT prix_unitaire FROM travaux WHERE id = 6), 35 * (SELECT prix_unitaire FROM travaux WHERE id = 6)),
    (3, 7, 120, (SELECT prix_unitaire FROM travaux WHERE id = 7), 120 * (SELECT prix_unitaire FROM travaux WHERE id = 7)),
    (3, 8, 130, (SELECT prix_unitaire FROM travaux WHERE id = 8), 130 * (SELECT prix_unitaire FROM travaux WHERE id = 8)),
    (3, 9, 30, (SELECT prix_unitaire FROM travaux WHERE id = 9), 30 * (SELECT prix_unitaire FROM travaux WHERE id = 9)),
    (3, 10, 25, (SELECT prix_unitaire FROM travaux WHERE id = 10), 25 * (SELECT prix_unitaire FROM travaux WHERE id = 10)),
    (3, 11, 3, (SELECT prix_unitaire FROM travaux WHERE id = 11), 3 * (SELECT prix_unitaire FROM travaux WHERE id = 11)),
    (3, 12, 15, (SELECT prix_unitaire FROM travaux WHERE id = 12), 15 * (SELECT prix_unitaire FROM travaux WHERE id = 12)),
    (3, 13, 1, (SELECT prix_unitaire FROM travaux WHERE id = 13), 1 * (SELECT prix_unitaire FROM travaux WHERE id = 13)),
    (3, 14, 2, (SELECT prix_unitaire FROM travaux WHERE id = 14), 2 * (SELECT prix_unitaire FROM travaux WHERE id = 14)),
    (3, 15, 5, (SELECT prix_unitaire FROM travaux WHERE id = 15), 5 * (SELECT prix_unitaire FROM travaux WHERE id = 15)),
    (3, 16, 25, (SELECT prix_unitaire FROM travaux WHERE id = 16), 25 * (SELECT prix_unitaire FROM travaux WHERE id = 16)),
    (3, 17, 15, (SELECT prix_unitaire FROM travaux WHERE id = 17), 15 * (SELECT prix_unitaire FROM travaux WHERE id = 17)),
    (3, 18, 18, (SELECT prix_unitaire FROM travaux WHERE id = 18), 18 * (SELECT prix_unitaire FROM travaux WHERE id = 18)),
    (3, 19, 16, (SELECT prix_unitaire FROM travaux WHERE id = 19), 16 * (SELECT prix_unitaire FROM travaux WHERE id = 19));


-- vue pour les devis pour chaque maison
CREATE OR REPLACE VIEW somme_prix_devis_maison AS 
SELECT 
    d.id AS id_devis, 
    m.id AS id_maison,
    d.designation AS designation_devis, 
    tm.nom_maison AS nom_maison, 
    tm.duree AS duree_maison, 
    m.chambre AS nombre_chambres, 
    m.cuisine AS nombre_cuisines, 
    m.salon AS nombre_salons, 
    m.toilette AS nombre_toilettes, 
    SUM(dd.prix_total) AS somme_prix_total
FROM 
    btp.devis d
JOIN 
    btp.maison m ON d.id_maison = m.id
JOIN 
    btp.type_maison tm ON m.id_type_maison = tm.id
JOIN 
    btp.details_devis dd ON d.id = dd.id_devis
GROUP BY 
    d.id, m.id, d.designation, tm.nom_maison, tm.duree, m.chambre, m.cuisine, m.salon, m.toilette;

select * from somme_prix_devis_maison;


-- selection demande_maison_finitiones avec nom
SELECT dm.id, dm.date_debut, dm.date_fin, tm.nom_maison, f.designation
FROM demande_maison_finition dm
JOIN maison m ON dm.id_maison = m.id
JOIN finition f ON dm.id_finition = f.id
JOIN type_maison tm on m.id_type_maison = tm.id
-- selection demande_maison_finitiones avec nom where utilisateur

SELECT dm.id, u.nom AS nom_utilisateur, u.prenom AS prenom_utilisateur, dm.date_debut, dm.date_fin, tm.nom_maison, f.designation, d.designation AS designation_devis
FROM demande_maison_finition dm
JOIN maison m ON dm.id_maison = m.id
JOIN finition f ON dm.id_finition = f.id
JOIN type_maison tm ON m.id_type_maison = tm.id
JOIN utilisateur u ON dm.id_user = u.id
JOIN devis d ON dm.id_maison = d.id_maison
WHERE dm.id_user = 2;

-- avoir les details devis where id_devis
SELECT dd.id AS id_detail_devis, 
       t.id AS id_travaux,
       t.designation AS designation_travaux,
       t.prix_unitaire AS prix_unitaire_travaux,
       t.id_unite AS id_unite_travaux,
       u.designation AS designation_unite_travaux,
       dd.quantite AS quantite_detail_devis,
       dd.prix_unitaire AS prix_unitaire_detail_devis,
       dd.prix_total AS prix_total_detail_devis
FROM details_devis dd
JOIN travaux t ON dd.id_travaux = t.id
JOIN unite u ON t.id_unite = u.id
WHERE dd.id_devis = 3;

