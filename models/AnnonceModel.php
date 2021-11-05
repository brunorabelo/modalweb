<?php

require_once "../db/db.php";

class AnnonceModel
{
    public int $id;
    public string $title;
    public string $description;
    public string $price;
    public string $place;
    public string $photo;
    public string $category_id;
    public string $username;
    public string $quantity;

    public static function getAnnonces($search, $category = null)
    {
        $dbh = Database::connect();
        $query = "SELECT * FROM annonce WHERE MATCH (title,description, place) AGAINST (? IN BOOLEAN MODE) AND ( category_id = ? ";
        if ($category) {
            $query = $query . ")";
        } else {
            $query = $query . "OR 1=1)";
        }
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'AnnonceModel');
        $sth->execute([$search, $category]);
        $annonces = $sth->fetchAll();
        $sth->closeCursor();

        $dbh = null;
        return $annonces;
    }
}

