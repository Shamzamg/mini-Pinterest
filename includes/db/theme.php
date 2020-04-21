<?php

function checkThemeAvailability($pdo, $theme, $userId)
{
    $res = executeQuery($pdo, 
        "SELECT * FROM Theme T WHERE T.name = ? and T.userId = ?", array(
            $theme, $userId
        )
    );
    $available = ($res->rowCount() == 0);
	$res->closeCursor();

	return $available;
}

function addTheme($pdo, $name, $userId)
{
    executeUpdate($pdo, 
        "INSERT INTO Theme (`name`,`userId`) VALUES (?,?)", array(
            $name, $userId
        )
    );
}

function changeThemeName($pdo, $id, $name)
{
    executeUpdate($pdo, 
        "UPDATE Theme SET name = ? WHERE id = ?", array(
            $name, $id
        )
    );
}

function removeTheme($pdo, $id)
{
    executeUpdate($pdo, 
        "DELETE FROM Theme WHERE id = ?", array(
            $id
        )
    );
}

function removeThemeByUserId($pdo, $userId)
{
    executeUpdate($pdo, 
        "DELETE FROM Theme WHERE userId = ?", array(
            $userId
        )
    );
}

function getThemeById($pdo, $id)
{
    $res = executeQuery($pdo, 
        "SELECT * FROM Theme T WHERE T.id = ?", array(
            $id
        )
    );
    $theme = $res->fetch();
    $res->closeCursor();
    return $theme;
}

/**
 * Retourne les thèmes triés par popularité
 */
function getPopularThemes($pdo, $limit=100)
{
    $themes = array();
    $res = executeQuery($pdo, 
        "SELECT T.name, count(*) as count FROM Theme T GROUP BY T.name ORDER BY count DESC, T.name LIMIT $limit"
    );

    while ($row = $res->fetch()) {
        array_push($themes, $row["name"]);
    }

    $res->closeCursor();

    return $themes;
}

function getUserThemes($pdo, $userId, $limit=100)
{
    $res = executeQuery($pdo, 
        "SELECT U.id as userId, U.email as userEmail, U.pseudo as userName, T.id as themeId, T.name as themeName 
            FROM User U INNER JOIN Theme T ON U.id = T.userId WHERE U.id = ? ORDER BY T.id LIMIT $limit", array(
                $userId
            )
    );
    $themes = $res->fetchAll();
    $res->closeCursor();
    return $themes;
}

function findUserThemeByName($pdo, $userId, $themeName)
{
    $res = executeQuery($pdo, 
        "SELECT * FROM Theme T WHERE T.userId = ? and T.name = ?", array(
            $userId, $themeName
        )
    );
    $theme = $res->fetch();
    $res->closeCursor();
    return $theme;
}

?>
