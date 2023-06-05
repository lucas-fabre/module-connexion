<?php

session_start();

$con = new PDO('mysql:host=localhost;dbname=moduleconnexion', 'root', '');

if(isset($_POST['connexion'])) 
{
    if (!empty($_POST['email']) && !empty($_POST['motdepasse']))
    {
      $email = $_POST['email'];
      $mdp = $_POST['motdepasse'];

        if($email !== "" && $mdp !== "") 
        {
            $sql = "SELECT * FROM utilisateurs WHERE login = '$email' AND password = '$mdp' ";
            $statement = $con->prepare($sql);
            $statement->execute();
            $result = $statement->fetchAll();
            if(empty($result)) // Si la recherche dans la BDD renvoie aucune valeur, alors:
            {
                echo('Utilisateur ou MDP incorrect !'); 
            }
            else 
            {
                foreach(array_column($result, 'login') as $emailresult) //Vérification de la présence du login dans la colonne login de la BDD.
                {   
                    foreach(array_column($result, 'password') as $mdpresult) ////Vérification de la présence du password dans la colonne password de la BDD.
                    {
                        if($emailresult == $email && $mdpresult == $mdp) // Si les deux valeurs 'login' et 'password' correspondent entre la BDD 
                                                                         // et les données rentrées dans le form, alors:
                        {
                            //echo("Utilisateur existe");
                            $_SESSION['username'] = $email; // Créé une nouvelle session avec les identifiants valides.
                            header('Location: index.php'); // Redirige vers la page d'accueil.
                        }
                    }
                }
            }    
        }      
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="..//css/Connexion.css">
</head>
<body>
    <div class="center">
        <h1>Ravi de te revoir!</h1>
        <form action="<?php echo($_SERVER['REQUEST_URI']); ?>" method="post">
                <div class="inputbox">
                    <input type="text" required="required" name="email" id="login" value="" />
                    <span>Email</span>
                </div>

                <div class="inputbox">
                    <input type="password" required="required" name="motdepasse" id="password" value="" />
                    <span>Mot de passe</span>
                </div>

                <div class="inputbox">
                    <input type="submit" value="Connexion" id="btn" name= "connexion">
                </div>
        </form>
    </div>
</body>
</html>