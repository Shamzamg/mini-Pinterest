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
    <link rel="stylesheet" href="styles/stats.css">
</head>

<body class="bg-light">
    <?php include("includes/navigation.php"); ?>

    <div class="card container bg-white" id="main-content">
        <h2>Statistiques du site</h2>
        <?php echo '<h4> Il y a: <red>'.getUserCount($pdo).'</red> inscrits sur Pic !</red></h4>'; 
              echo '<h4>Au total, <gray>'.getPicturesCount($pdo).'</gray> photos ont été postées sur Pic !</h4>';?>
        
    </div>

    <?php include("includes/footer.php"); ?>

</body>

</html>