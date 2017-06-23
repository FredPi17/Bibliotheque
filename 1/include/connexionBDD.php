<?php
/**
**\author Joseph Tabailloux
*\verificator Hugo Lausenaz Pire et Frederic Pinaud
*\Fonction connexion à la base de données mysql
*/
	define("DB_SERVER", "localhost");
	define("DB_BASE", "bibliotheque");
	define("DB_USER", "root");
	define("DB_PASSWORD", "");

	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$bdd = new PDO('mysql:host=' . DB_SERVER . ';dbname=' . DB_BASE, DB_USER, DB_PASSWORD, $pdo_options);
	$bdd->exec("Set character set utf8");
?>