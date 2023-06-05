<?php
session_start();

if($_SESSION['username'] !== "")
{
    $user = $_SESSION['username'];
    echo "Bonjour $user, vous êtes connecté";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil</title>
    <link rel="stylesheet" type="text/css" href="..//css/Index.css">
</head>
<body>
    <header>
        <img src= "..//images/Logo.png">
        
    </header>
</body>
</html>