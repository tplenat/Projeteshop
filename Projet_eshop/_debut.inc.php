<?php
session_start();
include_once 'bootstrap.inc.php';
/**

if (isset($_REQUEST["logout"])){
session_unset();
}
if (isset($_REQUEST["login"]) && isset($_REQUEST["password"])) {
$resultat = verification($_REQUEST["login"], $_REQUEST["password"]);
if ($resultat == true) {
$_SESSION["login"] = $_REQUEST["login"];
$_SESSION["password"] = $_REQUEST["password"];
}
}
if (!preg_match('/\index.php$/i', $_SERVER['REQUEST_URI'])) {
if (!(isset($_SESSION["login"]) && isset($_SESSION["password"])))
header("Location: index.php");
}
*/
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

        <title>Projet eshop</title>
        
        <!--- Bootstrap Popper js / Pour les bouton couleur et background--->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
        <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- Bootstrap icons CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!--  CSS perso -->
    <link rel="stylesheet" href="style.css">

    </head>

    <body>
        <header class="header container-fluid  bg-dark text-center shadow-lg">

        <div class="row">
            <h1>Projet Eshop</h1>
        </div>
        <!-- dropdown list d'images de background-->
        <div class="row" style="float: right">
            <div class="dropdown" style="display: inline-block;">
                <div class="btn-group">
                    <button id="bckgd" class="btn btn-lg btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: aliceblue;background-color: #484848">
                        Background
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="bckgd">
                     
                        <li>
                            <img src="img/bg1.jpg" class="w-100  px-1">
                        </li>
                        <li>
                            <img src="img/bg2.jpg" class="w-100 my-1 px-1">
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- dropdown list d'images de background FIN-->
    </header>
        <br>
        <br>
        

        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">Projet Eshop</a>
                   
                     <a class="navbar-brand" href="">Produits</a>
                    <a class="navbar-brand" href="">Categorie</a>
                    <a class="navbar-brand" href="">Marque</a>
                    
                 
                </div>
               
            </div>
            <div class="container">
           
             <form method="POST" onsubmit="alert('form submitted');" name="form1name">
            <select  name="categ">
                <?php
                $cats = Categorie::fetchAll();
                foreach ($cats as $cat):
                    ?>
                    <option value="<?php echo $cat->getIdCategorie(); ?>" selected="selected"><?php echo $cat->getLibelle(); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" class="btn btn-success" value="Valider Categorie" name="submitbtn1name" />
        </form>
               
            </div>
            
        </nav>
        
        

 



