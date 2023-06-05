<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Connexion</title>
    <link rel="stylesheet" href="connexion.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
</head>
<body>
    <form method="POST" action="index.php">
        <h1>Se Connecter</h1>
        <div class="textbox">
            <p><i class="fa-brands fa-google"></i></p>
            <p><i class="fa-brands fa-facebook"></i></p>
            <p><i class="fa-brands fa-twitter"></i></p>
            <p><i class="fa-brands fa-youtube"></i></p>
        </div>
        <p class="mail"> ou utiliser mon login :</p>
        <div class="inputs">
        <input type="text" name="login" placeholder="Login">
        <input type="password" name="password" placeholder="password">


        </div>
        <div class="remember">
            <button class="btn">Se connecter</button>
            <button class="btn"><a href="inscription.php">s'inscrire</a></button>
        </div>
    </form>
</body>