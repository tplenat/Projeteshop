<!doctype html>
<html lang="en">

<head>
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
    <header class="header container-fluid bg-dark text-center shadow-lg">

        <div class="row">
            <h1 >Projet Eshop</h1>
        </div>
        <div class="row">
            <nav class="navbar navbar-expand-lg navbar-dark bg-dark">

  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

    
      <div class="dropdown" style="display: inline-block;">
                <div class="btn-group">
                    <button id="bckgd" class="btn btn-lg btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: aliceblue;background-color: #484848">
                        Categorie
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="bckgd">
                     
                        <li>
                            <img src="img/bg1.jpg" class="w-100  px-1" >
                        </li>
                        <li>
                            <img src="img/bg2.jpg" class="w-100 my-1 px-1">
                        </li>
                       
                      
                    </ul>
                </div>
            </div>
                
                 <div class="dropdown" style="display: inline-block;">
                <div class="btn-group">
                    <button id="bckgd" class="btn btn-lg btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: aliceblue;background-color: #484848">
                        Marque
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="bckgd">
                     
                        <li>
                            <img src="img/bg1.jpg" class="w-100  px-1" >
                        </li>
                        <li>
                            <img src="img/bg2.jpg" class="w-100 my-1 px-1">
                        </li>
                       
                      
                    </ul>
                </div>
            </div>
    
            
            
        </div>
    </header>
        
    <!-- DIV d'affichage des alertes'--> 
    <div class="container">
       <div class='row justify-content-md-center' style="height: 45px">
           <div class="col-4 text-center col-md-auto" id="affichagealerte"> </div>
       </div>
   </div>

    
 <!-- Div d'affichage des Todos créés -->
    <div class="container mb-5" id="div0">
        <div class="row" id="div_origin">
        </div>
    </div>
  <!-- Div d'affichage des Todos créés  FIN-->  

<!-- footer -->
    <footer class="container-fluid footer " style="color: #fff;text-align: end">
        <i class="bi bi-terminal" style="font-size: 1.5rem;"></i>
        Thomas Plénat / CDA Guyancourt-2021
    </footer>

</body>




</html>


