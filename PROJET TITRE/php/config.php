<?php
$host = 'localhost'; // Adresse du serveur MySQL
$dbname = 'vineyard_bbarwise'; // Nom de la base de données
$user = 'root'; // Nom d'utilisateur MySQL
$password = ''; // Mot de passe MySQL

// Connexion à la base de données MySQL
try {
    $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $password);
    // Affichage des erreurs PDO
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher l'erreur
    die('Erreur de connexion : ' . $e->getMessage());
}
?>
