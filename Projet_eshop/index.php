
    
 <?php include_once '_debut.inc.php'; ?>

<div class="container">
    <div class="row ">
        
         <?php
        
           $collectionDeProduits = Produit::fetchAll();
            var_dump($collectionDeProduits);
            ?>
    </div>
    <hr>

   
</div> <!-- /container -->

<?php include_once '_fin.inc.php'; ?>
