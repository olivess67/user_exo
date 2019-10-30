<?php
require_once '../Modele/connect.php';
// $stmt = $bdd->prepare('SELECT * FROM users');
// $stmt->execute();
// $result = $stmt->fetch();
// var_dump($result);
// while($result=$stmtfectch()){
//     var_dump($ressult);
// }
//  $_->fetch();
// $stmt=$bdd->prepare("SELECT email FROM users WHERE email=:mail");
// $stmt->bindParam("mail",$_POST["u_email"]);
// $stmt->execute();
// $result=$stmt->fetch();
// var_dump($result); 
// if($result==false){
//     $stmt = $bdd->prepare("INSERT INTO users (email, password, daten, nom, prenom) VALUES (?,?,?,?,?)");
//     $stmt->execute(array($_POST["u_email"],$_POST["u_password"],$_POST["u_daten"],$_POST["u_nom"],$_POST["u_prenom"]));
// }else{
//     echo"t'existe déjà".$_POST["u_email"];
// }
// $stmt = $bdd->prepare("INSERT INTO users (email, password, daten, nom, prenom) VALUES (?,?,?,?,?)");
// $stmt->execute(array($_POST["u_email"],$_POST["u_password"],$_POST["u_daten"],$_POST["u_nom"],$_POST["u_prenom"]));

// redirection:
//
//gestion d'erreur des mot de passe
$stmt=$bdd->prepare("SELECT email FROM users WHERE email=:mail");
$stmt->bindParam("mail",$_POST["u_email"]);
$stmt->execute();
$result=$stmt->fetch();
var_dump($result); 

//gestion d'erreur champ vide
if (!empty($_POST['u_email']) && !empty($_POST['u_password']) && !empty($_POST['u_confirm_password']) && !empty($_POST['u_nom']) && !empty($_POST['u_prenom'])) {
    if ($_POST['u_password'] == $_POST['u_confirm_password']) {
        if ($result == false) {$hashed_password=password_hash($_POST['u_password'],PASSWORD_DEFAULT);
            $stmt = $bdd->prepare("INSERT INTO users (email, password, daten, nom, prenom) VALUES (?,?,?,?,?)");
            $stmt->execute(array($_POST['u_email'], $hashed_password, $_POST['u_daten'], $_POST['u_nom'], $_POST['u_prenom']));
            header('Location:http://localhost/user_exo/vue/connection.html');
            die();
        } else {
            header('Location:http://localhost/user_exo/vue/inscription.html');
            die();
        }
    } else {
        header('Location:http://localhost/user_exo/vue/inscription.html');
        die();
    }
 } else {
    header('Location:http://localhost/user_exo/vue/inscription.html');
    die();
 }