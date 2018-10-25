<?php 
// on récupère l'ID de la pizza dans l'URL
$id = $_GET['id'];

//Inclusion de la base de données
require_once(__DIR__.'/config/database.php');

$query = $db->prepare('SELECT * FROM pizza WHERE id = :id'); // :id est un parametre 
$query ->bindValue(':id', $id, PDO::PARAM_INT); // on s'assure que l'id est bien un entier
$query ->execute(); // execute la requete
$pizza =$query->fetch();

// renvoyer une 404 si la pizza n'existe pas
if($pizza===false){
    http_response_code(404);
    // on pourrait aussi rediriger l'utilisateur vers la liste des pizzas
    // header('Location: pizza_list.php');
    require_once(__DIR__.'/partials/header.php'); ?>
  <h1>Erreur 404. Redirection dans 5 secondes...</h1>
    <script>
        setTimeout(function(){
            window.location = 'pizza_list.php';
        }, 5000);
    </script>

    <?php
    require_once(__DIR__.'/partials/footer.php'); 
    die();
}


$currentPageTitle = $pizza['name']; // on change le nom dans l'onglet

//Le fichier header.php est inclus dans la page 
require_once(__DIR__.'/partials/header.php'); 

?>

 <!-- ======================= MAIN =========================== -->

    <main class="container">
        
        <h1 class="page-title"><i class="fab fa-hotjar"></i> Ma Pizza : <?php echo $pizza['name'];?>
        </h1>

        <div class="row">
            <div class= "col-md-6">
                <div class="pizza-image">
                    <img class="img-fluid" src="assets/<?php echo $pizza['image']; ?>" alt="<?php $pizza['name']; ?>">
                </div>
            </div>
            <div class= "col-md-6">
                <h3>Ingrédients</h3>
                <div class="ingredients">
                    <ul>
                        <li>Tomates</li>
                        <li>Fromage</li>
                        <li>...</li>
                        <li>...</li>
                    </ul>
                </div>
                <div><a href="#" class="btn btn-danger">Commandez</a></div>
            </div>
        </div>

    </main>

 <!-- ======================= SCRIPTS =========================== -->

<!-- Le fichier footer.php est inclus dans la page -->
<?php require_once(__DIR__.'/partials/footer.php'); ?>








