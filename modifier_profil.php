<?php
session_start();
$login = $_SESSION['user_infos']['login'];
$prenom = $_SESSION['user_infos']['prenom'];
$nom = $_SESSION['user_infos']['nom'];

// var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Profil</title>
    <link rel="stylesheet" href="modifier_profil.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.13.0/css/all.css">
    <link href="index_modprofil.php">    
</head>
<body>
    <form method="POST" action="index_modprofil.php">
        <h1>Modifier Profil</h1>
        
           <div class="textbox">
            <p><i class="fa-brands fa-google"></i></p>
            <p><i class="fa-brands fa-facebook"></i></p>
            <p><i class="fa-brands fa-twitter"></i></p>
            <p><i class="fa-brands fa-youtube"></i></p>
        </div>
        <p class="mail"> ou utiliser mon login :</p>
        <div class="inputs">

            <input type="new_login" name="new_login" placeholder=" " value= <?= $login ?>>
           
            <input type="new_prenom" name="new_prenom" placeholder=" " value=<?= $prenom ?>>


            <input type="new_nom" name="new_nom" placeholder=" "  value=<?= $nom ?>>

            
            <input type="new_password" name="new_password" placeholder="new_password">
            <input type="passwordconfir" name="passwordconfir" placeholder="passwordconfir">
        </div>
        <div class="remember">
            <button class="btn">Modifier</button>
        </div>
    </form>
