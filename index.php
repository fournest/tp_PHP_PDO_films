




<?php

include 'includes/head.php';
include 'includes/menu.php';
require 'includes/header.php';
include 'includes/db.php';









?>

<h1>VOTRE REPÉRTOIRE DE FILMS</h1>
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
    $films = $pdo->query("SELECT * FROM films ORDER BY annee DESC")->fetchAll();
    foreach ($films as $film):
    ?>
    <tr>
        <td><?= htmlspecialchars($film['titre']) ?></td>
        <td><?= htmlspecialchars($film['realisateur']) ?></td>
        <td><?= $film['annee'] ?></td>
        <td><?= htmlspecialchars($film['genre']) ?></td>
        <td>
            <a href="modifier.php?id=<?= $film['id'] ?>">Modifier</a> |
            <a href="supprimer.php?id=<?= $film['id'] ?>" onclick="return confirm('Supprimer ce film ?')">Supprimer</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>









    <?php include 'includes/footer.php';

    ?>