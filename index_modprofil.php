<?php
//demarer la session
session_start();

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
//verifier si l'utilisateur est connecter
if(!isset($_SESSION['loggedin'])) {
    header("location: connexion.php");
    exit();
}
// Connexion à la base de données
$servername = 'localhost';
$username = 'root';
$password_db = 'root';
$dbname = 'moduleconnexion';
$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password_db);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//recuperer les informations de l'utilisateur depuis la base de données
$sql = "SELECT * FROM utilisateurs WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->
$stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch(PDO::FETCH_ASSOC);

//recuperer les informations de l'utilisateur
if ($row){
    $login = $row['login'];
    $prenom = $row['prenom'];
    $nom = $row['nom'];
    $password = $row['password'];
}
// $login = $row['login'];
// $prenom = $row['prenom'];
// $nom = $row['nom'];
// $password = $row['password'];

//verifier si le formulaire a été soumis

if($_SERVER["REQUEST_METHOD"] == "POST"){
    //recuperer les nouveau valeurs des champs du formulaire
    $new_login = $_POST["new_login"];
    $new_prenom = $_POST["new_prenom"];
    $new_nom = $_POST["new_nom"];
    $new_password = $_POST["new_password"];
    $passwordconfir = $_POST["passwordconfir"];
    //verifier si les champs sont vides
    if(empty($new_login) || empty($new_prenom) || empty($new_nom) || empty($new_password) || empty($passwordconfir)) {
        echo "Veuillez remplir tous les champs";

    }
        //verifier si le mot de passe respecte les conditions
    // Vérifier la longueur du mot de passe
    else{
        if (strlen($new_password) >= 8) {
        
    
            // Vérifier les conditions de validité
                for ($i = 0; $i < strlen($new_password); $i++) {
                    $char = $new_password[$i];
                    
                
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
                    if ($new_password == $passwordconfir) {
                        $sql = "UPDATE utilisateurs SET login = :login, prenom = :prenom, nom = :nom, password = :password WHERE id = :id";
                        $stmt = $conn->prepare($sql);
                        $stmt->bindParam(':login', $new_login, PDO::PARAM_STR);
                        $stmt->bindParam(':prenom', $new_prenom, PDO::PARAM_STR);
                        $stmt->bindParam(':nom', $new_nom, PDO::PARAM_STR);
                        $stmt->bindParam(':password', $new_password, PDO::PARAM_STR);
                        $stmt->bindParam(':id', $_SESSION['id'], PDO::PARAM_STR);
                        $stmt->execute();
                        header("location: profil.php");
                    } else {
                        echo "Veuillez confirmer votre mot de passe"; 

                    }
                
                }
                else {
                    echo "Votre mot de passe doit contenir au moins une minuscule, une majuscule, un chiffre et un caractère spécial";
                    header("location: index_modprofil.php");
                }
        }
    }
  

}   
?>
