# Pizza store PDO SQL

- Récupérer un backup de la BDD pizzastore

L'intérêt dest de pouvoir recréer le structurede la base à tout moment.

Au niveau du PHP, on va créer quelques fichiers/dossiers:
- config/database.php -> connexion à la base de données en PDO, sera inclus dans tous les fichiers PHP
- config/config.php -> stocke toutes les varaibles globales
- partials/header.php -> le header du site à inclure dans toutes les pages (Bootstrap CDN)
- partials/footer.php -> le footer du site à inclure dans toutes les pages
- index.php -> la page accueil du site
- pizza_list.php -> lister toutes les pizzas de la BDD
- pizza_single.php -> la page d'une seule pizza


Au niveau du front
- assets/ -> dossier qui contiendra le CSS, le JS, les images
- assets/css/style.css
- assets/js/script.js
- assets/img

## Ajout d'une pizza

- créer la page pizza_add.php (permettra d'ajouter une pizza du cote administrateur)
- ne pas oublier le header et le footer
- ajouter un titre "ajouter une pizza"
- ajouter un formulaire avec les champs suivants :
    - Nom : saisie libre
    - Prix : entre 5 et 19.99
    - image : saisie libre
    - description: saisie libre
    - catégorie: select
- faire le traitement du formulaire (vérifier les données)
- modifier la BDD pour ajouter le champ description (TEXT) et la catégorie (VARCHAR ou ENUM) dans la table pizza
- ajouter la pizza dans la base avec une requete quand on clique sur le bouton submit du formulaire

