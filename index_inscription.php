<?php
//demarer la session
session_start();

//declarer les variables
$caractere_min = "azertyuiopqsdfghjklmwxcvbnAZERTYUIOPQSDFGHJKLMWXCVBN1234567890";
$caractere_maj = "AZERTYUIOPQSDFGHJKLMWXCVBN";
$chiffre = "1234567890";
$caracteres_speciaux = "!@#$%^&*()_-=+;:,.?";
$longueur_mdp = 8;
$i=0;
$min = 0;
$maj = 0;
$chif = 0;
$spe = 0;
//verifier si le formulaire est soumis
if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs des champs du formulaire
    $login = $_POST["login"];
    $prenom = $_POST["prenom"];
    $nom = $_POST["nom"];
    $password = $_POST["password"];
    $passwordconfir = $_POST["passwordconfir"];

    // Connexion à la base de données
    $servername = 'localhost';
    $username = 'root';
    $password_db = 'root';
    $dbname = 'moduleconnexion';
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    
    //verifier si le mot de passe respecte les conditions
    // Vérifier la longueur du mot de passe
    if (strlen($password) >= 8) {
    
   
    // Vérifier les conditions de validité
        for ($i = 0; $i < strlen($password); $i++) {
            $char = $password[$i];
            
           
            if (strpos($caractere_min, $char) !== false) {
                $min++;
            }
            if (strpos($caractere_maj, $char) !== false) {
                $maj++;
            }
            if (strpos($caracteres_speciaux, $char) !== false) {
                $spe++;
            }
            
           
            if (strpos($chiffre, $char) !== false) {
                $chif++;
            }
        }
    
        
            
    
    
        // Vérifier si le mot de passe satisfait toutes les conditions
        if ($min >= 1 && $maj >= 1 && $spe >= 1 && $chif >= 1) {
            if ($password == $passwordconfir && $password != $_SESSION['user_infos']['login']&& $login != $_SERVER['user_infos']['login']) {
                 //ajouter l'utilisateur dans la base de donnée
                $sql = "INSERT INTO utilisateurs (login, prenom, nom, password) VALUES (:login, :prenom, :nom, :password)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':login', $login, PDO::PARAM_STR);
                $stmt->bindParam(':prenom', $prenom, PDO::PARAM_STR);
                $stmt->bindParam(':nom', $nom, PDO::PARAM_STR);
                $stmt->bindParam(':password', $password, PDO::PARAM_STR);
                $stmt->execute();
                //rediriger vers la page de connexion
                header("location: connexion.php");
                exit();
            }
            else {
                echo "Les mots de passe ne sont pas identiques.";
                header("location: inscription.php");
            }
            
        } 
            
        else {
            echo "Le mot de passe doit contenir au moins une minuscule, une majuscule, un caractère spécial et un chiffre.";
            header("location: inscription.php");
        }
    }
    else {
        
       
        echo "Le mot de passe doit contenir au moins 8 caractères.";
        header("location: inscription.php");
    }
    
    
    
}
?>