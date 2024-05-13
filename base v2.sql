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
	num                  INT       ,
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
	designation          VARCHAR(255)       ,
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
	id_devis             INT       ,
	id_travaux           INT       ,
	quantite             DOUBLE       ,
	prix_unitaire        FLOAT(10,2)       ,
	prix_total           FLOAT(10,2)       
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

