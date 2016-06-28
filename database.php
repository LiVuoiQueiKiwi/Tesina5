<?php
	require_once('dbfunction.php');
    session_start();
	//creo un oggetto Database
	$D = new Database();
	//richiamo la funzione per la creazione del DB
	$D->createDB("tesina5","root","");
    $D->connDB("tesina5","root","");
	//chiudo la connessione a xampp perchè mi sono connesso genericamente per creare il DB
	//richiamo le funzioni per la creazione delle tabelle e delle chiavi esterne
	$D->TButenti();
	$D->TBadmin();
    $D->TBmusica();
	$D->AlterTable();
	//inserisco gli utenti di base
	$D->insertUtenti();
	//chiudo la connessione al DB
	$D->conn=null;
?>