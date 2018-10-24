<?php
// On crée une connexion à la BDD
// $db = new PDO('mysql:host=localhost;dbname=pizzastore', 'root', '');
// Le try catch permet de faire quelque chose de particulier s'il y a une erreur
try {
	$db = new PDO('mysql:host=localhost;dbname=pizzastore;charset=utf8', 'root', '', [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // Active les erreurs SQL,
		// On récupère tous les résultats en tableau associatif
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	]);
} catch(Exception $e) {
	echo $e->getMessage();
	// Redirection en PHP vers Google avec le message d'erreur concerné
	header('Location: https://www.google.fr/search?q='.$e->getMessage());
}

// Ecrire la requete qui permet de récupérer la pizza avec l'id 3

$query = $db->query('SELECT * FROM pizza WHERE id=3');

$pizza = $query->fetch();

echo'<h1>'.$pizza['name'].'</h1>';



echo '<br/>';

// Récupérer l'id dynamiquement à partir de l'url
// ex: si je saisis pizza.php?id=7, je dois récupérer la pizza avec l'id 7

$id = isset ($_GET['id'])? $_GET['id'] : 0;

if(is_numeric($id)){

    $query_2 = $db->query('SELECT * FROM pizza WHERE id ='.$id);
    $pizza_2 = $query_2->fetch();

    // on vérifoe que la pizza existe bien
    if($pizza_2){
        echo $pizza_2['name'];
    }else{
        echo 'La pizza n\'existe pas';
    }

}else{
    echo 'La pizza n\'existe pas';
}
