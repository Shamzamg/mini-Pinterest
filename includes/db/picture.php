<?php

function addPicture($pdo, $title, $file, $description, $themeId)
{
    executeUpdate($pdo, 
        "INSERT INTO Picture (`title`,`file`,`description`,`themeId`) VALUES (?,?,?,?)", array(
            $title, $file, $description, $themeId
        )
    );
}

function removePicture($pdo, $id)
{
    executeUpdate($pdo, 
        "DELETE FROM Picture WHERE id = ?", array(
            $id
        )
    );
}

function removePictureByThemeId($pdo, $themeId)
{
    executeUpdate($pdo, 
        "DELETE FROM Picture WHERE themeId = ?", array(
            $themeId
        )
    );
}

function removePictureByUserId($pdo, $userId)
{
    executeUpdate($pdo, 
        "DELETE FROM Picture WHERE themeId IN (SELECT id FROM Theme WHERE userId = ?)", array(
            $userId
        )
    );
}

function getPictureById($pdo, $id)
{
    $res = executeQuery($pdo, 
        "SELECT * FROM Picture P WHERE P.id = ?", array(
            $id
        )
    );
    $picture = $res->fetch();
    $res->closeCursor();
    return $picture;
}

function getPicturesByThemeName($pdo, $themeName, $limit=100)
{
    $res = executeQuery($pdo, 
        "SELECT P.*, T.name as themeName, T.userId, T.id as themeId
            FROM Picture P INNER JOIN Theme T ON P.themeId = T.id WHERE T.name = ? LIMIT $limit", array(
                $themeName
            )
    );
    $pictures = $res->fetchAll();
    $res->closeCursor();
    return $pictures;
}

function getPicturesByThemeId($pdo, $themeId, $limit=100)
{
    $res = executeQuery($pdo, 
        "SELECT * FROM Picture P WHERE P.themeId = ? LIMIT $limit", array(
            $themeId
        )
    );
    $pictures = $res->fetchAll();
    $res->closeCursor();
    return $pictures;
}

function getPicturesByUserId($pdo, $userId, $limit=100)
{
    $res = executeQuery($pdo, 
        "SELECT P.* FROM Picture P INNER JOIN Theme T ON P.themeId = T.id WHERE T.userId = ? LIMIT $limit", array(
            $userId
        )
    );
    $pictures = $res->fetchAll();
    $res->closeCursor();
    return $pictures;
}

function getPopularPictures($pdo, $limit=100) {
    $res = executeQuery($pdo, 
        "SELECT * FROM Picture P LIMIT $limit"
    );
    $pictures = $res->fetchAll();
    $res->closeCursor();
    return $pictures;
}

function getPictureFilesByThemeId($pdo, $themeId)
{
    $files = array();
    $res = executeQuery($pdo, 
        "SELECT P.file FROM Picture P WHERE P.themeId = ?", array(
            $themeId
        )
    );

    while ($row = $res->fetch()) {
        array_push($files, $row['file']);
    }

    $res->closeCursor();
    return $files;
}

function getPictureFilesByUserId($pdo, $userId)
{
    $files = array();
    $res = executeQuery($pdo, 
        "SELECT P.file FROM Picture P INNER JOIN Theme T ON P.themeId = T.id WHERE T.userId = ?", array(
            $userId
        )
    );

    while ($row = $res->fetch()) {
        array_push($files, $row['file']);
    }

    $res->closeCursor();
    return $files;
}

?>