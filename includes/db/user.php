<?php

/**
 * Vérifie si un email n'est pas utilisé dans la relation user
 * @param string $email
 * @param PDO $pdo
 */
function checkUserAvailability($email, $pdo)
{
	$res = executeQuery($pdo, 
		"SELECT U.email FROM User U WHERE U.email = ?", array(
			$email
		)
	);
	$available = $res->rowCount() == 0;
	$res->closeCursor();

	return $available;
}

/**
 * Enregistre un nouvel utilisateur dans la relation user
 */
function register($email, $hashPwd, $pseudo, $pdo)
{
	executeUpdate($pdo, 
		"INSERT INTO User (`email`,`pwd`,`pseudo`,`rights`) VALUES (?,?,?,'USER')", array(
			$email, $hashPwd, $pseudo
		)
	);
}

/**
 * Vérifie si l'utilisateur existe avec le mot de passe spécifié et renvoit son pseudo si il existe, null sinon
 * @param PDO $pdo
 */
function getUser($email, $hashPwd, $pdo)
{
	$res = executeQuery($pdo, 
		"SELECT * FROM User U WHERE U.email = ? AND U.pwd = ?", array(
			$email, $hashPwd
		)
	);
	$user = $res->fetch();
	$res->closeCursor();
	return $user;
}

function getUserById($pdo, $id)
{
	$res = executeQuery($pdo, 
		"SELECT * FROM User U WHERE U.id = ?", array(
			$id
		)
	);
    $user = $res->fetch();
    $res->closeCursor();
    return $user;
}

?>
