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

    <div class="card container bg-white shadow p-3 mb-5" id="main-content">
        <h2>Statistiques du site</h2>
        <?php echo '<h5> Il y a: <red>'.getUserCount($pdo).'</red> inscrits sur Pic !</red></h5>'; 
              echo '<h5>Au total, <lightblue>'.getPicturesCount($pdo).'</lightblue> photos ont été postées sur Pic !</h5>';
              if(getPicturesCount($pdo) != 0){
                //number_format permet de garder n nombres après la virgules pour éviter les 1.666666666666667
                echo '<h5>Sur Pic, chaque utilisateur poste en moyenne <gray>'.number_format(getPicturesCount($pdo)/getUserCount($pdo), 2, ".", ",").'</gray> photo(s) !</h5>';
              }
              closeConnexion($pdo);?>
        
    </div>

    <?php include("includes/footer.php"); ?>

</body>

</html>