<?php
include 'includes/head.php';
include 'includes/header.php';
include 'includes/menu.php';



if (!empty($_POST)) {

    $sql = "INSERT INTO films (
            titre,
            realisateur,
            annee,
            genre,
            resume
            
        ) VALUES (
            :titre,
            :realisateur,
            :annee,
            :genre,
            :resume
            
        );";

    $stmt = $pdo->prepare($sql);

    $stmt->execute([
        'titre' => $_POST['titre'],
        'realisateur' => $_POST['realisateur'],
        'annee' => $_POST['annee'],
        'genre' => $_POST['genre'],
        'resume' => $_POST['resume'],
        
    ]);

    // echo "<pre>" . print_r($_POST, true) . "</pre>";
}

?>

<h2>Ajouter vos DVD ici!</h2>

<form action="index.php" method="POST">
    <label for=""> Le titre du DVD</label>
    <input type="text" name="titre">
    <label for="">Le réalisateur</label>
    <input type="text" name="realisateur">
    <label for="">Année de réalisation</label>
    <input type="text" name="annee">
    <label for="">Le genre du film</label>
    <input type="text" name="genre">
    <label for="">Le résumé</label>
    <input type="text" name="resume">
    <input type="submit" value="Rangez votre DVD!">
</form>


<?php 

include 'includes/footer.php';