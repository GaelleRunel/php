<!-- Le fichier header.php est inclus dans la page -->
<?php 
$currentPageTitle = 'Nos pizzas';

require_once(__DIR__.'/partials/header.php'); 
            
//récuperer la liste des pizzas
$query = $db->query('SELECT * FROM pizza');
$pizzas = $query->fetchAll();
?>

     <!-- ======================= MAIN =========================== -->

    <main class="container">
     
        <h1 class="page-title"><i class="fab fa-hotjar"></i> Liste des pizzas</h1>

        <div class="row">
            <?php
            // on affiche la liste des pizzas
                foreach ($pizzas as $pizza){ ?>

                    <div class= "col-md-4">
                        <div class="card mb-4">
                            <div class="card-img-top-container position-relative">
                                <img class="card-img-top card-img-top-zoom-effect" src="assets/<?php echo $pizza['image']; ?>" alt="<?php $pizza['name']; ?>"> 
                                <div class="pastille"><?= formatPrice ($pizza['price']); ?></div>
                            </div>

                            <div class="card-body">
                               <h4 class="card-title"><?php echo $pizza['name']; ?></h4>
                               <a href="<?="pizza_single.php?id=". $pizza['id'] ?>" class="btn btn-danger">Commandez</a>
                                <!-- quand on clique sur le lien, on doit se rendre sur la page pizza-single.php
                                    et l'URL doit ressembler à pizza single.php?id=ID de la pizza -->

                            </div>
                        </div>
                    </div>

            <?php } ?>
        </div>      
    </main>

    <!-- ======================= SCRIPTS =========================== -->

<!-- Le fichier footer.php est inclus dans la page -->
<?php require_once(__DIR__.'/partials/footer.php'); ?>