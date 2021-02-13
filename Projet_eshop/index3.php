<?php
session_start();
include_once 'bootstrap.inc.php';
?>
 <script type="text/javascript">
               function sub1()
             {document.getElementById('form1').submit();}
        </script>
        
  TOUS LES PRODUITS D'UNE CATEGORIE
        <form id="form1" method="POST" name="form">
            <select  name="prod1cat" onchange="sub1();">
                <?php
                $cats = Categorie::fetchAll();
                foreach ($cats as $cat):
                    ?>
                    <option value="<?php echo $cat->getIdCategorie(); ?>" <?php if (isset($_POST["prod1cat"]) && ($_POST["prod1cat"]==$cat->getIdCategorie())){echo "selected";}?>><?php echo $cat->getLibelle(); ?></option>
                <?php endforeach; ?>
            </select>
            
            
            
             
           
            
            
            
            
            
            <select  name="Mar1cat" >
                <?php
                $marqs = Marque::fetchAllByCategorie(Categorie::fetch($_POST["prod1cat"]));
                foreach ($marqs as $marq):
                    ?>
                <option value="<?php echo $marq->getIdMarque(); ?>" <?php if (isset($_POST["Mar1cat"]) && ($_POST["Mar1cat"]==$marq->getIdMarque())){echo "selected";}?>><?php echo $marq->getNom(); ?></option>
                <?php endforeach; ?>
            </select>
            
            
        </form>
  
  
  
        <?php if (isset($_POST["prod1cat"])&&isset($_POST["Mar1cat"])) { ?>

            <table border="1" width="80%" align="center">

                <?php
                $prod = Produit::fetchAllByCategorieAndMarque(Categorie::fetch($_POST["prod1cat"]), Marque::fetch($_POST["Mar1cat"]));
                foreach ($prod as $unProduit):
                    ?>

                    <tr><td><?php echo $unProduit->getIdProduit(); ?></td>
                        <td><?php echo $unProduit->getLibelle(); ?></td>
                        <td><?php echo $unProduit->getDescription(); ?></td>
                        <td><?php echo $unProduit->getPrix(); ?></td>
                        <td><img src="<?php echo $unProduit->getImage(); ?>" width="100"></td>
                    </tr>
                <?php endforeach; ?>
            </table>

        <?php } ?>  
       

<?php include_once '_fin.inc.php'; ?>
