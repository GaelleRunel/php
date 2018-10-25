<?php 

// inclusion du fichier functions.php
require_once(__DIR__.'/../config/functions.php');
// inclusion du fichier config
require_once(__DIR__.'/../config/config.php'); 
// inclusion du fichier database.php
require_once(__DIR__.'/../config/database.php');
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="assets/img/favicon.ico">

    <title>
        <?php 
            if (empty($currentPageTitle)){ // si on est sur la page d'accueil
                echo $siteName. ' - Notre pizzeria en ligne';
            } else { // si on est sur une autre page
                echo $currentPageTitle .' - '.$siteName;
            }
        ?>
    </title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css">
    <link rel="stylesheet" href="assets/css/style.css">
  </head>

  <body>

    <!-- ======================= NAVBAR =========================== -->
    
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
      <a class="navbar-brand" href="#"><?php echo $siteName; ?></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-pizzastore">
        <span class="navbar-toggler-icon"></span>
      </button>


      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item <?= ($currentPageUrl ==='index') ? 'active' : ''; ?>">
            <a class="nav-link" href="index.php">Accueil</a>
          </li>
          <li class="nav-item <?= ($currentPageUrl ==='pizza_list') ? 'active' : '';?>">
            <a class="nav-link" href="pizza_list.php">Liste des pizzas</a>
          </li>
        </ul>
      </div>
    </nav>
