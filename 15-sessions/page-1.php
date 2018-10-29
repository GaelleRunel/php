<?php

session_start(); // on veut utiliser les sessions sur la page

var_dump($_SESSION); // le tableau est vide la 1ere fois / si on rafraichit, il  ne sera plus vide

$countries = ['fr', 'it'];

// j'ajoute les pays dans la session
$_SESSION['countries'] = $countries;

var_dump($_SESSION); // la session doit contenir tous les pays

// si on veut supprimer une élément d'une session
unset($_SESSION['countries');

// si on veut supprimer TOUTE la session
session_destroy();


// pour les cookies (sessions qui durent indéfiniment et sur la machine client)
var_dump($_COOKIE);
setcookie('cookie', 'test', time ()+60*60*24*365); // durée de vie du cookie : 1 an

// détruire un cookie
setcookie('cookie', null, time ()-60*60*24*365); // durée de vie du cookie: -1an
