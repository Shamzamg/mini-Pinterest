<?php
include("includes/a_config.php");
include("includes/db/index.php");
include("includes/db/theme.php");
include("includes/db/picture.php");
include("includes/db/user.php");

if (!$USER_LOGGED || !$USER_IS_MODERATOR) {
    header('Location: index.php');
    exit();
}

$pdo = getConnection();

?>
<!DOCTYPE html>
<html>

<head>
    <?php include("includes/head-tag-contents.php"); ?>
</head>

<body class="bg-light">
    <?php include("includes/navigation.php"); ?>

    <div class="card container bg-white" id="main-content">
        <h2>Statistiques du site</h2>
        <?php echo '<h4>Il y a: '.getUserCount($pdo).' inscrits sur Pic !</h4>'; ?>
        <h3>Nombre de photos par utilisateurs<h3>
    </div>

    <?php include("includes/footer.php"); ?>

</body>

</html>