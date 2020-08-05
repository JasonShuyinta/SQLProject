DROP DATABASE IF EXISTS NATURE;

/* Creazione Database */
CREATE DATABASE NATURE;
USE NATURE;

/* Creazione Tabelle */
CREATE TABLE UTENTE(
  Nome VARCHAR(50) PRIMARY KEY,
  Email VARCHAR(50) NOT NULL,
  Password VARCHAR(50) NOT NULL,
  AnnoNascita INTEGER(4) NOT NULL,
  Professione VARCHAR(50) NOT NULL,
  Foto mediumblob,
  DataRegistrazione TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  Contatore INTEGER DEFAULT 0,
  N_Classificazione_Corrette INTEGER,
  N_Classificazione_Errate INTEGER,
  N_Classificazione_Totali INTEGER,
  Affidabilita FLOAT,
  TipoUtente enum("Semplice","Premium","Amministratore") DEFAULT "Semplice"
  ) ENGINE = INNODB;

CREATE TABLE SPECIE(
  Classe VARCHAR(50),
  NomeLatino VARCHAR(50) PRIMARY KEY,
  NomeItaliano VARCHAR(50),
  AnnoClassificazione INTEGER(4),
  LivelloVulnerabilita enum("Basso","Medio","Alto","Minimo","Critico"),
  LinkWikipedia VARCHAR(50),
  NomeUtente VARCHAR(50),
  FOREIGN KEY (NomeUtente) REFERENCES UTENTE (Nome)
) ENGINE = INNODB;

CREATE TABLE ANIMALE(
  NomeLatino VARCHAR(50),
  Peso VARCHAR(50),
  Altezza VARCHAR(50),
  Numerosita INTEGER,
  FOREIGN KEY (NomeLatino) REFERENCES SPECIE (NomeLatino) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE VEGETALE(
  NomeLatino VARCHAR(50),
  Altezza VARCHAR(50),
  Diametro VARCHAR(50),
  FOREIGN KEY (NomeLatino) REFERENCES SPECIE (NomeLatino) ON DELETE CASCADE
) ENGINE = INNODB;

CREATE TABLE HABITAT(
  NomeHabitat VARCHAR(50) PRIMARY KEY,
  Descrizione VARCHAR(200),
  NomeUtente VARCHAR(50),
  FOREIGN KEY (NomeUtente) REFERENCES UTENTE (Nome)
) ENGINE = INNODB;

CREATE TABLE APPARTENENZA(
  NomeLatino VARCHAR(50),
  NomeHabitat VARCHAR(50),
  PRIMARY KEY(NomeLatino,NomeHabitat),
  FOREIGN KEY (NomeLatino) REFERENCES SPECIE (NomeLatino) ON DELETE CASCADE,
  FOREIGN KEY (NomeHabitat) REFERENCES HABITAT (NomeHabitat)

) ENGINE = INNODB;

CREATE TABLE MESSAGGIO(
  CodiceMessaggio INTEGER AUTO_INCREMENT PRIMARY KEY,
  Testo VARCHAR(250),
  Titolo VARCHAR(50),
  Ora TIMESTAMP,
  NomeMittente VARCHAR(50),
  NomeDestinatario VARCHAR(50),
  FOREIGN KEY (NomeMittente) REFERENCES UTENTE (Nome),
  FOREIGN KEY (NomeDestinatario) REFERENCES UTENTE (Nome)

  ) ENGINE = INNODB;


CREATE TABLE SEGNALAZIONE(
  CodiceSegnalazione INTEGER AUTO_INCREMENT PRIMARY KEY,
  Data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  Foto mediumblob,
  Latitudine DECIMAL,
  Longitudine DECIMAL,
  NomeUtente VARCHAR(50),
  NomeHabitat VARCHAR(50),
  NomeLatino VARCHAR(50),
  FOREIGN KEY (NomeUtente) REFERENCES UTENTE (Nome),
  FOREIGN KEY (NomeHabitat) REFERENCES HABITAT (NomeHabitat),
  FOREIGN KEY (NomeLatino) REFERENCES SPECIE (NomeLatino)
) ENGINE = INNODB;

CREATE TABLE CLASSIFICAZIONE(
  CodiceClassificazione INTEGER AUTO_INCREMENT PRIMARY KEY,
  Commento VARCHAR(50),
  Data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  NomeUtente VARCHAR(50),
  CodiceSegnalazione INTEGER,
  NomeLatino VARCHAR(50),
  FOREIGN KEY (NomeUtente) REFERENCES UTENTE (Nome),
  FOREIGN KEY (CodiceSegnalazione) REFERENCES SEGNALAZIONE (CodiceSegnalazione),
  FOREIGN KEY (NomeLatino) REFERENCES SPECIE (NomeLatino)
) ENGINE = INNODB;

CREATE TABLE ESCURSIONE(
  CodiceEscursione INTEGER AUTO_INCREMENT PRIMARY KEY,
  Titolo VARCHAR(50),
  DATA DATE,
  OrarioPartenza TIME,
  OrarioRitorno TIME,
  Tragitto VARCHAR(50),
  Descrizione VARCHAR(200),
  N_Max_Partecipanti INTEGER,
  NomeUtente VARCHAR(50),
  Stato enum("Aperto","Chiuso") DEFAULT "Aperto",
  FOREIGN KEY (NomeUtente) REFERENCES UTENTE (Nome)
) ENGINE = INNODB;

CREATE TABLE ISCRIZIONE(
  CodiceIscrizione INTEGER AUTO_INCREMENT PRIMARY KEY,
  NomeUtente VARCHAR(50),
  CodiceEscursione INTEGER,
  FOREIGN KEY (NomeUtente) REFERENCES UTENTE (Nome),
  FOREIGN KEY (CodiceEscursione) REFERENCES ESCURSIONE (CodiceEscursione)
) ENGINE = INNODB;

CREATE TABLE CORREZIONE(
    CodiceCorrezione INTEGER AUTO_INCREMENT PRIMARY KEY,
    NomeUtente VARCHAR(50),
    CodiceClassificazione INTEGER,
    FOREIGN KEY (NomeUtente) REFERENCES UTENTE (Nome),
    FOREIGN KEY (CodiceClassificazione) REFERENCES CLASSIFICAZIONE (CodiceClassificazione)
) ENGINE = INNODB;

CREATE TABLE CAMPAGNA_FONDI(
  CodiceCampagna INTEGER AUTO_INCREMENT PRIMARY KEY,
  Stato enum("Aperto","Chiuso") DEFAULT "Aperto",
  DataInizio TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  Descrizione VARCHAR(200),
  ImportoMassimo DECIMAL,
  NomeUtente VARCHAR(50),
  FOREIGN KEY (NomeUtente) REFERENCES UTENTE (Nome)
) ENGINE = INNODB;

CREATE TABLE DONAZIONE(
  CodiceDonazione INTEGER AUTO_INCREMENT PRIMARY KEY,
  CodiceCampagna INTEGER,
  NomeUtente VARCHAR(50),
  Importo DECIMAL,
  Note VARCHAR(200),
  FOREIGN KEY (CodiceCampagna) REFERENCES CAMPAGNA_FONDI(CodiceCampagna),
  FOREIGN KEY (NomeUtente) REFERENCES UTENTE (Nome)
) ENGINE = INNODB;

CREATE TABLE MODIFICA_SPECIE(
  Id INTEGER AUTO_INCREMENT PRIMARY KEY,
  NomeUtente VARCHAR(50),
  NomeLatino VARCHAR(50),
  FOREIGN KEY (NomeUtente) REFERENCES UTENTE (Nome),
  FOREIGN KEY (NomeLatino) REFERENCES SPECIE (NomeLatino)
) ENGINE = INNODB;

CREATE TABLE  MODIFICA_HABITAT(
  Id INTEGER AUTO_INCREMENT PRIMARY KEY,
  NomeAmministratore VARCHAR(50),
  NomeHabitat VARCHAR(50),
  FOREIGN KEY (NomeAmministratore) REFERENCES UTENTE (Nome),
  FOREIGN KEY (NomeHabitat) REFERENCES HABITAT (NomeHabitat)
) ENGINE = INNODB;

/* Inserimento dei dati in input */
INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("MAMMALIA", "Hystrix cristata", "Istrice", "1758", "Minimo", "https://it.wikipedia.org/wiki/Hystrix_cristata");
INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("MAMMALIA", "Chionomys nivalis", "Arvicola delle nevi", "1842", "Minimo", "https://it.wikipedia.org/wiki/Chionomys_nivalis");
INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("REPTILIA", "Zootoca vivipara", "Lucertola vivipera", "1787", "Critico", "https://en.wikipedia.org/wiki/Viviparous_lizard");
INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("REPTILIA", "Vipera ammodytes", "Vipera dal corno", "1758", "Critico", "https://en.wikipedia.org/wiki/Vipera_ammodytes");
INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("REPTILIA", "Vipera aspis", "Vipera comune", "1758", "Medio", "https://en.wikipedia.org/wiki/Vipera_aspis");
INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("REPTILIA", "Vipera berus ", "Marasso", "1758", "Medio", "https://en.wikipedia.org/wiki/Vipera_berus");
INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("REPTILIA", "Vipera ursinii", "Vipera dell'Orsini", "1835", "Critico", "https://en.wikipedia.org/wiki/Vipera_ursinii");
INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("REPTILIA", "Caretta caretta", "Tartaruga caretta", "1758", "Alto", "https://en.wikipedia.org/wiki/Loggerhead_sea_turtle");
INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("REPTILIA", "Chelonia mydas", "Tartaruga verde", "1758", "Basso", "https://en.wikipedia.org/wiki/Green_sea_turtle");
INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("ANTHOZOA", "Corallium rubrum", "Corallo rosso", "1758", "Critico", "https://it.wikipedia.org/wiki/Corallium_rubrum");
INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("ECHINOIDEA", "Centrostephanus longispinus", "Riccio di mare", "1845", "Alto", "https://en.wikipedia.org/wiki/Centrostephanus_longispinus");

INSERT INTO SPECIE(Classe,NomeLatino,NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("Polypodiopsida", "Marsilea quadrifolia", "Trifoglio acquatico comune", "1800", "Critico", "https://it.wikipedia.org/wiki/Marsilea_quadrifolia");
INSERT INTO SPECIE(Classe,NomeLatino,NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("Angiosperme ", "Galanthus nivalis", "Bucaneve", "1753", "Critico", "https://en.wikipedia.org/wiki/Galanthus_nivalis");
INSERT INTO SPECIE(Classe,NomeLatino,NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("Magnoliopsida", "Gentiana lutea", "Genziana gialla", "1753", "Alto", "https://it.wikipedia.org/wiki/Gentiana_lutea");
INSERT INTO SPECIE(Classe,NomeLatino,NomeItaliano, LivelloVulnerabilita, LinkWikipedia) VALUES ("Magnoliopsida", "Cyclamen repandum", "Ciclamino primaverile", "Basso", "https://it.wikipedia.org/wiki/Cyclamen_repandum");
INSERT INTO SPECIE(Classe,NomeLatino,NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia) VALUES ("Liliopside", "Ophrys pallida", "Ofride Pallida", "1810", "Basso", "https://it.wikipedia.org/wiki/Ophrys_pallida");

INSERT INTO ANIMALE(NomeLatino, peso, Altezza, Numerosita) VALUES("Hystrix cristata", "20Kg", "850mm", "2");
INSERT INTO ANIMALE(NomeLatino, peso, Altezza, Numerosita) VALUES("Chionomys nivalis", "48g", "100cm", "6");
INSERT INTO ANIMALE(NomeLatino, peso, Altezza) VALUES("Zootoca vivipara", "30g", "60cm");
INSERT INTO ANIMALE(NomeLatino, Altezza) VALUES("Vipera ammodytes", "60cm");
INSERT INTO ANIMALE(NomeLatino, Altezza) VALUES("Vipera aspis", "65cm");
INSERT INTO ANIMALE(NomeLatino, Altezza) VALUES("Vipera berus", "70cm");
INSERT INTO ANIMALE(NomeLatino, Altezza) VALUES("Vipera ursinii", "70cm");
INSERT INTO ANIMALE(NomeLatino, peso, Altezza, Numerosita) VALUES("Caretta caretta", "130kg", "110cm", "200");
INSERT INTO ANIMALE(NomeLatino, peso, Altezza, Numerosita) VALUES("Chelonia mydas", "500kg", "150cm", "100");
INSERT INTO ANIMALE(NomeLatino, Altezza) VALUES("Corallium rubrum", "25cm");
INSERT INTO ANIMALE(NomeLatino, Altezza) VALUES("Centrostephanus longispinus", "7cm");

INSERT INTO VEGETALE(NomeLatino, Altezza, Diametro) VALUES ("Marsilea quadrifolia", "30cm", "15cm");
INSERT INTO VEGETALE(NomeLatino, Altezza, Diametro) VALUES ("Galanthus nivalis", "30cm", "5cm");
INSERT INTO VEGETALE(NomeLatino, Altezza, Diametro) VALUES ("Gentiana lutea", "90cm", "20cm");
INSERT INTO VEGETALE(NomeLatino, Altezza, Diametro) VALUES ("Cyclamen repandum", "15cm", "7mm");
INSERT INTO VEGETALE(NomeLatino, Altezza, Diametro) VALUES ("Ophrys pallida", "17cm", "3mm");

INSERT INTO HABITAT(NomeHabitat, Descrizione) VALUES ("Laguna", "http://vnr.unipg.it/habitat/cerca.do?formato=stampa&idSegnalazione=69");
INSERT INTO HABITAT(NomeHabitat, Descrizione) VALUES ("Lago", "https://it.wikipedia.org/wiki/Lago");
INSERT INTO HABITAT(NomeHabitat, Descrizione) VALUES ("Palude", "https://it.wikipedia.org/wiki/Palude");
INSERT INTO HABITAT(NomeHabitat, Descrizione) VALUES ("Fiume alpino", "http://vnr.unipg.it/habitat/cerca.do?formato=stampa&idSegnalazione=37");
INSERT INTO HABITAT(NomeHabitat, Descrizione) VALUES ("Fiume mediterranei", "http://vnr.unipg.it/habitat/cerca.do?formato=stampa&idSegnalazione=98");
INSERT INTO HABITAT(NomeHabitat, Descrizione) VALUES ("Foresta mediterranea", "http://vnr.unipg.it/habitat/cerca.do?formato=stampa&idSegnalazione=34");
INSERT INTO HABITAT(NomeHabitat, Descrizione) VALUES ("Foresta di conifere", "https://it.wikipedia.org/wiki/Foreste_di_conifere_temperate");
INSERT INTO HABITAT(NomeHabitat, Descrizione) VALUES ("Ambienti rocciosi", "http://vnr.unipg.it/habitat/cerca.do?formato=stampa&idSegnalazione=117");
INSERT INTO HABITAT(NomeHabitat, Descrizione) VALUES ("Mare", "https://it.wikipedia.org/wiki/Mare");

INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Hystrix cristata", "Foresta mediterranea");
INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Chionomys nivalis", "Foresta di conifere");
INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Zootoca vivipara", "Foresta mediterranea");
INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Vipera ammodytes", "Foresta mediterranea");
INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Vipera ammodytes", "Foresta di conifere");
INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Vipera aspis", "Ambienti rocciosi");
INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Vipera berus", "Foresta mediterranea");
INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Vipera berus", "Foresta di conifere");
INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Vipera ursinii", "Ambienti rocciosi");
INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Vipera ursinii", "Foresta mediterranea");
INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Caretta caretta", "Mare");
INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Chelonia mydas", "Mare");
INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Corallium rubrum", "Mare");
INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Centrostephanus longispinus", "Mare");
INSERT INTO APPARTENENZA(NomeLatino,NomeHabitat) VALUES ("Centrostephanus longispinus", "Laguna");

INSERT INTO APPARTENENZA(NomeLatino, NomeHabitat) VALUES ("Marsilea quadrifolia", "Laguna");
INSERT INTO APPARTENENZA(NomeLatino, NomeHabitat) VALUES ("Marsilea quadrifolia", "Lago");
INSERT INTO APPARTENENZA(NomeLatino, NomeHabitat) VALUES ("Galanthus nivalis", "Foresta di conifere");
INSERT INTO APPARTENENZA(NomeLatino, NomeHabitat) VALUES ("Gentiana lutea", "Foresta di conifere");
INSERT INTO APPARTENENZA(NomeLatino, NomeHabitat) VALUES ("Cyclamen repandum", "Foresta mediterranea");
INSERT INTO APPARTENENZA(NomeLatino, NomeHabitat) VALUES ("Ophrys pallida", "Foresta mediterranea");

/*Pocedure: Printf */
DELIMITER |
CREATE PROCEDURE printf(mytext TEXT)
BEGIN
  select mytext as ``;
END;
|
DELIMITER ;

/* Trigger 1 */
DELIMITER |
CREATE TRIGGER PROMOZIONE
AFTER INSERT ON SEGNALAZIONE
FOR EACH ROW
BEGIN
  UPDATE UTENTE SET Contatore = contatore+1 WHERE Nome = new.NomeUtente;
  if((SELECT Contatore FROM UTENTE WHERE Nome = new.NomeUtente)>2) THEN
    UPDATE UTENTE SET TipoUtente="Premium", N_Classificazione_Corrette=0, N_Classificazione_Errate=0, N_Classificazione_Totali=0, Affidabilita=0 WHERE ((Utente.Nome=new.NomeUtente) AND (Utente.TipoUtente="Semplice"));
  END IF;
END
|
DELIMITER ;

/* Trigger 2 */
DELIMITER |
CREATE TRIGGER CHECK_CAMPAGNA_FONDI
AFTER INSERT ON DONAZIONE
FOR EACH ROW
BEGIN
  if((SELECT SUM(Importo) FROM DONAZIONE WHERE CodiceCampagna = new.CodiceCampagna) >= (SELECT ImportoMassimo FROM CAMPAGNA_FONDI WHERE CodiceCampagna = new.CodiceCampagna)) THEN
    UPDATE CAMPAGNA_FONDI SET Stato = "Chiuso" WHERE CodiceCampagna = new.CodiceCampagna;
  END IF;
END
|
DELIMITER ;

/* Trigger 3 */
DELIMITER |
CREATE TRIGGER CHECK_ESCURSIONE
AFTER INSERT ON ISCRIZIONE
FOR EACH ROW
BEGIN
  if((SELECT COUNT(*) FROM ISCRIZIONE WHERE CodiceEscursione = new.CodiceEscursione) >= (SELECT N_Max_Partecipanti FROM ESCURSIONE WHERE CodiceEscursione = new.CodiceEscursione)) THEN
    UPDATE ESCURSIONE SET Stato = "Chiuso" WHERE CodiceEscursione = new.CodiceEscursione;
  END IF;
END
|
DELIMITER ;

/* Trigger 4 */
DELIMITER |
CREATE TRIGGER CHECK_CLASSIFICAZIONE
AFTER INSERT ON CLASSIFICAZIONE
FOR EACH ROW
BEGIN
  UPDATE UTENTE SET N_Classificazione_Totali = N_Classificazione_Totali+1 WHERE (UTENTE.Nome = new.NomeUtente);
  IF((SELECT COUNT(*) FROM CLASSIFICAZIONE WHERE CLASSIFICAZIONE.CodiceSegnalazione = new.CodiceSegnalazione)=5) THEN
    UPDATE SEGNALAZIONE SET NomeLatino = (SELECT NomeLatino FROM CLASSIFICAZIONE WHERE (CLASSIFICAZIONE.CodiceSegnalazione = new.CodiceSegnalazione) GROUP BY NomeLatino LIMIT 1);
    UPDATE UTENTE SET N_Classificazione_Corrette=N_Classificazione_Corrette+1 WHERE UTENTE.Nome = ANY (SELECT NomeUtente FROM CLASSIFICAZIONE WHERE CLASSIFICAZIONE.CodiceSegnalazione = new.CodiceSegnalazione and NomeLatino = ANY  (SELECT NomeLatino FROM SEGNALAZIONE WHERE CodiceSegnalazione = new.CodiceSegnalazione));
    UPDATE UTENTE SET N_Classificazione_Errate=N_Classificazione_Errate+1 WHERE UTENTE.Nome = ANY (SELECT NomeUtente FROM CLASSIFICAZIONE WHERE CLASSIFICAZIONE.CodiceSegnalazione = new.CodiceSegnalazione and NomeLatino != ANY  (SELECT NomeLatino FROM SEGNALAZIONE WHERE CodiceSegnalazione = new.CodiceSegnalazione));
  END IF;

  IF((SELECT COUNT(*) FROM CLASSIFICAZIONE WHERE CLASSIFICAZIONE.CodiceSegnalazione = new.CodiceSegnalazione)>5) THEN
    IF ((SELECT NomeLatino FROM SEGNALAZIONE WHERE SEGNALAZIONE.CodiceSegnalazione= new.CodiceSegnalazione) =  (SELECT NomeLatino FROM CLASSIFICAZIONE WHERE (CLASSIFICAZIONE.CodiceSegnalazione = new.CodiceSegnalazione) GROUP BY NomeLatino DESC LIMIT 1)) THEN
      IF ((SELECT NomeLatino FROM SEGNALAZIONE WHERE SEGNALAZIONE.CodiceSegnalazione= new.CodiceSegnalazione) = new.NomeLatino) THEN
        UPDATE UTENTE SET N_Classificazione_Corrette=N_Classificazione_Corrette+1 WHERE UTENTE.Nome=new.NomeUtente;
      ELSE
        UPDATE SEGNALAZIONE SET NomeLatino = (SELECT NomeLatino FROM CLASSIFICAZIONE WHERE (CLASSIFICAZIONE.CodiceSegnalazione = new.CodiceSegnalazione) GROUP BY NomeLatino LIMIT 1);
        UPDATE UTENTE SET N_Classificazione_Errate=N_Classificazione_Errate+1 WHERE UTENTE.Nome=new.NomeUtente;
      END IF;
    ELSE
      UPDATE UTENTE SET N_Classificazione_Corrette=N_Classificazione_Corrette-1 WHERE UTENTE.Nome = ANY (SELECT NomeUtente FROM CLASSIFICAZIONE WHERE CLASSIFICAZIONE.CodiceSegnalazione = new.CodiceSegnalazione and NomeLatino = ANY  (SELECT NomeLatino FROM SEGNALAZIONE WHERE CodiceSegnalazione = new.CodiceSegnalazione));
      UPDATE UTENTE SET N_Classificazione_Errate=N_Classificazione_Errate-1 WHERE UTENTE.Nome = ANY (SELECT NomeUtente FROM CLASSIFICAZIONE WHERE CLASSIFICAZIONE.CodiceSegnalazione = new.CodiceSegnalazione and NomeLatino != ANY  (SELECT NomeLatino FROM SEGNALAZIONE WHERE CodiceSegnalazione = new.CodiceSegnalazione));
      UPDATE SEGNALAZIONE SET NomeLatino = (SELECT NomeLatino FROM CLASSIFICAZIONE WHERE (CLASSIFICAZIONE.CodiceSegnalazione = new.CodiceSegnalazione) GROUP BY NomeLatino LIMIT 1);
      UPDATE UTENTE SET N_Classificazione_Corrette=N_Classificazione_Corrette+1 WHERE UTENTE.Nome = ANY (SELECT NomeUtente FROM CLASSIFICAZIONE WHERE CLASSIFICAZIONE.CodiceSegnalazione = new.CodiceSegnalazione and NomeLatino = ANY  (SELECT NomeLatino FROM SEGNALAZIONE WHERE CodiceSegnalazione = new.CodiceSegnalazione));
      UPDATE UTENTE SET N_Classificazione_Errate=N_Classificazione_Errate+1 WHERE UTENTE.Nome = ANY (SELECT NomeUtente FROM CLASSIFICAZIONE WHERE CLASSIFICAZIONE.CodiceSegnalazione = new.CodiceSegnalazione and NomeLatino != ANY  (SELECT NomeLatino FROM SEGNALAZIONE WHERE CodiceSegnalazione = new.CodiceSegnalazione));
    END IF;
  END IF;
END
|
DELIMITER ;

/* Stored Procedure Set Affidabilia */
DELIMITER |
CREATE PROCEDURE SetAffidabilita(IN NomeUtente_ VARCHAR(50))
BEGIN
  SET AUTOCOMMIT = 0;
  START TRANSACTION;
    UPDATE UTENTE SET Affidabilita =(N_Classificazione_Corrette/N_Classificazione_Totali);
  COMMIT;
END
|
DELIMITER ;



/* Stored Proceduce InserisciUtente senza foto*/
DELIMITER |
CREATE PROCEDURE InserisciUtente (IN Nome_ VARCHAR(50), IN Email_ VARCHAR(50), IN Password_ VARCHAR(50), IN AnnoNascita_ INTEGER(4), IN Professione_ VARCHAR(50))
BEGIN
  DECLARE condizione INT DEFAULT 0;
  DECLARE cursore CURSOR FOR SELECT COUNT(*) FROM UTENTE WHERE (Utente.Nome = Nome_);
  OPEN cursore;
    FETCH cursore INTO condizione;
  CLOSE cursore;

  if (condizione = 0) THEN
    SET AUTOCOMMIT = 0;
    START TRANSACTION;
    INSERT INTO UTENTE (Nome, Email, Password, AnnoNascita, Professione) VALUES (Nome_, Email_, Password_, AnnoNascita_, Professione_);
    COMMIT;
  ELSE
    CALL printf ("[ERRORE]: Il nome utente inserito e' gia' presente nel database. Inserire un nuovo nome utente.");
  END IF;
END
|
DELIMITER ;

/* Stored Proceduce InserisciUtente2 con foto*/
DELIMITER |
CREATE PROCEDURE InserisciUtente2 (IN Nome_ VARCHAR(50), IN Email_ VARCHAR(50), IN Password_ VARCHAR(50), IN AnnoNascita_ INTEGER(4), IN Professione_ VARCHAR(50), IN Foto_ mediumblob)
BEGIN
  DECLARE condizione INT DEFAULT 0;
  DECLARE cursore CURSOR FOR SELECT COUNT(*) FROM UTENTE WHERE (Utente.Nome = Nome_);
  OPEN cursore;
    FETCH cursore INTO condizione;
  CLOSE cursore;

  if (condizione = 0) THEN
    SET AUTOCOMMIT = 0;
    START TRANSACTION;
    INSERT INTO UTENTE (Nome, Email, Password, AnnoNascita, Professione, foto) VALUES (Nome_, Email_, Password_, AnnoNascita_, Professione_, foto_);
    COMMIT;
  ELSE
    CALL printf ("[ERRORE]: Il nome utente inserito e' gia' presente nel database. Inserire un nuovo nome utente.");
  END IF;
END
|
DELIMITER ;

/* Stored procedure ScambiaMessaggio */
DELIMITER |
CREATE PROCEDURE ScambiaMessaggio (IN Testo_ VARCHAR(250), IN Titolo_ VARCHAR(50), IN NomeMittente_ VARCHAR(50), IN NomeDestinatario_ VARCHAR(50))
BEGIN
  DECLARE condizione INT DEFAULT 0;
  DECLARE cursore CURSOR FOR SELECT COUNT(*) FROM UTENTE WHERE (UTENTE.Nome = NomeDestinatario_);
  OPEN cursore;
    FETCH cursore INTO condizione;
  close cursore;

  if (condizione = 1) THEN
    SET AUTOCOMMIT = 0;
    START TRANSACTION;
    INSERT INTO Messaggio (Testo, Titolo, NomeMittente, NomeDestinatario) VALUES (Testo_, Titolo_, NomeMittente_, NomeDestinatario_);
    COMMIT;
  ELSE
   CALL printf ("[ERRORE]:Il Destinatario inserito non e' presente nel database.");
  END IF;
END
|
DELIMITER ;

/* Stored procedure InserisciCampagnaFondi */
DELIMITER |
CREATE PROCEDURE InserisciCampagnaFondi (IN Descrizione_ VARCHAR(200), IN ImportoMassimo_ DECIMAL, IN NomeUtente_ VARCHAR(50))
BEGIN
  DECLARE condizione INT DEFAULT 0;
  DECLARE cursore CURSOR FOR SELECT COUNT(*) FROM UTENTE WHERE ((UTENTE.Nome = NomeUtente_) AND (UTENTE.TipoUtente = "Amministratore"));
  OPEN cursore;
    FETCH cursore INTO condizione;
  close cursore;

  if (condizione = 1 ) THEN
    SET AUTOCOMMIT = 0;
    START TRANSACTION;
    INSERT INTO CAMPAGNA_FONDI (Descrizione, ImportoMassimo, NomeUtente) VALUES (Descrizione_, ImportoMassimo_, NomeUtente_);
    COMMIT;
  ELSE
    CALL printf ("[ERRORE]: Impossibile inserire la campagna fondi (solo gli utenti amministratori possono inserire le campagne fondi)");
  END IF;
END
|
DELIMITER ;

/* Stored procedure InserisciDonazione */
DELIMITER |
CREATE PROCEDURE InserisciDonazione (IN CodiceCampagna_ INTEGER(2), IN NomeUtente_ VARCHAR(50), IN Importo_ DECIMAL, IN Note_ VARCHAR(200))
BEGIN
  SET AUTOCOMMIT = 0;
  START TRANSACTION;
  INSERT INTO DONAZIONE (CodiceCampagna, NomeUtente, Importo, Note) VALUES (CodiceCampagna_, NomeUtente_, Importo_, Note_);
  COMMIT;
END;
|
DELIMITER ;

/* Stored procedure InserisciEscursione */
DELIMITER |
CREATE PROCEDURE InserisciEscursione (IN Titolo_ VARCHAR(50), IN Data_ DATE, IN OrarioPartenza_ TIME, IN OrarioRitorno_ TIME, IN Tragitto_ VARCHAR(50), IN Descrizione_ VARCHAR(200), IN NumeroMaxPartecipanti_ INTEGER, IN NomeUtente_ VARCHAR(50))
BEGIN
  DECLARE condizione INT DEFAULT 0;
  DECLARE cursore CURSOR FOR SELECT COUNT(*) FROM UTENTE WHERE ((UTENTE.Nome = NomeUtente_) AND (UTENTE.TipoUtente = "Premium"));
  OPEN cursore;
    FETCH cursore INTO condizione;
  close cursore;

  if (condizione = 1 ) THEN
    SET AUTOCOMMIT = 0;
    START TRANSACTION;
    INSERT INTO ESCURSIONE (Titolo, Data, OrarioPartenza, OrarioRitorno, Tragitto, Descrizione, N_Max_Partecipanti, NomeUtente) VALUES (Titolo_, Data_,OrarioPartenza_, OrarioRitorno_, Tragitto_, Descrizione_, NumeroMaxPartecipanti_, NomeUtente_);
    COMMIT;
  ELSE
    CALL printf ("[ERRORE]: Impossibile inserire l'escursione (solo gli utenti premium possono inserire le campagne fondi)");
  END IF;
END
|
DELIMITER ;

/* Stored Procedure InserisciIscrizione */
DELIMITER |
CREATE PROCEDURE InserisciIscrizione (IN NomeUtente_ VARCHAR(50), IN CodiceEscursione_ INTEGER)
BEGIN
  DECLARE condizione INT DEFAULT 0;
  DECLARE condizione2 INT DEFAULT 0;
  DECLARE cursore CURSOR FOR SELECT COUNT(*) FROM UTENTE WHERE ((UTENTE.Nome = NomeUtente_) AND (UTENTE.TipoUtente = "Premium" OR UTENTE.TipoUtente = "Semplice"));
  DECLARE cursore2 CURSOR FOR SELECT COUNT(*) FROM ESCURSIONE WHERE (ESCURSIONE.CodiceEscursione = CodiceEscursione_);

  OPEN cursore;
    FETCH cursore INTO condizione;
  close cursore;

  OPEN cursore2;
    FETCH cursore2 INTO condizione2;
  close cursore2;

  IF ((condizione = 0) OR (condizione2 = 0)) THEN
    CALL printf("[ERRORE utente] oppure [ERRORE codice escursione]");
  ELSE
    SET AUTOCOMMIT = 0;
    START TRANSACTION;
    INSERT INTO ISCRIZIONE (NomeUtente, CodiceEscursione) VALUES (NomeUtente_, CodiceEscursione_);
    COMMIT;
  END IF;
END
|
DELIMITER ;

/* Stored procedure InserisciHabitat */
DELIMITER |
CREATE PROCEDURE InserisciHabitat (IN NomeHabitat_ VARCHAR(50), IN Descrizione_ VARCHAR(200), IN NomeUtente_ VARCHAR(50))
BEGIN
  DECLARE condizione INT DEFAULT 0;
  DECLARE condizione2 INT DEFAULT 0;
  DECLARE cursore CURSOR FOR SELECT COUNT(*) FROM UTENTE WHERE ((UTENTE.Nome = NomeUtente_) AND (UTENTE.TipoUtente = "Amministratore"));
  DECLARE cursore2 CURSOR FOR SELECT COUNT(*) FROM HABITAT WHERE (HABITAT.NomeHabitat = NomeHabitat_);
  OPEN cursore;
    FETCH cursore INTO condizione;
  close cursore;
  OPEN cursore2;
    FETCH cursore2 INTO condizione2;
  close cursore2;

  IF ((condizione=0) OR (condizione2=1)) THEN
    CALL printf("[ERRORE utente] oppure [ERRORE nome habitat]");
  ELSE
    SET AUTOCOMMIT = 0;
    START TRANSACTION;
    INSERT INTO HABITAT (NomeHabitat, Descrizione, NomeUtente) VALUES (NomeHabitat_, Descrizione_, NomeUtente_);
    COMMIT;
  END IF;
END
|
DELIMITER ;

/* Stored procedure InserisciSpecieAnimale */
DELIMITER |
CREATE PROCEDURE InserisciSpecieAnimale (IN Classe_ VARCHAR(50), IN NomeLatino_ VARCHAR(50), IN NomeItaliano_ VARCHAR(50), AnnoClassificazione_ INTEGER(4), IN LivelloVulnerabilita_ VARCHAR(50), IN LinkWikipedia_ VARCHAR(50), IN NomeUtente_ VARCHAR(50), IN Peso_ VARCHAR(50), IN Altezza_ VARCHAR(50), IN Numerosita_ VARCHAR(50), IN NomeHabitat_ VARCHAR(50))
BEGIN
  DECLARE condizione INT DEFAULT 0;
  DECLARE condizione2 INT DEFAULT 0;
  DECLARE condizione3 INT DEFAULT 0;
  DECLARE cursore CURSOR FOR SELECT COUNT(*) FROM SPECIE WHERE (SPECIE.NomeLatino = NomeLatino_);
  DECLARE cursore2 CURSOR FOR SELECT COUNT(*) FROM UTENTE WHERE ((UTENTE.Nome = NomeUtente_) AND (UTENTE.TipoUtente = "Amministratore"));
  DECLARE cursore3 CURSOR FOR SELECT COUNT(*) FROM HABITAT WHERE (HABITAT.NomeHabitat = NomeHabitat_);

  OPEN cursore;
    FETCH cursore INTO condizione;
  close cursore;
  OPEN cursore2;
    FETCH cursore2 INTO condizione2;
  close cursore2;
  OPEN cursore3;
    FETCH cursore3 INTO condizione3;
  close cursore3;

  IF ((condizione = 1 ) OR (condizione2 = 0) OR (condizione3 = 0)) THEN
    CALL printf("[ERRORE:la specie e' gia' presente nel database] oppure [ERRORE: l'utente non è amministratore] oppure [ERRORE: l'habitat non è presente nel database]");
  ELSE
  SET AUTOCOMMIT = 0;
  START TRANSACTION;
    INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia, NomeUtente) VALUES (Classe_, NomeLatino_, NomeItaliano_, AnnoClassificazione_, LivelloVulnerabilita_, LinkWikipedia_, NomeUtente_);
    INSERT INTO ANIMALE (NomeLatino, Peso, Altezza, Numerosita) VALUES (NomeLatino_,Peso_, Altezza_,Numerosita_);
    INSERT INTO APPARTENENZA (NomeLatino, Nomehabitat) VALUES (NomeLatino_, NomeHabitat_);
  COMMIT;
  END IF;
END
|
DELIMITER ;

/* Stored procedure InserisciSpecieAnimale2 inserimento di una specie animale senza il link di wikipedia */
DELIMITER |
CREATE PROCEDURE InserisciSpecieAnimale2 (IN Classe_ VARCHAR(50), IN NomeLatino_ VARCHAR(50), IN NomeItaliano_ VARCHAR(50), AnnoClassificazione_ INTEGER(4), IN LivelloVulnerabilita_ VARCHAR(50), IN NomeUtente_ VARCHAR(50), IN Peso_ VARCHAR(50), IN Altezza_ VARCHAR(50), IN Numerosita_ VARCHAR(50), IN NomeHabitat_ VARCHAR(50))
BEGIN
  DECLARE condizione INT DEFAULT 0;
  DECLARE condizione2 INT DEFAULT 0;
  DECLARE condizione3 INT DEFAULT 0;
  DECLARE cursore CURSOR FOR SELECT COUNT(*) FROM SPECIE WHERE (SPECIE.NomeLatino = NomeLatino_);
  DECLARE cursore2 CURSOR FOR SELECT COUNT(*) FROM UTENTE WHERE ((UTENTE.Nome = NomeUtente_) AND (UTENTE.TipoUtente = "Amministratore"));
  DECLARE cursore3 CURSOR FOR SELECT COUNT(*) FROM HABITAT WHERE (HABITAT.NomeHabitat = NomeHabitat_);

  OPEN cursore;
    FETCH cursore INTO condizione;
  close cursore;
  OPEN cursore2;
    FETCH cursore2 INTO condizione2;
  close cursore2;
  OPEN cursore3;
    FETCH cursore3 INTO condizione3;
  close cursore3;

  IF ((condizione = 1 ) OR (condizione2 = 0) OR (condizione3 = 0)) THEN
    CALL printf("[ERRORE:la specie e' gia' presente nel database] oppure [ERRORE: l'utente non è amministratore] oppure [ERRORE: l'habitat non è presente nel database]");
  ELSE
  SET AUTOCOMMIT = 0;
  START TRANSACTION;
    INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, NomeUtente) VALUES (Classe_, NomeLatino_, NomeItaliano_, AnnoClassificazione_, LivelloVulnerabilita_, NomeUtente_);
    INSERT INTO ANIMALE (NomeLatino, Peso, Altezza, Numerosita) VALUES (NomeLatino_,Peso_, Altezza_,Numerosita_);
    INSERT INTO APPARTENENZA (NomeLatino, Nomehabitat) VALUES (NomeLatino_, NomeHabitat_);
  COMMIT;
  END IF;
END
|
DELIMITER ;

/*Stored procedure InserisciSpecieVegetale*/
DELIMITER |
CREATE PROCEDURE InserisciSpecieVegetale(IN Classe_ VARCHAR(50), IN NomeLatino_ VARCHAR(50), IN NomeItaliano_ VARCHAR(50), IN AnnoClassificazione_ INTEGER(4), IN LivelloVulnerabilita_ VARCHAR(50), IN LinkWikipedia_ VARCHAR(50), IN NomeUtente_ VARCHAR(50), IN Altezza_ VARCHAR(50), IN Diametro_ varchar(50),  IN NomeHabitat_ VARCHAR(50))
BEGIN
  DECLARE condizione INT DEFAULT 0;
  DECLARE condizione2 INT DEFAULT 0;
  DECLARE condizione3 INT DEFAULT 0;
  DECLARE cursore CURSOR FOR SELECT COUNT(*) FROM SPECIE WHERE (SPECIE.NomeLatino = NomeLatino_);
  DECLARE cursore2 CURSOR FOR SELECT COUNT(*) FROM UTENTE WHERE ((UTENTE.Nome = NomeUtente_) AND (UTENTE.TipoUtente = "Amministratore"));
  DECLARE cursore3 CURSOR FOR SELECT COUNT(*) FROM HABITAT WHERE (HABITAT.NomeHabitat = NomeHabitat_);

  OPEN cursore;
    FETCH cursore INTO condizione;
  close cursore;
  OPEN cursore2;
    FETCH cursore2 INTO condizione2;
  close cursore2;
  OPEN cursore3;
    FETCH cursore3 INTO condizione3;
  close cursore3;

  IF ((condizione = 1 ) OR (condizione2 = 0) OR (condizione3 = 0)) THEN
    CALL printf("[ERRORE:la specie e' gia' presente nel database] oppure [ERRORE: l'utente non è amministratore] oppure [ERRORE: l'habitat non è presente nel database]");
  ELSE
    SET AUTOCOMMIT = 0;
    START TRANSACTION;
      INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, LinkWikipedia, NomeUtente) VALUES (Classe_, NomeLatino_, NomeItaliano_, AnnoClassificazione_, LivelloVulnerabilita_, LinkWikipedia_, NomeUtente_);
      INSERT INTO VEGETALE (NomeLatino, Altezza, Diametro) VALUES (NomeLatino_, Altezza_, Diametro_);
      INSERT INTO APPARTENENZA (NomeLatino, Nomehabitat) VALUES (NomeLatino_, NomeHabitat_);
    COMMIT;
  END IF;
END
|
DELIMITER ;

/*Stored procedure InserisciSpecieVegetale2*/
DELIMITER |
CREATE PROCEDURE InserisciSpecieVegetale2(IN Classe_ VARCHAR(50), IN NomeLatino_ VARCHAR(50), IN NomeItaliano_ VARCHAR(50), IN AnnoClassificazione_ INTEGER(4), IN LivelloVulnerabilita_ VARCHAR(50), IN NomeUtente_ VARCHAR(50), IN Altezza_ VARCHAR(50), IN Diametro_ varchar(50),  IN NomeHabitat_ VARCHAR(50))
BEGIN
  DECLARE condizione INT DEFAULT 0;
  DECLARE condizione2 INT DEFAULT 0;
  DECLARE condizione3 INT DEFAULT 0;
  DECLARE cursore CURSOR FOR SELECT COUNT(*) FROM SPECIE WHERE (SPECIE.NomeLatino = NomeLatino_);
  DECLARE cursore2 CURSOR FOR SELECT COUNT(*) FROM UTENTE WHERE ((UTENTE.Nome = NomeUtente_) AND (UTENTE.TipoUtente = "Amministratore"));
  DECLARE cursore3 CURSOR FOR SELECT COUNT(*) FROM HABITAT WHERE (HABITAT.NomeHabitat = NomeHabitat_);

  OPEN cursore;
    FETCH cursore INTO condizione;
  close cursore;
  OPEN cursore2;
    FETCH cursore2 INTO condizione2;
  close cursore2;
  OPEN cursore3;
    FETCH cursore3 INTO condizione3;
  close cursore3;

  IF ((condizione = 1 ) OR (condizione2 = 0) OR (condizione3 = 0)) THEN
    CALL printf("[ERRORE:la specie e' gia' presente nel database] oppure [ERRORE: l'utente non è amministratore] oppure [ERRORE: l'habitat non è presente nel database]");
  ELSE
    SET AUTOCOMMIT = 0;
    START TRANSACTION;
      INSERT INTO SPECIE (Classe, NomeLatino, NomeItaliano, AnnoClassificazione, LivelloVulnerabilita, NomeUtente) VALUES (Classe_, NomeLatino_, NomeItaliano_, AnnoClassificazione_, LivelloVulnerabilita_, NomeUtente_);
      INSERT INTO VEGETALE (NomeLatino, Altezza, Diametro) VALUES (NomeLatino_, Altezza_, Diametro_);
      INSERT INTO APPARTENENZA (NomeLatino, Nomehabitat) VALUES (NomeLatino_, NomeHabitat_);
    COMMIT;
  END IF;
END
|
DELIMITER ;

/* Stored procedure InserisciSegnalazione */
DELIMITER |
CREATE PROCEDURE InserisciSegnalazione(IN Latitudine_ VARCHAR(50), IN Longitudine_ VARCHAR(50), IN NomeHabitat_ VARCHAR(50), IN Foto_ mediumblob, IN NomeUtente_ VARCHAR(50))
BEGIN
  SET AUTOCOMMIT = 0;
  START TRANSACTION;
    INSERT INTO SEGNALAZIONE (Latitudine, Longitudine, NomeHabitat,Foto, NomeUtente) VALUES (Latitudine_, Longitudine_, NomeHabitat_, Foto_, NomeUtente_);
  COMMIT;
END
|
DELIMITER ;

/* Stored procedure InserisciClassificazione */
DELIMITER |
CREATE PROCEDURE InserisciClassificazione(IN Commento_ VARCHAR(50), IN NomeUtente_ VARCHAR(50), IN CodiceSegnalazione_ INTEGER, IN NomeLatino_ VARCHAR(50))
BEGIN
  SET AUTOCOMMIT = 0;
  START TRANSACTION;
    INSERT INTO CLASSIFICAZIONE(Commento,NomeUtente,CodiceSegnalazione,NomeLatino) VALUES (Commento_, NomeUtente_, CodiceSegnalazione_, NomeLatino_);
  COMMIT;
END
|
DELIMITER ;

/* Stored procedure InserisciCorrezione */
DELIMITER |
CREATE PROCEDURE InserisciCorrezione(IN NomeUtente_ VARCHAR(50), IN CodiceClassificazione_ INTEGER)
BEGIN
  SET AUTOCOMMIT = 0;
  START TRANSACTION;
    INSERT INTO CORREZIONE(NomeUtente,CodiceClassificazione) VALUES ( NomeUtente_, CodiceClassificazione_);
  COMMIT;
END
|
DELIMITER ;

INSERT INTO UTENTE (Nome,Email,Password,TipoUtente) VALUES ("ADMIN","admin@adimin", "ADMIN", "AMMINISTRATORE");
INSERT INTO UTENTE (Nome,Email,Password,TipoUtente) VALUES ("Premium1","premium1@emal.com", "Premium1", "Premium");
INSERT INTO UTENTE (Nome,Email,Password,TipoUtente) VALUES ("Premium2","premium2@emal.com", "Premium2", "Premium");
INSERT INTO UTENTE (Nome,Email,Password,TipoUtente) VALUES ("Premium3","premium3@emal.com", "Premium3", "Premium");
INSERT INTO UTENTE (Nome,Email,Password,TipoUtente) VALUES ("Premium4","premium4@emal.com", "Premium4", "Premium");
