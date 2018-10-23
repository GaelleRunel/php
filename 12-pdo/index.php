<?php

$db = new PDO ('mysql:host=localhost; dbname=pizzastore;charset=utf8', 'root', '', [
    PDO::ATTR_ERRMODE =>PDO::ERRMODE_WARNING,
]);

//     var_dump ($db);

// $query = $db-> query('SELECT * FROM pizza');

//     var_dump($query);

// $pizzas = $query->fetchAll();

//     var_dump($pizzas);


// Parcourir toutes les pizzas avec le fetchAll et les afficher dans un <h1>


$query = $db-> query('SELECT * FROM pizza');

$results = $query->fetchAll();
var_dump($results);

foreach ($results as $pizza){

    echo '<h1>'.$pizza['name'].'</h1>';

}

// Parcourir toutes les pizzas avec le fetch et les afficher dans un <h1>

$query = $db-> query('SELECT * FROM pizza');

while ($pizza = $query->fetch()){

    echo '<h1>'.$pizza['name'].'</h1>';
}

?>