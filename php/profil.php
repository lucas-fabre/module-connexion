<?php
session_start();

if($_SESSION['username'] !== ""){
    $user = $_SESSION['username'];
    echo "Bonjour $user, vous êtes connecté";
}

$con = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');

if(isset($_POST['Modifier'])) {
    if (!empty($_POST['prenom']) && !empty($_POST['nom']) && !empty($_POST['motdepasse']))
    {
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $mdp = $_POST['motdepasse'];

        $sql = "SELECT * FROM utilisateurs WHERE login = '$user' ";
        $statement = $con->prepare($sql);
        $statement->execute();
        $result = $statement->fetchAll();
        
        if(empty($result)) // Si la recherche dans la BDD ne renvoie aucune valeur, alors:
        {
            echo('Ca marche pas !');
        }
        else
        {
            $sql2 = "UPDATE utilisateurs SET  prenom = '$prenom', nom = '$nom', password = '$mdp' WHERE login = '$user'";
            $update = $con->prepare($sql2);
            $resultup = $update->execute();
            if($resultup)
            {
                echo("Modifications bien prisent en compte");
            }
            else
            {
                echo("Modifications pas prisent en compte");
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="..//css/Profil.css">
</head>
<body>
    <div class="center">
        <h1><?php echo("$user")?> ,tu veux changer tes infos ? <br> Dis nous les quelles !</h1>
        <form action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="post">
            <div class="inputbox">
                <input type="text" required="required" name = "prenom">
                <span>Prenom</span>
            </div>

            <div class="inputbox">
                <input type="text" required="required" name = "nom">
                <span>Nom</span>
            </div>
            
            <div class="inputbox">
                <input type="text" required="required" name = "motdepasse">
                <span>Password</span>
            </div>
            
            <div class="inputbox">
                <input type="submit" value="Modifier" name = "Modifier">
            </div>
        </form>
    </div>
</body>
</html>