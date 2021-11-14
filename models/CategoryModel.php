<?php

require_once "../db/db.php";

class CategoryModel
{
    public int $id;
    public string $nom;

    public static function getCategories()
    {
        $dbh = Database::connect();
        $query = "SELECT * FROM `categories`";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'CategoryModel');
        $sth->execute();
        $categories = $sth->fetchAll();
        $sth->closeCursor();

        $dbh = null;
        return $categories;
    }
    public static function getCategory($id){

        $dbh = Database::connect();
        $query = "SELECT * FROM `categories` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'CategoryModel');
        $sth->execute(array($id));
        $category = $sth->fetch();
        $sth->closeCursor();

        $dbh = null;
        return $category;
    }
    public static function deleteCategory($id){

        $dbh = Database::connect();
        $query = "DELETE FROM `categories` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($id));
        $dbh = null;
    }
    public static function updateCategory($id, $newName){
        $dbh = Database::connect();
        $query = "UPDATE `categories` SET `nom` = ? WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->execute(array($newName, $id));
        $sth->closeCursor();
        $dbh = null;
    }
    public static function insertCategory($categoryName)
    {

        $dbh = Database::connect();
        $query = "INSERT INTO `categories` (`nom`) VALUES(?)";
        $sth = $dbh->prepare($query);
        $sth->execute(array($categoryName));
        $sth->closeCursor();

        $dbh = null;
    }
}

?>
