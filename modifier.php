<?php
include 'includes/head.php';
include 'includes/header.php';
include 'includes/menu.php';
include 'includes/db.php';

$genres = $pdo->query("SELECT id, nom FROM genres ORDER BY nom ASC")->fetchAll();

if (!empty($_POST)) {
    $sql = 'UPDATE films SET titre = :titre, realisateur = :realisateur, annee = :annee, genre_id = :genre, resume = :resume WHERE id = :id';
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

if (isset($_GET['id']) && filter_var($_GET['id'], FILTER_VALIDATE_INT) ) {
    $filmId = $_GET['id'];

    $sql = 'SELECT films.*, genres.id AS genreId, genres.nom FROM films LEFT JOIN genres ON genres.id = films.genre_id WHERE films.id= :id';
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
    <select name="genre" id="genre">
        <option value="">-- Sélectionez un genre --</option>
        <?php foreach ($genres as $genre) : ?>
            <option value="<?= htmlspecialchars($genre['id']); ?>"
            <?php if ($genre['id'] === $film['genre_id']): ?>
            selected 
            <?php endif ?>>
                <?= htmlspecialchars($genre['nom']); ?>
            </option>
        <?php endforeach; ?>
    </select>
    <label for="">Le résumé</label>
    <input type="text" name="resume" value="<?= htmlspecialchars($film['resume']) ?>">
    <input type="submit" value="Modifiez les informations">
</form>


<?php


include 'includes/footer.php';
