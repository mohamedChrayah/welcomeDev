<?php

 /**
  * Connexion à la base de données
  */
try {
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$db_connect = new PDO("mysql:host=localhost;dbname=nouveau_arrivant", "root", "root", $pdo_options);
}
catch (PDOException $error) {
	echo '<pre>';
	echo 'Error connecting to SQL Server<br>' ;
	echo 'Erreur : ', utf8_decode($error->getMessage()), '<br>';
	echo '</pre>';
	exit();
}

/**
 * Toutes les fonctions en liaison avec les tables
 */

// EXEMPLE de requête

?>
