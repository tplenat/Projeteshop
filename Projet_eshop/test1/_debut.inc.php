<?php
session_start();
include_once '_gestionBase.inc.php';
include_once 'bootstrap.inc.php';

if (isset($_REQUEST["logout"])) {
    session_unset();
}
if (isset($_REQUEST["login"]) && isset($_REQUEST["password"])) {
    $resultat = verification($_REQUEST["login"], $_REQUEST["password"]);
    if ($resultat == true) {
        $_SESSION["login"] = $_REQUEST["password"];
        $_SESSION["password"] = $_REQUEST["password"];
    }
}
if (!preg_match('/\index.php$/i', $_SERVER['REQUEST_URI'])) {
    if (!(isset($_SESSION["login"]) && isset($_SESSION["password"])))
        header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="../../favicon.ico">
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!--- Bootstrap Popper js / Pour les bouton couleur et background--->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
        <!-- Bootstrap icons CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
        <!--  CSS perso -->
        <link rel="stylesheet" href="style.css">


        <title>Projet Eshop</title>
    </head>

    <body>

        <header class="header container-fluid  text-center bg-dark shadow-lg">

            <div class="row">
                <h1 >Projet Eshop</h1>
            </div>
                
                <?php if (!isset($_SESSION["login"])): ?>
            
      
                
                <form class="form-inline" method="post" role="form" action="index.php">
    <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-2">
                    
                       
                            <input name="login" type="text" placeholder="Login (test)" class="form-control">
                       </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-2">
                            <input name="password" type="password" placeholder="Password (test)" class="form-control">
                            </div>
                            <div class="form-group col-xs-12 col-sm-6 col-md-4 col-lg-2">
                        <button type="submit" class="btn btn-success">S'authentifier</button>
</div>
                    </div>
            </form>
                

                <?php else: ?>
               
                
                    <div class="col-md-2 col-lg-offset-1">

                        <span>Bienvenue <?php echo $_SESSION["login"]; ?> !</span>

                    </div>
                    <div class="col-md-2">
                        <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?logout">
                            <button class="btn btn-warning"> sortir<i class='bi bi-box-arrow-right px-2'sortir></i></button>  
                        </a>
                    </div>
                
            <?php endif; ?>


        </header>





        <!-- Section à inclure dans le TD Authentification -->









