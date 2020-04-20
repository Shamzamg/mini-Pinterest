<?php
	define("MAX_IMAGE_SIZE", 1000000); // 1Mo
	
	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}

	$USER_NAME = "";
	$USER_ID = "";
	$USER_RIGHTS = null;
	$USER_LOGGED = false;
	if(isset($_SESSION["user"])) {
		$USER_NAME = $_SESSION["user"]["pseudo"];
		$USER_ID = $_SESSION["user"]["id"];
		$USER_RIGHTS = $_SESSION["user"]["rights"];
		$USER_LOGGED = true;
	}

	$USER_IS_ADMIN = ($USER_RIGHTS == "ADMIN");
	$USER_IS_MODERATOR = ($USER_RIGHTS == "MODERATOR") || $USER_IS_ADMIN;

	switch ($_SERVER["SCRIPT_NAME"]) {
		case "/about.php":
			$CURRENT_PAGE = "About"; 
			$PAGE_TITLE = "About Us";
			break;
		case "/themes.php":
			$CURRENT_PAGE = "Themes"; 
			$PAGE_TITLE = "Themes";
			break;
		case "/stats.php":
			$CURRENT_PAGE = "Stats";
			$PAGE_TITLE = "Stats";
			break;
		default:
			$CURRENT_PAGE = "Index";
			$PAGE_TITLE = "Pic";
	}

	$userCanModify = function($userId) use ($USER_ID, $USER_IS_MODERATOR)
	{
		return $userId == $USER_ID || $USER_IS_MODERATOR;
	};
?>