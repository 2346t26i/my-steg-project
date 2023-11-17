<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "appsteg";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Définissez les options PDO ici si nécessaire
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['envoyer'])) {
        $idpanne = $_POST['idpanne'];
        $nature_panne = $_POST['nature_panne'];
        $date_panne = $_POST['date_panne'];
        $num_serie = $_POST['num_serie'];
        $type_materiel = $_POST['type_materiel'];
        $modele = $_POST['modele'];
        $description_probleme= $_POST['description_probleme'];

        $sql = "INSERT INTO reclamations (idpanne, nature_panne, date_panne, num_serie, type_materiel, modele,description_probleme) 
                VALUES (:idpanne, :nature_panne, :date_panne, :num_serie, :type_materiel, :modele, :description_probleme)";

        // Préparation de la commande SQL
        $stmt = $conn->prepare($sql);

        // Liaison des valeurs avec les paramètres de la commande SQL
        $stmt->bindParam(':idpanne', $idpanne);
        $stmt->bindParam(':nature_panne', $nature_panne);
        $stmt->bindParam(':date_panne', $date_panne);
        $stmt->bindParam(':num_serie', $num_serie);
        $stmt->bindParam(':type_materiel', $type_materiel);
        $stmt->bindParam(':modele', $modele);
        $stmt->bindParam(':description_probleme', $description_probleme);

        // Exécution de la commande SQL
        try {
            $stmt->execute();
            echo "Enregistrement réussi.";
             // Ajout du lien vers la page d'accueil
    echo "<br><a href='index.html'>OK</a>";
        } catch (PDOException $e) {
            echo "Erreur lors de l'enregistrement : " . $e->getMessage();
        }
    }
} catch (PDOException $e) {
    echo "La connexion à la base de données a échoué : " . $e->getMessage();
}
?>