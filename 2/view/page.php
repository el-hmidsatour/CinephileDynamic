<?php
include("../Config/database.php");

try {
    // 1. Vérification de la connexion PDO
    echo "<h1>Test d'accès aux données</h1>";
    echo "<p style='color:green'>✓ Connexion DB établie</p>";

    // 2. Test existence table
    $tableExists = $cnx->query("SHOW TABLES LIKE 'film'")->rowCount() > 0;
    if (!$tableExists) {
        die("<p style='color:red'>La table 'film' n'existe pas</p>");
    }
    echo "<p style='color:green'>✓ Table 'film' existe</p>";

    // 3. Requête des films
    $result = $cnx->query("SELECT title FROM film");
    
    // 4. Affichage résultats
    echo "<h2>Contenu de la table film:</h2>";
    $rowCount = $result->rowCount();
    
    if ($rowCount > 0) {
        echo "<p>Nombre de films trouvés : $rowCount</p>";
        echo "<table border='1'>";
        echo "<tr><th>Titre</th></tr>";
        
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>".htmlspecialchars($row['title'])."</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "<p style='color:orange'>Aucun film trouvé dans la table</p>";
    }

} catch (PDOException $e) {
    die("<p style='color:red'>Erreur PDO : " . $e->getMessage()."</p>");
}

// PDO n'a pas de méthode close(), on met la connexion à null
$cnx = null;
?>