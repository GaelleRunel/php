<?php

/* FICHIER DE CONFIGURATION GLOBALE
Ce fichier contiendra toutes nos variables "globales" pour notre site.
Titre du site, titre de la page, page courante,...
*/

$siteName = 'Pizza Store';


// si REQUEST_URI vaut home/toto/fichier.php, $page renverra fichier
$currentPageUrl = basename($_SERVER['REQUEST_URI'], '.php');
