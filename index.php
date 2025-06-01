<?php

session_start();

// HEURE FRANÇAISE POUR  date(H:i)
date_default_timezone_set('Europe/Paris');

// INCLUDE ENTETE
include "vues/v_commun/v_entete.php";

// INCLUDE BANDEAU
include "vues/v_commun/v_topBandeau.php";
include "vues/v_commun/v_bandeau.php";

// APPEL DU CONTROLEUR
include "Controleur/c_controleur.php";
// INCLUDE FOOTER
include "vues/v_commun/v_pied.php";