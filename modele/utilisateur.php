<?php

function getTousLesClients() {
    global $db_connect;
    $req = $db_connect->prepare("SELECT * FROM contact");
    $req->execute();
    return $req->fetchAll();
}
function getUtilisateurParIdentifiant($identifiant) {
    global $db_connect;
    $req = $db_connect->prepare("SELECT * FROM utilisateur WHERE identifiant = :identifiant");
    $req->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
    $req->execute();
    return $req->fetch(PDO::FETCH_ASSOC);
}

function supprimerContact($id) {
    global $db_connect;
    $req = $db_connect->prepare("DELETE FROM contact WHERE id = :id");
    $req->bindParam(':id', $id, PDO::PARAM_INT);
    $req->execute();
}

function ajouterContact($nom, $prenom, $age, $lieu): bool
{
    global $db_connect;

    try {
        $req = $db_connect->prepare("INSERT INTO contact (nom, prenom, age, lieu) VALUES (:nom, :prenom, :age, :lieu)");
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':age', $age);
        $req->bindParam(':lieu', $lieu);

        $req->execute();

        return true;
    } catch (PDOException $e) {
        return false;
    }
}

function modifierContact($id,$nom, $prenom, $age, $lieu): bool
{
    global $db_connect;

    try {
        $req = $db_connect->prepare(" UPDATE contact 
            SET nom = :nom, prenom = :prenom, age = :age, lieu = :lieu 
            WHERE id = :id");
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->bindParam(':nom', $nom);
        $req->bindParam(':prenom', $prenom);
        $req->bindParam(':age', $age);
        $req->bindParam(':lieu', $lieu);

        return $req->execute();

    } catch (PDOException $e) {
        return false;
    }
}

function getNbClientsParMois() {
    global $db_connect;

    $req = $db_connect->prepare("
        SELECT DATE_FORMAT(date_creation, '%Y-%m') as mois, COUNT(*) as total
        FROM contact
        GROUP BY mois
        ORDER BY mois ASC
    ");
    $req->execute();
    return $req->fetchAll(PDO::FETCH_ASSOC);
}
