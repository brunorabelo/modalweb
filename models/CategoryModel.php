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
}

?>
