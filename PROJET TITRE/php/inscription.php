<!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Site bootstrap via CDN">
        <!--Le fichier CSS de Bootstrap doit être inclut avant les autres fichiers css-->
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="styles.css">
        <title>Système d'inscription et de connexion en PHP</title>
    </head>
    <body>

        <div class="container">
            <a href="index.php"><button class="btn btn-primary btn-lg returnlink">RETOUR A LA CONNEXION</button></a>

                <h2>CRÉATION D'UN NOUVEL UTILISATEUR :</h2>
                <form class="registering" action="scriptinscription.php" method="POST">
                    <input type="text" name="username" placeholder="Pseudo">
                    <input type="email" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Mot de passe">
                    <p class="indicator"><i>(8 caractères minimum avec au moins une lettre en majuscule et minuscule, un chiffre et un caractère spécial)</i></p>
                    <input type="password" name="confirm_password" placeholder="Confirmer mot de passe">
                    <input type="submit" name="loginregister" value="Valider l'inscription">
                </form>
        </div>




        <!--Le fichier JS doit toujours être inclut avant la fermeture de la balise <body>-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>