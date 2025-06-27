<?php
include 'includes/head.php';
include 'includes/header.php';
include 'includes/menu.php';
include 'includes/db.php';



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
        'resume' => $_POST['resume']
        
    ]);

   header('Location: index.php');
}

?>

<h2>Ajouter vos DVD ici!</h2>

<form action="ajouter.php" method="POST">
    
    <label for=""> Le titre du DVD</label>
    <input type="text" name="titre">
    <label for="">Le réalisateur</label>
    <input type="text" name="realisateur">
    <label for="">Année de sortie en salle</label>
    <input type="text" name="annee">
    <label for="">Le genre du film</label>
    <input type="text" name="genre">
    <label for="">Le résumé</label>
    <textarea type="text" name="resume"></textarea>
    <input type="submit" value="Rangez votre DVD ici!">
</form>


<?php 

include 'includes/footer.php';