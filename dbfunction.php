<?php
	//classe con tutte le funzioni inerenti al DB 
	class Database {
	
		//variabile pubblica per la connessione al DB tramite PDO
		public $conn;
		
		//funzione SOLO per la creazione del DB (se non ancora esistente)
		public function createDB ($name,$u,$p) {
			try{
				$this->conn = new PDO ("mysql:host=localhost","$u","");
			} catch (PDOException $e) { echo "Errore $e"; exit();}
			$create = "
				CREATE DATABASE IF NOT EXISTS $name
				";
			$this->conn->exec($create);
		}
		
		//funzione per la connessione al DB (che deve già esistere)
		public function connDB ($name,$u,$p) {
			try{
				$this->conn = new PDO ("mysql:host=localhost;dbname=$name","$u","");
			} catch (PDOException $e) { echo "Errore"; exit();}
		}
		
		//funzione per la creazione della tabella utenti (se non già esistente)
		public function TButenti () {
			$createT = "
				CREATE TABLE utenti
				(
				IDutente INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(IDutente),
				nome VARCHAR(30),
				cognome VARCHAR(30),
                username VARCHAR(30),
				email VARCHAR(30),				
				password VARCHAR(100)
				);
				";
			$this->conn->query($createT);
		}
		
		//funzione per la creazione della tabella admin (se non già esistente)
		public function TBadmin () {
			$createT = "
				CREATE TABLE admin
				(
				IDadmin INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(IDadmin),
				IDutente INT
				);
				";
			$this->conn->query($createT);
		}
        
        public function TBmusica () {
			$createT = "
				CREATE TABLE musica
				(
				IDmusica INT NOT NULL AUTO_INCREMENT,
				PRIMARY KEY(IDmusica),
				titolo VARCHAR(30),
                dimensione VARCHAR(30),
                durata VARCHAR(30),
                nfile VARCHAR(100)
				);
				";
			$this->conn->query($createT);
		}
        
        //funzione per l'inserimento degli utenti di base (amministratore di default e nostri, creatori della pagina, utenti)
        public function insertUtenti () {
			$controllo = "
				SELECT count(*) FROM utenti
				";
			if ($this->conn->query($controllo)->fetchColumn()==0) {
				$inserT = "
					INSERT INTO utenti () VALUES(1,'Gianluca','Magi','GianMagic9618','gian.magic9618@gmail.com','".sha1('gianlucamagi')."');
                    INSERT INTO admin () VALUES(1,1);
					";
				$this->conn->query($inserT);
			}
		}
        //funzione per le chiavi esterne
        public function AlterTable () {
			$AlterT = "
				ALTER TABLE admin
				ADD FOREIGN KEY (IDutente) REFERENCES utenti(IDutente);
				";
			$this->conn->query($AlterT);
		}
        
        public function contrAdmin ($id) {
			$contr=true;
			$controllo = "
				SELECT count(*) FROM admin WHERE IDutente = $id
			";
            //$ris=$this->conn->query($controllo)
			if ($this->conn->query($controllo)->fetchColumn()==0) $contr=false;
			return $contr;
		}
        
        public function datiUtenti () {
			$utente = "
				SELECT username,IDutente FROM utenti 
				";
			return $this->conn->query($utente);
		}
        
        public function insertAdmin ($id) {
			$ins = "
				INSERT INTO admin (IDutente) VALUES($id)
				";
			$this->conn->query($ins);
		}
		
		public function deleteAdmin ($id) {
			$del = "
				DELETE FROM admin WHERE IDutente=$id
				";
			$this->conn->query($del);
		}

    }
?>