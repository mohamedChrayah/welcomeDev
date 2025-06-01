<?php

class CAFCPDO extends PDO {
	/*
	 * Constructeur
	 * Utilisation possibles :
	 * - $db = new CAFCPDO($dsn)
	 * - $db = new CAFCPDO($dsn,$user,$password)
	 * - $db = new CAFCPDO($dsn,,,$options)
	 * - $db = new CAFCPDO($dsn,$user,$password,$options)
	 *
	 * Le mode de gestion des erreurs est l'utilisation des exceptions (try ... catch ...)
	 */
	public function __construct($dsn,$uname='',$upass='',$options=array()) {
		$db = parent::__construct($dsn,$uname,$upass,$options);
   		parent::setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION );
		return($db);
	}

	/*
	 * getLastId
	 * Utilisation :
	 * - $lastid = $db->getLastId();
	 *
	 * Resultat : une valeur contenant le dernier id enregistr�
	 */
	public function getLastId() {
	    $statement = parent::query('select @@identity as lastid');
	    $resultat = $statement->fetch(PDO::FETCH_ASSOC);
	    return $resultat['lastid'];
	}

	/*
	 * getAll
	 * Utilisation :
	 * - $rows = $db->getAll($sql[,$fetchmode])
	 * Le fetchmode par d�faut est FETCH_ASSOC
	 *
	 * R�sultat : un array des enregistrements trouv�s, ou un array vide
	 *
	 */
	public function getAll($sql) {
		$statement = parent::query($sql);
		$result = $statement->fetchAll();
		if (is_array($result)) {
			return $result;
		} else {
			return array();
		}
	}

	/*
	 * getRow
	 * Utilisation :
	 * - $row = $db->getRow($sql[,$fetchmode])
	 * Le fetchmode par d�faut est FETCH_ASSOC
	 *
	 * R�sultat : un array des colonnes de l'enregistrement trouv�, ou un array vide
	 *
	 */
	public function getRow($sql,$fetchmode = PDO::FETCH_ASSOC) {
		$statement = parent::query($sql);
		$result = $statement->fetch($fetchmode);
		if (is_array($result)) {
			return $result;
		} else {
			return array();
		}
	}

	/*
	 * getColumn
	 * Utilisation :
	 * - $cols = $db->getColumn($sql,$colonne)
	 *
	 * R�sultat : un array de la colonne demand�e des enregistrements trouv�s, ou un array vide
	 *
	 */
	public function getColumn($sql,$colonne) {
		$statement = parent::query($sql);
		$result = $statement->fetchAll(PDO::FETCH_COLUMN);
		if (is_array($result)) {
			return $result;
		} else {
			return array();
		}
	}

	/*
	 * getColumn
	 * Utilisation :
	 * - $cols = $db->getCol($sql)
	 *
	 * R�sultat : un array de la colonne demand�e des enregistrements trouv�s, ou un array vide
	 *
	 */
	public function getCol($sql) {
		$statement = parent::query($sql);
		$result = $statement->fetchAll(PDO::FETCH_COLUMN);
		if (is_array($result)) {
			return $result;
		} else {
			return array();
		}
	}
	/*
	 * getValue
	 * Utilisation :
	 * - $cols = $db->getValue($sql)
	 *
	 * R�sultat : une valeur contenant la premi�re colonne de l'enregistrement trouv�, ou une valeur vide
	 *
	 */
	public function getValue($sql) {
		$statement = parent::query($sql);
		$result = $statement->fetch(PDO::FETCH_NUM);
		if (is_array($result)) {
			return $result[0];
		} else {
			return '';
		}
	}

	/* Proc�dure stock�e Select + Fetch */
	public function getValuePs($procedure,$parametres) {
		$table = array();
		foreach ($parametres as $zone=>$valeur) { $table[] = ':' . $zone; }
		$commande = "EXECUTE $procedure " . implode(',',$table);
		$statement = parent::prepare($commande);
		foreach ($parametres as $zone=>$valeur) {
			$statement->bindValue(':' . $zone, $valeur);
		}
		$res = $statement->execute();
		$result = $statement->fetch(PDO::FETCH_NUM);
		return $result[0];
	}

	/* Proc�dure stock�e Select + FetchAll */
	public function getAllPs($procedure,$parametres,$fetchmode = PDO::FETCH_ASSOC) {
		$table = array();
		foreach ($parametres as $zone=>$valeur) { $table[] = ':' . $zone; }
		$commande = "EXECUTE $procedure " . implode(',',$table);
		$statement = parent::prepare($commande);
		foreach ($parametres as $zone=>$valeur) {
			$statement->bindValue(':' . $zone, $valeur);
		}
		$res = $statement->execute();
		$result = $statement->fetchAll($fetchmode);
		return $result;
	}

	/*
		ex�cute purement et simplement le contenu de $sql
	*/
	public function execSQL($sql) {
		try{
			$result = parent::exec($sql);
			return $result;
		} catch(Exception $e){
			return false;
		}
	}



	/*
	* Cr�ation des fonctions
	*/

}




?>
