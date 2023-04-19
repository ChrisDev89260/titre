<!-- reste a faire verification si existance du pseudo  dans la bdd
              message d'erreur qui reste 10 seconde puis retour a la page d'enregistrement -->


              <?php
//Traitement de l'inscription
if(isset($_POST['loginregister'])){
    // Récupération des données
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation des données
    if(empty($username) || empty($email) || empty($password) || empty($confirm_password)){
        echo "Tous les champs sont obligatoires";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "L'email n'est pas valide";
    } elseif (strlen($password) < 8) {
        echo "Le mot de passe doit contenir au moins 8 caractères";
    } elseif (!preg_match('/[A-Z]/', $password) || !preg_match('/[a-z]/', $password) || !preg_match('/[0-9]/', $password) || !preg_match('/[^A-Za-z0-9\s]/', $password)) {
        echo "Le mot de passe doit contenir au moins une lettre majuscule, une minuscule, un chiffre et un caractère spécial";
    } elseif ($password != $confirm_password) {
        echo "Le mot de passe et la confirmation ne correspondent pas";
    //  elseif (file_exists($email))
    } else {
        // Hachage du mot de passe
        $password = password_hash($password, PASSWORD_DEFAULT);
// test code verification email
    try{
    // connexion avec PDO
    $pdo = new PDO("mysql:host=localhost;dbname=login", "root", "");
    // recherche si l'email saisi dans le fomulaire est déja utilisé
    // upper transforme toute les minuscule en majuscule
        $sql = "SELECT * FROM users WHERE upper(email) = upper('". $email. "')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        //récupere les données sous forme de tableau associatif
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
			// Si le nombre de résultats est supérieur à 0, on affiche les données
			if (count($result) > 0) {
        //si on a un resultat superieur a 0 l'email est deja présent en bdd
                echo "l'email est déja utilisé !";
            } else {
                // si il ne touve pas de correspondance => enregistrement des données en base de données
                $query = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
                $stmt = $pdo->prepare($query);
                $stmt->execute(
                    array(
                        ':username' => $username,
                        ':email' => $email,
                        ':password' => $password
                    )
                );
                echo "Inscription réussie!";
                echo ("<button onclick=\"location.href='index.php'\"> => Page de connexion </button>");
            }
        } catch(PDOException $e){
            echo "Erreur : " . $e->getMessage();
        }
    }
}

    ?>
