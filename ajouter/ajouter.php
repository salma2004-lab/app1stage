<?php
// Connexion à la base de données
try {
    $db = new PDO('mysql:host=localhost;dbname=ista', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $matStagiaire = $_POST['matStagiaire'];
    $nomStagiaire = $_POST['nomStagiaire'];
    $prenomStagiaire = $_POST['prenomStagiaire'];
    $filiereStagiaire = $_POST['filiereStagiaire'];
    $anneeEtude = $_POST['anneeEtude'];
    $typeBac = $_POST['typeBac'];
    $anneeBac = $_POST['anneeBac'];

    // Validation basique côté serveur
    if (
        !empty($matStagiaire) && !empty($nomStagiaire) && !empty($prenomStagiaire) && !empty($filiereStagiaire) &&
        is_numeric($anneeEtude) && is_numeric($anneeBac)
    ) {
        try {
            // Requête SQL pour insérer les données
            $stmt = $db->prepare("INSERT INTO stagiaires (matStagiaire, nomStagiaire, prenomStagiaire, filiereStagiaire, anneeEtude, typeBac, anneeBac)
                                  VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$matStagiaire, $nomStagiaire, $prenomStagiaire, $filiereStagiaire, $anneeEtude, $typeBac, $anneeBac]);
            echo "Stagiaire ajouté avec succès !";
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
        }
    } else {
        echo "Veuillez remplir correctement tous les champs.";
    }
}
