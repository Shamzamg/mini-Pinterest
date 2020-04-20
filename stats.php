<?php
include("includes/a_config.php");
include("includes/db/index.php");
include("includes/db/theme.php");
include("includes/db/picture.php");

if (!$USER_LOGGED || !$USER_IS_MODERATOR) {
    header('Location: /');
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <?php include("includes/head-tag-contents.php"); ?>
</head>

<body class="bg-light">
    <?php include("includes/navigation.php"); ?>

    <div class="card container bg-white" id="main-content">
        <h2>About Us</h2>
        <p>"About Us" conten goes here. I'll stick with teh "lorem ipsum" as well, so that the footer isn't immediately following this text.</p>

        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
        </p>
    </div>

    <?php include("includes/footer.php"); ?>

</body>

</html>