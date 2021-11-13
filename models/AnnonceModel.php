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

    public static function getUserAnnonces($user)
    {
        $dbh = Database::connect();
        $query = "SELECT * FROM annonce WHERE user_email = ?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'AnnonceModel');
        $sth->execute([$user->email]);
        $annonces = $sth->fetchAll();
        $sth->closeCursor();

        $dbh = null;
        return $annonces;
    }

    public static function insererAnnonce($title, $description, $quantity, $place, $user_email, $price, $category_id, $photo)
    {
        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `users` (`title`, `description`, `quantity`, `place`,  `user_email`, `price`, `category_id`) VALUES(?,?,?,?,?,?)");
        $sth->execute(array($title, $description, $quantity, $place, $user_email, $price, $category_id));

        $photo_id = $dbh->last_insert_id;
        move_uploaded_file($photo, "../content/photo/photo_annonce_$photo_id.jpg");

        $dbh = null;
    }

    public static function getAllAnnonces()
    {
        $dbh = Database::connect();
        $query = "SELECT * FROM annonce";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'AnnonceModel');
        $sth->execute();
        $annonces = $sth->fetchAll();
        $sth->closeCursor();

        $dbh = null;
        return $annonces;
    }


}

