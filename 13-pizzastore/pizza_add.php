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
        $image = $_FILES['pizza-image'];  // tableau avec toutes les info sur l'image uploadée
        $description = $_POST['pizza-description'];
        $category = $_POST['pizza-category'];

        
        
        $errors = [];
        
        if (empty($name)) { // Vérifie si le nom est vide
            $errors['pizza-name'] = 'Il manque le nom de la pizza. <br />';
        }
        
        if (empty($price)) {
            $errors['pizza-price'] = 'Il manque le prix de la pizza. <br />';
        }
        
        if ($image['error']=== 4) {
            $errors['pizza-image'] = 'L\'image n\'est pas valide. <br />';
        }
        
        if (strlen($description) < 10) { 
            $errors['pizza-description'] = 'La description n\'est pas valide. <br />';
        }

        if (empty($category) || !in_array($category, ['classique', 'spicy', 'hot', 'vegetarienne'])){ 
            $errors['pizza-category'] = 'Il manque la categorie de la pizza. <br />';
        }

        // upload de l'image
        // if(empty($errors)){

            var_dump($image);
            $file = $image['tmp_name']; // emplacement du fichier temporaire
            $fileName = 'img/pizzas/'.$image['name']; // variable pour la BDD
            $finfo = finfo_open(FILEINFO_MIME_TYPE); // permet d'ouvrir un fichier
            $mimeType = finfo_file($finfo, $file);  // ouvre le fichier et renvoie image/jpg
            $allowedExtensions = ['image/jpg', 'image/jpeg', 'image/png', 'image/gif'];

            // si l'extension n'est pas autorisée, il y a une erreur
            if(!in_array($mimeType, $allowedExtensions)){
                $errors['pizza-image'] = 'Ce type de fichier n\'est pas autorisé';
            }

            // verifier la taille du fichier


            if(!isset($errors['pizza-image'])){
                move_uploaded_file($file, __DIR__.'/assets/'.$fileName);  // on déplace le fichier uploadé où on le souhaite
            }
        // }

        // s'il n'y a pas d'erreur dans le formulaire    
        if (empty($errors)) {
            
            $query=$db->prepare('INSERT INTO pizza (`name`, `price`, `image`, `description`, `category`) VALUES (:name, :price, :image, :description, :category)');

            $query->bindValue(':name', $name, PDO::PARAM_STR);
            $query->bindValue(':price', $price, PDO::PARAM_STR);
            $query->bindValue(':image', $fileName, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':category', $category, PDO::PARAM_STR);

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

            <form method="POST" enctype="multipart/form-data"">

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
                    <input type="file" class="form-control <?= (isset($errors['pizza-image'])) ? 'is-invalid' : ''; ?>" id="pizza-image" 
                            name="pizza-image">
                    <div class="invalid-feedback">
                        <?php echo (isset($errors['pizza-image'])) ? $errors['pizza-image']: ''; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pizza-description">Description</label>
                    <textarea class="form-control <?= (isset($errors['pizza-description'])) ? 'is-invalid' : ''; ?>" id="pizza-description" 
                            rows= "4" name="pizza-description" value="<?=$description;?>"></textarea>
                    <div class="invalid-feedback">
                        <?php echo (isset($errors['pizza-description'])) ? $errors['pizza-description']: ''; ?>
                    </div>
                </div>

                <div class="form-group">
                    <label for="pizza-category">Catégorie</label>
                    <select class="form-control<?= (isset($errors['pizza-category'])) ? 'is-invalid' : ''; ?>" id="pizza-category" 
                            name="pizza-category">
                        <option value ="">Choisir la catégorie</option>
                        <option <?php echo ($category === 'classique')? 'selected' : ''; ?> value ="classique">Classique</option>
                        <option <?php echo ($category === 'spicy')? 'selected' : ''; ?> value ="spicy">Spicy</option>
                        <option <?php echo ($category === 'hot')? 'selected' : ''; ?> value ="hot">Hot</option>
                        <option <?php echo ($category === 'vegetarienne')? 'selected' : ''; ?> value ="vegetarienne">Végétarienne</option>
                    </select>
                    <div class="invalid-feedback">
                        <?php echo (isset($errors['pizza-category'])) ? $errors['pizza-category']: ''; ?>
                    </div>
                </div>
                
                <button class="btn btn-danger btn-block">OK</button>
                <?php= $errors?>
                
            </form>
        </div>
    </main>


    <!-- ======================= SCRIPTS =========================== -->

<!-- Le fichier footer.php est inclus dans la page -->
<?php require_once(__DIR__.'/partials/footer.php'); ?> 
   
    