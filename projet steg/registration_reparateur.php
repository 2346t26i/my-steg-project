<?php
// connexion avec le serveur (APACHE)
$user = "root";
$password = "";
$hostname = "localhost";
// enable error reporting
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// connection string with database
$dbhandle = mysqli_connect($hostname, $user, $password);
// connect with database
$selected = mysqli_select_db($dbhandle, "appsteg");
// Vérifier si le formulaire est soumis
if (isset($_POST['submit'])) {
    $nomR= $_POST['nomR'];
    $prenomR = $_POST['prenomR'];
    $emailR = $_POST['emailR'];
    $idR = $_POST['idR'];
    $passwordR = $_POST['passwordR'];
    
    // utiliser des requêtes préparées pour empêcher les injections SQL

    $stmt = $dbhandle->prepare("INSERT INTO `reparateur` (nomR, prenomR, emailR, idR, passwordR) VALUES (?, ?, ?, ?, ?)");
    
    // Use "ssss" to indicate four string parameters
    $stmt->bind_param("sssis", $nomR, $prenomR, $emailR,$idR, $passwordR);
    if ($stmt->execute()) {
        echo "Registration successful!";
        // Redirect to another page
        header("Location: espace-reparateur.html");
        exit; // Make sure to exit after redirection
    } else {
        echo "Registration failed!";
    }
    
}

mysqli_close($dbhandle); // fermer la connexion
?>