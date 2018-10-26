<?php
$currentPageTitle = "Ajouter une pizza";

//Le fichier header.php est inclus dans la page 
require_once(__DIR__.'/partials/header.php'); ?>

     <!-- ======================= MAIN =========================== -->
<?php 

    $name = null;
    $price = null;
    $image = null;
    $description = null;
    $category = null;

    if (!empty($_POST)) { // Récupére les informations saisies dans le formulaire
        $name = $_POST['pizza-name'];
        $price = $_POST['pizza-price'];
        $image = $_POST['pizza-image'];
        $description = $_POST['pizza-description'];
        $category = $_POST['pizza-category'];
        
        $errors = [];
        
        if (empty($name)) { // Vérifie si le nom est vide
            $errors['pizza-name'] = 'Il manque le nom de la pizza. <br />';
        }
        
        if (empty($price)) {
            $errors['pizza-price'] = 'Il manque le prix de la pizza. <br />';
        }
        
        if (empty($image)) {
            $errors['pizza-image'] = 'Il manque l\'image de la pizza. <br />';
        }
        
        if (empty($description)) { 
            $errors['pizza-description'] = 'Il manque la description de la pizza. <br />';
        }

        if (empty($errors)) {
            
            $query=$db->prepare('INSERT INTO Pizza (`name`, `price`, `image`) VALUES (:name, :price, :image)');

            $query->bindValue(':name', $name, PDO::PARAM_STR);
            $query->bindValue(':price', $price, PDO::PARAM_STR);
            $query->bindValue(':image', $image, PDO::PARAM_STR);

           if($query->execute()){ // on insère la pizza dans la BDD
                $success= true; // logger la création de la pizza
           };
        }
        
    }
    

?>



    <main class="container">
     
        <h1 class="page-title"><i class="fab fa-hotjar"></i> Ajouter une pizza</h1>

        <div class="container col-md-8 form">
            <?php if (isset($success) && $success) { ?>
                <div class="alert alert-success alert-dismissible fade show">
                    La pizza <strong><?php echo $name; ?></strong> a bien été ajouté avec l'id <strong><?php echo $db->lastInsertId(); ?></strong> !
                    <button type="button" class="close" data-dismiss="alert">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php } ?>

            <form method="POST" action="pizza_add.php">

                <div class="form-group">
                    <label for="pizza-name">Nom</label>
                    <input type="text" class="form-control <?= (isset($errors['pizza-name'])) ? 'is-invalid' : ''; ?>" id="pizza-name" 
                            name= "pizza-name" value="<?= $name; ?>">
                    <div class="invalid-feedback">
                        <?php echo (isset($errors['pizza-name'])) ? $errors['pizza-name']: ''; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pizza-price">Prix</label>
                    <input type="number" step="0.01" class="form-control <?= (isset($errors['pizza-price'])) ? 'is-invalid' : ''; ?>" id="pizza-price" 
                            name= "pizza-price" value="<?=$price; ?>">
                    <div class="invalid-feedback">
                        <?php echo (isset($errors['pizza-name'])) ? $errors['pizza-name']: ''; ?>
                    </div>        
                </div>

                <div class="form-group">
                    <label for="pizza-image">Image</label>
                    <input type="text" class="form-control <?= (isset($errors['pizza-image'])) ? 'is-invalid' : ''; ?>" id="pizza-image" 
                            name="pizza-image" value="<?=$image;?>">
                    <div class="invalid-feedback">
                        <?php echo (isset($errors['pizza-image'])) ? $errors['pizza-image']: ''; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pizza-description">Description</label>
                    <input type="text" class="form-control <?= (isset($errors['pizza-description'])) ? 'is-invalid' : ''; ?>" id="pizza-description" 
                            name="pizza-description" value="<?=$description;?>">
                    <div class="invalid-feedback">
                        <?php echo (isset($errors['pizza-description'])) ? $errors['pizza-description']: ''; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pizza-category">Catégorie</label>
                    <select class="form-control" id="pizza-category" 
                            name="pizza-category">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                    </select>
                </div>
                
                <button class="btn btn-danger btn-block">OK</button>
                <?php= $errors?>
                
            </form>
        </div>
    </main>


    <!-- ======================= SCRIPTS =========================== -->

<!-- Le fichier footer.php est inclus dans la page -->
<?php require_once(__DIR__.'/partials/footer.php'); ?> 
   
    