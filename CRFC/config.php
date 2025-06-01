<?php
//
// lecture param�tres CR
//
//define('PATH_PARAM_CR','E:/env/CR/paramsCR.xml');
//define('PATH_PARAM_CR','http://'.$_SERVER['HTTP_HOST'].'/CR/paramsCR.xml');
//$paramsCR = simplexml_load_file(PATH_PARAM_CR);
define('PPC_PATH_PARAM_CR','http://'.$_SERVER['HTTP_HOST'].'/CR/paramsCR.xml');
$paramsCR = simplexml_load_file(PPC_PATH_PARAM_CR);

// ************* AJOUT FDM *******************

if(!defined('LIB_PATH')) {
    define('LIB_PATH', DIRECTORY_SEPARATOR . 'env' . DIRECTORY_SEPARATOR . 'ApachePub' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'PHP' . DIRECTORY_SEPARATOR );
}
//Lien vers le composant NTLM
require_once(LIB_PATH . 'CAT/ntlm/ntlm_pic.php');

// ************* Fin AJOUT FDM *******************

// Environnement de fonctionnement
//
define('CONFIG_ENVIRONNEMENT',$paramsCR->environnement);

// communs
$db_serveur = $paramsCR->SGBD->SQL;
$db_driver = 'odbc:Driver={SQL Native Client}';

// mails
$C_adresseCopy = array();
$C_adresseBlindCopy = array();
//$C_adresse = array("martine.landry@ca-centreloire.fr"); //Mail du si�ge qui va valider la MAD
$C_adresse = array(); //Mail du si�ge qui va valider la MAD
$C_adresseTest = array();

//Configuration du code banque dans le rib
$C_code_banque = '14806'; //CR Centre Loire

//Message confirmation quand le montant est sup�rieur � 50 000�
$C_max = 50000;

?>
