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
        <script type="text/javascript">
               function soumis()
             {document.getElementById('tt').submit();}
        </script>

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

                <form method="POST" name="form1name">
                    <select  name="categ">
                        <?php
                        $cats = Categorie::fetchAll();
                        foreach ($cats as $cat):
                            ?>
                            <option value="<?php echo $cat->getIdCategorie(); ?>"><?php echo $cat->getLibelle(); ?></option>
                        <?php endforeach; ?>
                    </select>
                    <input type="submit" class="btn btn-success" value="Voir cette catégorie" name="submitbtn1name" />
                </form>


                <table border="1" width="80%" align="center">
                    <?php
                    if (isset($_POST["categ"])) {
                        $cat = Categorie::fetch($_POST["categ"]);
                    }
                   
                    ?>
                    <tr>
                        <th> idCat</th>
                        <th>Libelle Cat </th>
                        <th>image cat</th>
                    </tr>
                    <tr>
                        <td>
                            <?php echo $cat->getIdCategorie(); ?>
                        </td>
                        <td>
                            <?php echo $cat->getLibelle(); ?>
                        </td>
                        <td>
                            <?php echo $cat->getImage(); ?>
                        </td>

                    </tr>

                </table>

                <hr>
                
                 <hr>
        <!-- tableaux toutes categories-->
        <br>Toutes les catégories
        <table border="1" width="80%" align="center">
            <?php
            $cats = Categorie::fetchAll();
            foreach ($cats as $cat):
                ?>
                <tr><td><?php echo $cat->getIdCategorie(); ?></td>
                    <td><?php echo $cat->getLibelle(); ?></td>
                    <td><?php echo $cat->getImage(); ?></td></tr>
            <?php endforeach; ?>
        </table>
        <!-- tableaux toutes categories-->

        <hr><hr>
     <hr>
        TOUS LES PRODUITS D'UNE CATEGORIE
        <form method="POST" name="form">
            <select  name="prod1cat">
                <?php
                $cats = Categorie::fetchAll();
                foreach ($cats as $cat):
                    ?>
                    <option value="<?php echo $cat->getIdCategorie(); ?>"><?php echo $cat->getLibelle(); ?></option>
                <?php endforeach; ?>
            </select>
            <input type="submit" class="btn btn-success" value="Afficher les prods Categorie" name="submitbtn2name" />
        </form>
        <?php if (isset($_POST["prod1cat"])) { ?>

            <table border="1" width="80%" align="center">

                <?php
                $prod = Produit::fetchAllByCategorie(Categorie::fetch($_POST["prod1cat"]));
                foreach ($prod as $unProduit):
                    ?>

                    <tr><td><?php echo $unProduit->getIdProduit(); ?></td>
                        <td><?php echo $unProduit->getLibelle(); ?></td>
                        <td><?php echo $unProduit->getDescription(); ?></td>
                        <td><?php echo $unProduit->getPrix(); ?></td>
                        <td><img src="<?php echo $unProduit->getImage(); ?>" class="w-25  px-1"></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php } ?>  
       
        
        
            </div>
            
            <div class="row bg-dark" style="height: 20">
                sdfsdsdf
            </div>
            <div class="container">
            <div class="row">
      
            
        TOUS LES PRODUITS D'UNE MARQUe
        <form id="tt" method="POST" name="form">
            <select   name="prod1mar" onchange="soumis();">
                <?php
                $marques = Marque::fetchAll();
           
                foreach ($marques as $marque):
                    ?>
                <option value="<?php echo $marque->getIdMarque(); ?>" <?php if (isset($_POST["prod1mar"]) && ($_POST["prod1mar"]==$marque->getIdMarque())){echo "selected";}?>><?php echo $marque->getNom(); ?></option>
                <?php endforeach; ?>
            </select>
            
        </form>
        <?php if (isset($_POST["prod1mar"])) { ?>

            <table border="1" width="80%" align="center">

                <?php
                $prod = Produit::fetchAllByMarque(Marque::fetch($_POST["prod1mar"]));
                foreach ($prod as $unProduit):
                    ?>

                    <tr><td><?php echo $unProduit->getIdProduit(); ?></td>
                        <td><?php echo $unProduit->getLibelle(); ?></td>
                        <td><?php echo $unProduit->getDescription(); ?></td>
                        <td><?php echo $unProduit->getPrix(); ?></td>
                        <td><?php echo $unProduit->getMarque()->getNom(); ?></td>
                        <td><?php echo $unProduit->getCategorie()->getLibelle(); ?></td>
                        
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php } ?>  
         </div>
                
                <hr>
                <hr>
                
                </div>

        </nav>
        






