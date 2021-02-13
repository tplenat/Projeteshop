

<?php include_once '_debut.inc.php'; ?>

 TOUS LES PRODUITS D'UNE CATEGORIE
        

<div class="container-fluid">
    <div class="row ">
        <div class="col-lg-3">
            <form method="POST" name="form">
                <select  name="prod1cat">
                    <?php
                    $cats = Categorie::fetchAll();
                    foreach ($cats as $cat):
                        ?>
                        <option value="<?php echo $cat->getIdCategorie(); ?>"><?php echo $cat->getLibelle(); ?></option>
                    <?php endforeach; ?>
                </select>
                <br>
                <input type="submit" class="btn btn-success" value="Afficher les prods Categorie" name="submitbtn2name" />
            </form>
            
            
            
        </div>
        <div class="col-lg-9">
            <div class="row">
                <?php if (isset($_POST["prod1cat"])) { 
                $prod = Produit::fetchAllByCategorie(Categorie::fetch($_POST["prod1cat"]));
                foreach ($prod as $unProduit):
                    ?>
                <div class="col-lg-4 col-md-6 p-3 bg-dark">
                    <div class="card shadow-lg">
                        <img class="card-img-top w-50 m-5 mx-auto" src="<?php echo $unProduit->getImage(); ?>" >
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $unProduit->getLibelle(); ?></h5>
                            <p class="card-text"><?php echo $unProduit->getDescription(); ?></p>
                            <p class="card-text"><?php echo $unProduit->getPrix(); ?></p>
                            <a href="#" class="btn btn-primary">Go somewhere</a>
                        </div>
                    </div>
                </div>
                
                      <?php endforeach; ?>
      

        <?php } ?>  
                
            
            </div>
        </div>
         
        
    </div>

   

</div>

</div> <!-- /container -->

<div class="container">
    <script type="text/javascript">
             function soumis2()
           {document.getElementById('MC').submit();}
    </script>
    TOUTES LES MARQUES D'uNE CATEGORIE
    <div class="row ">
        <div class="col-lg-3">
            <form id="MC" method="POST" name="form">
                <select   name="mar1cat" onchange="soumis2();">
                    <?php
                    $cats = Categorie::fetchAll();
                    foreach ($cats as $cat):
                        ?>
                        <option value="<?php echo $cat->getIdCategorie(); ?>" <?php
                        if (isset($_POST["mar1cat"]) && ($_POST["mar1cat"] == $cat->getIdCategorie())) {
                            echo "selected";
                        }
                        ?>><?php echo $cat->getLibelle(); ?></option>
<?php endforeach; ?>
                </select>
            </form>
 <script type="text/javascript">
             function soumis3()
           {document.getElementById('tttt').submit();}
    </script>
            
            <form id="tttt" method="POST" name="aaaa" onchange="soumis3();">
                <?php
            if (isset($_POST["mar1cat"])) {
                $mar = Marque::fetchAllByCategorie(Categorie::fetch($_POST["mar1cat"]));
                foreach ($mar as $unemarque):
                    
                    ?>

                <input type="checkbox" aria-label="Checkbox for following text input" name="<?php echo $unemarque->getIdMarque(); ?>">
                    :
                    <?php echo $unemarque->getNom(); ?><br>
                <?php endforeach; ?>
            <?php } ?>  
            </form>

        </div>
        <div class="col-lg-9">
            <div class="row">
                <?php
                
                $mar = Marque::fetchAllByCategorie(Categorie::fetch($_POST["aaaa"]));
                foreach ($mar as $unemarque):
                    if (isset($_POST[$unemarque->getNom()]))
                        echo "Vous avez demandé des frites en accompagnement.\n";
                endforeach;
               
                ?> 
                <div class="col-lg-4 col-md-6 p-3">  </div>
                   
                
            </div>
        </div>
    </div>

</div>

<?php include_once '_fin.inc.php'; ?>
