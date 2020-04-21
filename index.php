<?php 
include("includes/a_config.php");

if(isset($_GET["theme"])) {
    $PICTURES_THEME_NAME = $_GET["theme"];
} else if(isset($_POST["theme"])) {
    $PICTURES_THEME_NAME = $_POST["theme"];
}
?>
<!DOCTYPE html>
<html>

<head>
    <?php include("includes/head-tag-contents.php"); ?>
</head>

<body>
    <?php 
        if($USER_LOGGED) {
            include("includes/navigation.php");
            if(!isset($PICTURES_THEME_NAME)) {
                include("includes/themes-carousel.php");
            }
            else{
                echo '<div class="card container text-center"><h1>'.$PICTURES_THEME_NAME.'</div>';
            }
        }
    ?>

    <div class="mainContainer">
        <?php include("includes/picture-grid.php"); ?>
    </div>

    <?php 
        if(!$USER_LOGGED) {
            include("includes/login/index.php");
        }
        include("includes/footer.php");
    ?>
</body>

</html>