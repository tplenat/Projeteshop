<?php include_once '_debut.inc.php'; ?>

<div class="container">
    <div class="row ">
        <div class="col-lg-3 col-md-4">
            <?php include_once '_menu.gauche.inc.php'; ?>
        </div>
        <div class="col-lg-9 col-md-8">
            <div class='row'>
                <?php
                if (isset($_POST['submit2'])) {
                    if (isset($_POST["choix"]) && isset($_POST["choixMar"])) {
                        ?>

                        <?php
                        $prod = Produit::fetchAllByCategorieAndMarque(Categorie::fetch($_POST["choix"]), Marque::fetch($_POST["choixMar"]));
                        foreach ($prod as $unProduit):
                            ?>
                            <div class='col-12 col-lg-4 col-md-6 p-3'>
                                <div class="card shadow-lg">
                                    <img class="card-img-top py-2 embed-responsive-1by1 w-50" src="../<?php echo $unProduit->getImage(); ?>" alt="">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $unProduit->getLibelle(); ?></h5>
                                        <p class="card-text"><?php echo $unProduit->getDescription(); ?></p>
                                        <p class="card-text"><?php echo $unProduit->getPrix(); ?></p>
                                        <a href="#" class="btn btn-primary">ajouter</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
    <?php }
} ?>  
             
            </div>
        </div>
    </div>
    <hr>


</div> <!-- /container -->

<?php include_once '_fin.inc.php'; ?>
