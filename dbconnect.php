<?php

// Connexion à la base de données (remarquez que la fonction 'new mysqli' crée une connexion MySQL)
$conn = new mysqli("localhost", "root", "", "ista");

// Vérification de la connexion
if ($conn->connect_error) {
    die("Connexion échouée: " . $conn->connect_error);
}

// SQL pour créer la table stagiaires si elle n'existe pas déjà
$sql = "CREATE TABLE IF NOT EXISTS stagiaires (
    matStagiaire INT AUTO_INCREMENT PRIMARY KEY,  -- Matricule de type entier, clé primaire avec auto-incrément
    nomStagiaire VARCHAR(255) NOT NULL,            -- Nom du stagiaire
    prenomStagiaire VARCHAR(255) NOT NULL,         -- Prénom du stagiaire
    filiereStagiaire VARCHAR(255) NOT NULL,        -- Filière du stagiaire
    anneeEtude INT NOT NULL,                      -- Année d'étude du stagiaire
    typeBac VARCHAR(100) NOT NULL,                -- Type de Bac
    anneeBac INT NOT NULL                         -- Année d'obtention du Bac
);";

// Exécution de la requête SQL
if ($conn->query($sql) === TRUE) {
    echo "Table 'stagiaires' créée ou déjà existante.";
} else {
    echo "Erreur de création de la table: " . $conn->error;
}

// Fermeture de la connexion à la base de données
$conn->close();
