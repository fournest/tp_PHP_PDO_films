<?php

include 'includes/head.php';
include 'includes/menu.php';
require 'includes/header.php';
include 'includes/db.php';






$sql =  'SELECT films.* FROM films ';
$where = '';
$params = [];
$itemsParPage = 5;
$page = 1;
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($currentPage - 1) * $itemsParPage;
$totalFilms = $pdo->query("SELECT COUNT(*) AS totalFilms FROM films")->fetchColumn();
$totalPages = ceil($totalFilms / $itemsParPage);
$films = $pdo->prepare("SELECT films.*, genres.id AS genreId, genres.nom FROM films LEFT JOIN genres ON genres.id = films.genre_id ORDER BY annee DESC LIMIT :offset, :itemsParPage ");
$films->bindValue(':offset', $offset, PDO::PARAM_INT);
$films->bindValue(':itemsParPage', $itemsParPage, PDO::PARAM_INT);
$films->execute();


if (!empty($_GET['search'])) {
    $where = "WHERE titre LIKE :search_term OR realisateur LIKE :search_term";
    $params['search_term'] = '%' . $_GET['search'] . '%'; 
}

$sql = "SELECT films.*, genres.nom AS genre_nom FROM films
        LEFT JOIN genres ON films.genre_id = genres.id
        $where
        ORDER BY annee DESC
        LIMIT $itemsParPage OFFSET $offset";

$films = $pdo->prepare($sql);
$films->execute($params);
?>

<h1>VOTRE REPÉRTOIRE DE FILMS</h1>

<form action="" method="GET">
    <label for="search">Rechercher par titre ou réalisateur : </label>
    <input type="text" name="search" id="search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
    <input type="submit" value="Recherchez votre film">
</form>


<div class="img_principale">
    <h2>"Votre collection, en un clic."</h2>
    <img src="./img/library-488672_640.jpg" alt="bibliothèque de DVD">
</div>

<a href="ajouter.php">➕ Ajouter un film</a>

<table>
    <tr>
        <th>Titre</th>
        <th>Réalisateur</th>
        <th>Année</th>
        <th>Genre</th>
        <th>Actions</th>
    </tr>

    <?php
   

    foreach ($films as $film):

    ?>
        <tr>
            <td><?= htmlspecialchars($film['titre']) ?></td>
            <td><?= htmlspecialchars($film['realisateur']) ?></td>
            <td><?= $film['annee'] ?></td>
            <td><?= htmlspecialchars($film['genre_nom']) ?></td>
            <td>
                <a href="modifier.php?id=<?= $film['id'] ?>">Modifier</a> |
                <a href="supprimer.php?id=<?= $film['id'] ?>" onclick="return confirm('Supprimer ce film ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="pagination">
    <?php if ($totalPages > 1): ?>
        <?php if ($currentPage > 1): ?>
            <a href="index.php?page=<?= $currentPage - 1 ?>">Précédent</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a href="index.php?page=<?= $i ?>" class="<?= ($i == $currentPage) ? 'active' : '' ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <a href="index.php?page=<?= $currentPage + 1 ?>">Suivant</a>
        <?php endif; ?>
    <?php endif; ?>
</div>








<?php include 'includes/footer.php';

?>