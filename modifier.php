<?php
include 'includes/head.php';
include 'includes/header.php';
include 'includes/menu.php';
include 'includes/db.php';



if (!empty($_POST)) {
    $sql = 'UPDATE films SET titre = :titre, realisateur = :realisateur, annee = :annee, genre = :genre, resume = :resume WHERE id = :id';
    $stmt = $pdo->prepare($sql);
    // echo "DVD mis à jour avec succès.";

    $stmt->execute([
        'id' => $_POST['id'],
        'titre' => $_POST['titre'],
        'realisateur' => $_POST['realisateur'],
        'annee' => $_POST['annee'],
        'genre' => $_POST['genre'],
        'resume' => $_POST['resume'],

    ]);

    // echo "<pre>" . print_r($_POST, true) . "</pre>";
    header('Location: index.php');
}

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $filmId = $_GET['id'];

    $sql = 'SELECT * FROM films WHERE id= :id';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['id' => $filmId]);
    $film = $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

<h2>Modifiez les informations de vos DVD ici!</h2>

<form action="modifier.php?id=<?=$film['id']?>" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($film['id']) ?>">
    <label for=""> Le titre du DVD</label>
    <input type="text" name="titre" value="<?= htmlspecialchars($film['titre']) ?>">
    <label for="">Le réalisateur</label>
    <input type="text" name="realisateur" value="<?= htmlspecialchars($film['realisateur']) ?>">
    <label for="">Année de réalisation</label>
    <input type="text" name="annee" value="<?= htmlspecialchars($film['annee']) ?>">
    <label for="">Le genre du film</label>
    <input type="text" name="genre" value="<?= htmlspecialchars($film['genre']) ?>">
    <label for="">Le résumé</label>
    <input type="text" name="resume" value="<?= htmlspecialchars($film['resume']) ?>">
    <input type="submit" value="Modifiez les informations">
</form>


<?php


include 'includes/footer.php';
// <br /><b>Warning</b>:  Undefined variable $film in <b>C:\xampp\htdocs\Arinfo\tp_PHP_PDO_films\modifier.php</b> on line <b>43</b><br /><br /><b>Warning</b>:  Trying to access array offset on value of type null in <b>C:\xampp\htdocs\Arinfo\tp_PHP_PDO_films\modifier.php</b> on line <b>43</b><br />