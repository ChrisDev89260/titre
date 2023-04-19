
<?php
session_start();
// Traitement de la connexion
if(isset($_POST['login'])){
    // Récupération des données
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validation des données
    if(empty($email) || empty($password)){
        $_SESSION['error_message'] = "Tous les champs sont obligatoires";
        header("Location: index.php");
    exit;
       
    } else {
        // Vérification des données en base de données
        try{
            $pdo = new PDO("mysql:host=localhost;dbname=login", "root", "");
            $query = "SELECT * FROM users WHERE email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(
            ':email' => $email
            ));
            $user = $stmt->fetch();
                if(!$user){
                    $_SESSION['error_message'] = "L'email n'existe pas";
                    header("Location: index.php");
                } elseif (!password_verify($password, $user['password'])) {
                    $_SESSION['error_message'] = "Le mot de passe est incorrect";
                    header("Location: index.php");
                } else {
                    session_start();
                     $_SESSION['user_id'] = $user['id'];
                     $_SESSION['username'] = $user['username'];
                    header('Location: index.php');
                }
            } catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
            }
            }
            }

            if(isset($_SESSION['user_id'])){
                echo "<h2>Bienvenue " . $_SESSION['username'] . "</h2>";
                echo "<p><form method='get'><input type='submit' name='logout' value='Déconnexion'></form></p>";
            }

    ?>