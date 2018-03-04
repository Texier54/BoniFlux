#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: user
#------------------------------------------------------------

CREATE TABLE user(
        id         int (11) Auto_increment  NOT NULL ,
        nom        Varchar (25) ,
        prenom     Varchar (25) ,
        pseudo     Varchar (50) ,
        email      Varchar (50) ,
        password   Varchar (255) ,
        created_at Datetime ,
        updated_at  Datetime ,
        deleted    Datetime ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: video
#------------------------------------------------------------

CREATE TABLE video(
        id          int (11) Auto_increment  NOT NULL ,
        nom         Varchar (50) ,
        description Longtext ,
        token       Varchar (255) ,
        etat        Int ,
        created_at  Datetime ,
        updated_at   Datetime ,
        deleted_at  Datetime ,
        id_user     Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: abonnement
#------------------------------------------------------------

CREATE TABLE abonnement(
        id          int (11) Auto_increment  NOT NULL ,
        id_streamer Int ,
        id_abonne   Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: stream
#------------------------------------------------------------

CREATE TABLE stream(
        id          int (11) Auto_increment  NOT NULL ,
        nom         Varchar (50) ,
        description Longtext ,
        etat        Int ,
		latitude	Float ,
		longitude	Float ,
        created_at  Datetime ,
        updated_at   Datetime ,
        deleted_at  Datetime ,
        id_user     Int ,
        id_urgence  Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: message
#------------------------------------------------------------

CREATE TABLE message(
        id         int (11) Auto_increment  NOT NULL ,
        texte      Longtext ,
        created_at Datetime ,
        updated_at  Datetime ,
        id_stream  Int ,
        id_user    Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: urgence
#------------------------------------------------------------

CREATE TABLE urgence(
        id         int (11) Auto_increment  NOT NULL ,
        nom        Varchar (50) ,
        created_at Datetime ,
        updated_at Datetime ,
        deleted_at Datetime ,
        id_stream  Int ,
        PRIMARY KEY (id )
)ENGINE=InnoDB;

ALTER TABLE video ADD CONSTRAINT FK_video_id_user FOREIGN KEY (id_user) REFERENCES user(id);
ALTER TABLE stream ADD CONSTRAINT FK_stream_id_user FOREIGN KEY (id_user) REFERENCES user(id);
ALTER TABLE stream ADD CONSTRAINT FK_stream_id_urgence FOREIGN KEY (id_urgence) REFERENCES urgence(id);
ALTER TABLE message ADD CONSTRAINT FK_message_id_stream FOREIGN KEY (id_stream) REFERENCES stream(id);
ALTER TABLE message ADD CONSTRAINT FK_message_id_user FOREIGN KEY (id_user) REFERENCES user(id);
ALTER TABLE urgence ADD CONSTRAINT FK_urgence_id_stream FOREIGN KEY (id_stream) REFERENCES stream(id);
