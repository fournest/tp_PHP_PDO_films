<?php
include 'includes/head.php';
include 'includes/header.php';
include 'includes/menu.php';
include 'includes/db.php';


if (!empty($_GET)) {
    $sql = 'DELETE FROM films WHERE id = :id';
    $stmt = $pdo->prepare($sql);

    $stmt->execute(['id' => $_GET['id']]);
    header('Location: index.php');
}


?>




<?php
include 'includes/footer.php';
