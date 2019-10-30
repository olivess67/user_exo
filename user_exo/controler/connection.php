<?php
require_once '../Modele/connect.php';
session_start();
$stmt = $bdd->prepare("SELECT email FROM users WHERE email=:mail");
$stmt->bindParam("mail", $_POST["u_email"]);
$stmt->execute();
$result = $stmt->fetch();
var_dump($result);
var_dump($_POST);
$stmt = $bdd->prepare('SELECT * FROM users WHERE email= :mail');
$stmt->bindParam("mail", $_POST['u_email']);
$stmt->execute();
$result = $stmt->fetch();
if (!empty($_POST['u_email']) && !empty($_POST['u_password'])) {
    if ($result != false && password_verify($_POST['u_password'], $result["password"])) {
        $_SESSION['user'] = $result;
        header('Location:http://localhost/user_exo/vue/profil.php');
        die();
    } else {
        header('Location:http://localhost/user_exo/vue/connection.html');
        die();
    }
 } else {
    header('Location:http://localhost/user_exo/vue/connection.html');
    die();
 }