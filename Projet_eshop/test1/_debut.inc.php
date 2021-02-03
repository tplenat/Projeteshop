<?php
session_start();
include_once '_gestionBase.inc.php';

if (isset($_REQUEST["logout"])){
session_unset();
}
if (isset($_REQUEST["login"]) && isset($_REQUEST["password"])) {
$resultat = verification($_REQUEST["login"], $_REQUEST["password"]);
if ($resultat == true) {
$_SESSION["login"] = $_REQUEST["password"];
$_SESSION["mdp"] = $_REQUEST["password"];
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

        <nav class="navbar navbar-inverse navbar-fixed-top bg-dark" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Projet Eshop</a>
                   
                    <a class="navbar-brand" href="">Categorie</a>
                    <a class="navbar-brand" href="">marque</a>
                   
                </div>
                <div id="navbar" class="navbar-collapse collapse">
                    <?php if (!isset($_SESSION["user"])): ?>
                        <form  method="post" class="navbar-form navbar-right" role="form" 
                               action="index.php">

                            <div class="form-group">
                                
                                    <input name="user" type="text" placeholder="Email" class="form-control">
                                
                            </div>
                            <div class="form-group">
                                <input name="mdp" type="password" placeholder="Password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success">S'authentifier</button>

                        </form>

<?php else: ?>
                    

<!-- Section à inclure dans le TD Authentification -->

                       <div class="row">
                            <div class="col-md-2 col-lg-offset-1">
                                <p class="white">
                                    <span class="glyphicon glyphicon-user navbar-brand" aria-hidden="true"></span> 
                                    <span class="text-center navbar-brand"><?php echo $_SESSION["user"]; ?></span>
                                </p>
                            </div>
                            <div class="col-md-2 white">
                                <a href="<?php echo $_SERVER["PHP_SELF"]; ?>?logout" class="white">
                                    <span class="glyphicon glyphicon-log-out navbar-brand" aria-hidden="true" title="log-out">
                                    </span>    
                                </a>
                            </div>
                        </div>
<?php endif; ?>
                  
                </div><!--/.navbar-collapse -->
            </div>
        </nav>

   



