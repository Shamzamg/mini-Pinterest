<?php 
include("includes/a_config.php");
include("includes/db/index.php");
include("includes/db/user.php");
include("includes/db/theme.php");
include("includes/db/picture.php");

if (!$USER_LOGGED) {
    header('Location: index.php');
    exit();
}

if(isset($_GET["user"])) {
    $PROFILE_USER_ID = $_GET["user"];
} else if(isset($_POST["user"])) {
    $PROFILE_USER_ID = $_POST["user"];
} else {
    $PROFILE_USER_ID = $USER_ID;
}

if(isset($_POST["remove"])) {
    $PROFILE_THEME_ID = $_POST["remove"];
} else if(isset($_GET["theme"])) {
    $PROFILE_THEME_ID = $_GET["theme"];
} else if(isset($_POST["theme"])) {
    $PROFILE_THEME_ID = $_POST["theme"];
} else {
    $PROFILE_THEME_ID = null;
}

$pdo = getConnection();
$user = getUserById($pdo, $PROFILE_USER_ID);
if(isset($PROFILE_THEME_ID)) {
    $theme = getThemeById($pdo, $PROFILE_THEME_ID);
    if(!$theme) {
        $PROFILE_THEME_ID = null;
    }
}
closeConnexion($pdo);

if(!$user) {
    closeConnexion($pdo);
    header('Location: index.php');
    exit();
}

if(isset($_POST["remove"]) && isset($theme) && $userCanModify($PROFILE_USER_ID)) {
    $pdo = getConnection();

    $files = getPictureFilesByThemeId($pdo, $theme["id"]);
    foreach($files as $f) {
        unlink($f);
    }
    removePictureByThemeId($pdo, $theme["id"]);
    removeTheme($pdo, $theme["id"]);
    
    closeConnexion($pdo);

    header('Location: profile.php?user='.$PROFILE_USER_ID);
    exit();
}

$THEME_USER_ID = $PROFILE_USER_ID;
$PICTURES_USER_ID = $PROFILE_USER_ID;
$PICTURES_THEME_ID = $PROFILE_THEME_ID;

?>
<!DOCTYPE html>
<html>

<head>
    <?php include("includes/head-tag-contents.php"); ?>
</head>

<body>
    <?php include("includes/navigation.php"); ?>

    <div class="mainContainer">
        <h1><?= $user["pseudo"] ?></h1>

        <?php 
        if(isset($PROFILE_THEME_ID)) {
            echo '<h2>'.$theme["name"].'</h2>';
            if($userCanModify($PROFILE_USER_ID)) {
                echo '
                <form method="post" id="removeForm">
                    <input type="hidden" name="remove" value="'.$PROFILE_THEME_ID.'">
                    <input type="button" name="btn" value="Remove" id="removeBtn" data-toggle="modal" data-target="#confirm-remove" class="btn btn-danger" />
                </form>
                ';
            }
            include("includes/picture-grid.php");
        } else {
            include("includes/themes-grid.php");
        }
        ?>
    </div>

    <div class="modal fade" id="confirm-remove" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Confirm Remove
                </div>
                <div class="modal-body">
                    Are you sure you want to remove this theme ?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <a href="#" id="removeConfirm" class="btn btn-danger success">Remove</a>
                </div>
            </div>
        </div>
    </div>

    <?php include("includes/footer.php"); ?>

</body>

<script>
    $('#removeBtn').click(function() {
     /* when the button in the form, display the entered values in the modal */
     $('#lname').text($('#lastname').val());
     $('#fname').text($('#firstname').val());
    });

    $('#removeConfirm').click(function(){
        $('#removeForm').submit();
    });
</script>

</html>