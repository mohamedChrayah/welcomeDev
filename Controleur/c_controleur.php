<?php
include "AccesBase/acces_base.php";
include "modele/utilisateur.php";

if(!isset($_GET['action'])){
	$_GET['action'] = 'connexion';
}

$action = $_GET['action'];
function ajouterValidation(string $titre, string $message)
{
    $_REQUEST['success'] = [$titre, $message];
    include "vues/v_commun/v_validation.php";
}

function ajouterErreur(string $string)
{
    $_REQUEST['erreurs'] = [$string];
    include "vues/v_commun/v_erreurs.php";
}

switch($action){


    /* Affichage de la vue accueil là où sont stocké tous les contacts */
    case 'demandeAffichage': {
        accueil:
        $user= $_SESSION['utilisateur'];
        if($user!=null) {
            $lesClients = getTousLesClients();
            include "vues/v_accueil/v_accueil.php";
        }
        else{
            include "vues/v_connexion/v_connexion.php";
        }
        break;
    }

    /* Connexion */
    case 'connexion' : {
        if (isset($_SESSION['utilisateur'])) {
            $lesClients = getTousLesClients();
            include "vues/v_accueil/v_accueil.php";
            break;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['identifiant'])) {
            $identifiant = $_POST['identifiant'];
            $utilisateur = getUtilisateurParIdentifiant($identifiant);

            if ($utilisateur) {
                $_SESSION['utilisateur'] = $utilisateur;
                $lesClients = getTousLesClients();
                goto accueil;
            } else {
                ajouterErreur("Identifiant inconnu");
            }
        }

        include("vues/v_connexion/v_connexion.php");
        break;
    }


    case 'deconnexion':
    {
        session_unset();
        session_destroy();
        include "vues/v_connexion/v_connexion.php";
        break;
    }



    /**
     * Ecrire le code permettant d'ajouter un contact (Nom, Prénom, Age, Lieu)
     */
    case 'ajouterContact':{
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $age=$_POST['age'];
        $lieu=$_POST['lieu'];

        $resultat = ajouterContact($nom,$prenom,$age,$lieu);

        /**
         * Permet d'afficher un message de succès ou d'erreur
         */
        if($resultat){
            ajouterValidation("Enregistré", "Le client a bien été ajouté.");
        }else{
            ajouterErreur("Erreur", "Le client n'a pas été ajouté correctement...");
        }
        // Redirige vers la page d'accueil là où sont stocké tous les contacts
        goto accueil;
    }

    /**
     * Ecrire le code permettant de modifier un contact (Nom, Prénom, Age, Lieu)
     */
    case 'modifierContact':{
        $id= intval($_GET['id']);
        $nom=$_POST['nom'];
        $prenom=$_POST['prenom'];
        $age=$_POST['age'];
        $lieu=$_POST['lieu'];

        $resultat = modifierContact($id,$nom,$prenom,$age,$lieu);

        /**
         * Permet d'afficher un message de succès ou d'erreur
         */
        if($resultat){
            ajouterValidation("Modifié", "Le contact a bien été modifié.");
        }else{
            ajouterErreur("Erreur");
        }
        // Redirige vers la page d'accueil là où sont stocké tous les contacts
        goto accueil;
    }

    /**
     * Permet de supprimer un contact
     */
    case 'supprimerContact':{
        $id = intval($_GET['id']);
        supprimerContact($id);
        ajouterValidation("Contact supprimé", "Le contact a été supprimé avec succès.");

        // Redirection vers l'accueil
        goto accueil;
    }

    case 'tableauBord':{
        include "vues/v_chart/v_chart.php";
        break;
    }

}

?>