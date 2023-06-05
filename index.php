<?php
//demarer la session
session_start();
//verifier si le formulaire est soumis
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs des champs du formulaire
    $login = $_POST["login"];
    $password = $_POST["password"];

    // Connexion à la base de données
    $servername = 'localhost';
    $username = 'root';
    $password_db = 'root';
    $dbname = 'moduleconnexion';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    //verifier si l'utilisateur existe
    $sql = "SELECT * FROM utilisateurs WHERE login = :login AND password = :password";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':login', $login, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    //si le login et egale au login de la base de donnée et le mot de passe et egale au mot de passe de la base de donnée
    if ($login == $row['login'] && $password == $row['password']) {
        //si le login et egale au login de la base de donnée et le mot de passe et egale au mot de passe de la base de donnée
        // $_SESSION['login'] = $login;
        // $_SESSION['password'] = $password;
        // $_SESSION['id'] = $row['id'];
        $_SESSION['user_infos']= $row;
        header("location: profil.php");
        var_dump($_SESSION);
    

    }
    else {
        echo "Votre login ou votre mot de passe est incorrect";
        header("location: connexion.php");
        exit();
    }
  
}

?>