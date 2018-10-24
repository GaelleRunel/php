# Pizza store PDO SQL

- Récupérer un backup de la BDD pizzastore

L'intérêt dest de pouvoir recréer le structurede la base à tout moment.

Au niveau du PHP, on va créer quelques fichiers/dossiers:
- config/database.php -> connexion à la base de données en PDO, sera inclus dans tous les fichiers PHP
- partials/header.php -> le header du site à inclure dans toutes les pages (Bootstrap CDN)
- partials/footer.php -> le footer du site à inclure dans toutes les pages
- index.php -> la page accueil du site
- pizza_list.php -> lister toutes les pizzas de la BDD
- pizza_single -> la page d'une seule pizza


Au niveau du font
- assets/ -> dossier qui contiendra le CSS, le JS, les images,
