<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['username'])) {
    header("Location: index.html");
}

// Vérifier si le formulaire de connexion a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérifier que le nom d'utilisateur et le mot de passe ont été saisis
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        // Vérifier les informations d'identification de l'utilisateur
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Connexion à la base de données et requête pour vérifier si l'utilisateur existe
        $dsn = 'mysql:host=localhost;dbname=barwisewine';
        $user = 'root';
        $pass = '';
        $pdo = new PDO($dsn, $user, $pass);

        $stmt = $pdo->prepare("SELECT * FROM bw_users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        // Vérifier si le nom d'utilisateur et le mot de passe sont corrects
        if ($user && password_verify($password, $user['password'])) {
            // Vérifier le rôle de l'utilisateur
            if ($user['role'] === 'admin') {
                // Créer une session pour l'administrateur
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = 'admin';

                // Rediriger l'administrateur vers le dashboard
                header("Location: dashboard.php");
                exit;
            } else {
                // Créer une session pour le simple utilisateur
                $_SESSION['username'] = $username;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = 'user';

                // Rediriger le simple utilisateur vers la page de bienvenue
                header("Location: index.html");
                exit;
            }
        } else {
            // Afficher un message d'erreur si les informations d'identification sont incorrectes
            $error = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        // Afficher un message d'erreur si le nom d'utilisateur ou le mot de passe sont vides
        $error = "Veuillez saisir votre nom d'utilisateur et votre mot de passe.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>

    <?php if (isset($error)) : ?>
        <p><?php echo $error; ?></p>
    <?php endif; ?>

    <form method="POST">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username"><br>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password"><br>

        <input type="submit" value="Se connecter">
    </form>
</body>
</html>
