<?php
// Connexion à la base de données
try {
    $db = new PDO('mysql:host=localhost;dbname=ista', 'root', '');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Vérifier si la filière et l'année sont définies
if (isset($_GET['filiere']) && isset($_GET['annee'])) {
    $filiere = htmlspecialchars($_GET['filiere']);
    $annee = htmlspecialchars($_GET['annee']);

    // Préparer la requête pour récupérer les stagiaires selon la filière et l'année
    $stmt = $db->prepare("SELECT * FROM stagiaires WHERE filiereStagiaire = :filiere AND anneeEtude = :annee");
    $stmt->bindParam(':filiere', $filiere);
    $stmt->bindParam(':annee', $annee);
    $stmt->execute();

    // Vérifier si des stagiaires ont été trouvés
    if ($stmt->rowCount() > 0) {
        echo "<h2>Liste des Stagiaires</h2>";
        echo "<table>";
        echo "<thead>";
        echo "<tr><th>Matricule</th><th>Nom</th><th>Prénom</th><th>Filière</th><th>Année d'Étude</th></tr>";
        echo "</thead>";
        echo "<tbody>";

        // Afficher chaque stagiaire
        while ($stagiaire = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($stagiaire['matStagiaire']) . "</td>";
            echo "<td>" . htmlspecialchars($stagiaire['nomStagiaire']) . "</td>";
            echo "<td>" . htmlspecialchars($stagiaire['prenomStagiaire']) . "</td>";
            echo "<td>" . htmlspecialchars($stagiaire['filiereStagiaire']) . "</td>";
            echo "<td>" . htmlspecialchars($stagiaire['anneeEtude']) . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p class='error'>Aucun stagiaire trouvé pour cette filière et cette année.</p>";
    }
} else {
    echo "<p class='error'>Veuillez sélectionner une filière et une année.</p>";
}
