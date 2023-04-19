<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['username'])) {
    header("Location: index.html");
}

// Vérifier si le formulaire d'inscription a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier que tous les champs ont été saisis
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['email'])) {
        // Récupérer les données du formulaire
        $lastname = $_POST['nom'];
        $firstname = $_POST['prenom'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $email = $_POST['email'];

        // Connexion à la base de données et requête pour insérer un nouvel utilisateur
        $dsn = 'mysql:host=localhost;dbname=barwisewine';
        $user = 'root';
        $pass = '';
        $pdo = new PDO($dsn, $user, $pass);

        $stmt = $pdo->prepare("INSERT INTO bw_users (firstname, lastname, username, user_email, user_password) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$lastname, $firstname, $username, $password, $email]);

        // Rediriger l'utilisateur vers la page de connexion
        header("Location: login.php");
        exit;
    } else {
        // Afficher un message d'erreur si tous les champs ne sont pas remplis
        $error = "Veuillez remplir tous les champs.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <h1>Inscription</h1>

    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="nom">Nom:</label>
        <input type="text" id="nom" name="nom"><br>

        <label for="prenom">Prénom:</label>
        <input type="text" id="prenom" name="prenom"><br>

        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username"><br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password"><br>

        <label for="email">Adresse email:</label>
        <input type="email" id="email" name="email"><br>

        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
