CREATE SCHEMA btp;

CREATE  TABLE btp.type_travaux ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	designation          VARCHAR(255)       
 ) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

CREATE  TABLE btp.unite ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	designation          VARCHAR(255)       
 ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

CREATE  TABLE btp.utilisateur ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	nom                  VARCHAR(255)       ,
	prenom               VARCHAR(100)       ,
	email                VARCHAR(255)       ,
	telephone            INT       ,
	mdp                  VARCHAR(255)       ,
	type_utilisateur     INT       
 ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

CREATE  TABLE btp.travaux ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	designation          VARCHAR(255)       ,
	id_unite             INT       ,
	prix_unitaire        FLOAT(3,2)       ,
	id_type_travaux      INT       
 ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

CREATE INDEX fk_travaux_type_travaux ON btp.travaux ( id_type_travaux );

CREATE INDEX fk_travaux_unite ON btp.travaux ( id_unite );

CREATE  TABLE btp.suivi_travaux ( 
	id                   INT    NOT NULL AUTO_INCREMENT  PRIMARY KEY,
	id_utilisateur       INT       ,
	id_travaux           INT       ,
	quantite             DOUBLE       ,
	total                DOUBLE       
 ) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE INDEX fk_suivi_travaux_utilidateur ON btp.suivi_travaux ( id_utilisateur );

CREATE INDEX fk_suivi_travaux_travaux ON btp.suivi_travaux ( id_travaux );

ALTER TABLE btp.suivi_travaux ADD CONSTRAINT fk_suivi_travaux_travaux FOREIGN KEY ( id_travaux ) REFERENCES btp.travaux( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE btp.suivi_travaux ADD CONSTRAINT fk_suivi_travaux_utilidateur FOREIGN KEY ( id_utilisateur ) REFERENCES btp.utilisateur( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE btp.travaux ADD CONSTRAINT fk_travaux_type_travaux FOREIGN KEY ( id_type_travaux ) REFERENCES btp.type_travaux( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE btp.travaux ADD CONSTRAINT fk_travaux_unite FOREIGN KEY ( id_unite ) REFERENCES btp.unite( id ) ON DELETE NO ACTION ON UPDATE NO ACTION;



-- tout les travaux_travaux_
SELECT t.id AS id_travaux, t.designation AS designation_travaux, t.prix_unitaire, u.designation AS designation_unite, tt.id AS id_type_travaux, tt.designation AS designation_type_travaux
FROM btp.travaux AS t
JOIN btp.type_travaux AS tt ON t.id_type_travaux = tt.id
JOIN btp.unite AS u ON t.id_unite = u.id;


SELECT t.id AS id_travaux, t.designation AS designation_travaux, t.prix_unitaire, tt.id AS id_type_travaux, tt.designation AS designation_type_travaux
FROM btp.travaux AS t
JOIN btp.type_travaux AS tt ON t.id_type_travaux = tt.id
WHERE tt.designation = 'Travaux terrassement';