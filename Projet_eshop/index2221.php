<?php
session_start();
include_once 'bootstrap.inc.php';
?>

<script type="text/javascript">
    function sub1()
    {
        document.getElementById('form1').submit();
    }


    function sub2()
    {
        document.getElementById('form2').submit();
        document.getElementById('form1').submit();
    }
</script>



SELECT : AFFICHE CATEGORIE 
<form id="form1" method="POST" name="form">
    <select  name="choixCat">
        <?php
        $cats = Categorie::fetchAll();
        foreach ($cats as $cat):
            ?>
            <option value="<?php echo $cat->getIdCategorie(); ?>" <?php if (isset($_POST["choixCat"]) && ($_POST["choixCat"] == $cat->getIdCategorie())) {
            echo "selected";
        } ?>><?php echo $cat->getLibelle(); ?></option>
<?php endforeach; ?>
    </select>
<input type="submit" class="btn btn-success" value="Afficher les marques" name="submit1" />
<br>
SELECT AFFICHE MARQUE DE CATEGORIE CHOISIE
<br>
   
        <br>
        <?php
        if (isset($_POST["choixCat"])):
            $marqs = Marque::fetchAllByCategorie(Categorie::fetch($_POST["choixCat"]));
            foreach ($marqs as $marq):
                ?>
        <input type="checkbox" name="<?php echo $marq->getIdMarque(); ?>" /><?php echo $marq->getNom(); ?><br />
          
   <?php endforeach; ?>
           <input type="hidden" name="choix" value="<?php echo $_POST["choixCat"]?> ">
<?php endif; ?>
  

<input type="submit" class="btn btn-success" value="Afficher les prods " name="submit2" />
</form>       


<?php 
$marqs = Marque::fetchAllByCategorie(Categorie::fetch($_POST["choix"]));
if (isset($_POST['submit2'])){
if (isset($_POST["choix"]) && isset($_POST[$marq->getIdMarque()])) { ?>
    <table border="1" width="80%" align="center">
    <?php
    $prod = Produit::fetchAllByCategorieAndMarque(Categorie::fetch($_POST["choix"]), Marque::fetch($_POST[$marq]));
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

<?php }} ?>  


<?php include_once '_fin.inc.php'; ?>
