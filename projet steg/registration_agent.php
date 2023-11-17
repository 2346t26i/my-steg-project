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
    $nomA= $_POST['nomA'];
    $prenomA = $_POST['prenomA'];
    $emailA = $_POST['emailA'];
    $idA = $_POST['idA'];
    $codeuA = $_POST['codeuA'];
    $passwordA = $_POST['passwordA'];
    
    
    // utiliser des requêtes préparées pour empêcher les injections SQL

    $stmt = $dbhandle->prepare("INSERT INTO `agent` (nomA, prenomA, emailA, idA, codeuA, passwordA) VALUES (?, ?, ?, ?, ? ,?)");
    
    // Use "ssss" to indicate four string parameters
    $stmt->bind_param("sssiss", $nomA, $prenomA, $emailA,$idA,$codeuA, $passwordA);
    if ($stmt->execute()) {
        echo "Registration successful!";
        // Redirect to another page
        header("Location: espace agent.html");
        exit; // Make sure to exit after redirection
    } else {
        echo "Registration failed!";
    }
    
}

mysqli_close($dbhandle); // fermer la connexion
?>