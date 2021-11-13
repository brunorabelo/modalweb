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
    public string $user_email;
    public string $quantity;
    public CategoryModel $category;

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

    private static function annonceFromRow($row)
    {
        $annonce = new AnnonceModel();
        $annonce->id = $row['id'];
        $annonce->title = $row['title'];
        $annonce->description = $row['description'];
        $annonce->price = $row['price'];
        $annonce->place = $row['place'];
        $annonce->photo = $row['photo'];
        $annonce->user_email = $row['user_email'];
        $annonce->quantity = $row['quantity'];
        $annonce->category_id = $row['category_id'];
        $category = new CategoryModel();
        $category->id = $row['category_id'];
        $category->nom = $row['nom'];
        $annonce->category = $category;
        return $annonce;
    }

    public static function getAnnonceDetails($id)
    {

        $dbh = Database::connect();
        $query = "SELECT a.*, c.nom FROM `annonce` as a join categories as c on a.category_id=c.id WHERE a.id = ?";
        $sth = $dbh->prepare($query);
//        $sth->setFetchMode(PDO::FETCH_CLASS, 'AnnonceModel');
        $sth->execute([$id]);
        $row = $sth->fetch(PDO::FETCH_ASSOC);
        if (!$row)
            return null;
        $annonce = self::annonceFromRow($row);
        $sth->closeCursor();

        $dbh = null;
        return $annonce;
    }

    public static function deleteAnnonce($id)
    {
        $annonce = AnnonceModel::getAnnonceDetails($id);
        if ($annonce->user_email != $_SESSION['user']->email)
            return;

        $dbh = Database::connect();
        $query = "DELETE FROM `annonce` WHERE id = ?";
        $sth = $dbh->prepare($query);
        $sth->execute([$id]);
        $sth->closeCursor();

        $dbh = null;
    }

    public static function getUserAnnonces($user)
    {
        $dbh = Database::connect();
        $query = "SELECT a.*, c.nom FROM `annonce` as a join categories as c on a.category_id=c.id  WHERE a.user_email = ?";
        $sth = $dbh->prepare($query);
        $sth->execute([$user->email]);
        $annonces = array();
        while (($row = $sth->fetch(PDO::FETCH_ASSOC)) !== false) {
            $annonces[] = self::annonceFromRow($row);
        }
        $sth->closeCursor();

        $dbh = null;
        return $annonces;
    }

    public static function updateAnnonce($id, $title, $description, $quantity, $place, $price, $category_id, $photo)
    {
        $dbh = Database::connect();
        $sth = $dbh->prepare("UPDATE `annonce` SET `title` = ?, `description` = ?, `quantity` = ?, `place` = ?, 
                     `price` = ?, `category_id` = ?, `photo` = ? WHERE id= ?");
        $res = $sth->execute(array($title, $description, $quantity, $place, $price, $category_id, $photo, $id));
        $dbh = null;
        return $res;
    }

    public static function insererAnnonce($title, $description, $quantity, $place, $user_email, $price, $category_id, $photo)
    {
        $dbh = Database::connect();
        $sth = $dbh->prepare("INSERT INTO `annonce` (`title`, `description`, `quantity`, `place`,  `user_email`, 
                     `price`, `category_id`, `photo`) VALUES(?,?,?,?,?,?,?,?)");
        $res = $sth->execute(array($title, $description, $quantity, $place, $user_email, $price, $category_id, $photo));
        $dbh = null;
        return $res;
    }

    public static function getAllAnnonces()
    {
        $dbh = Database::connect();
        $query = "SELECT a.*, c.nom FROM `annonce` as a join categories as c on a.category_id=c.id";
        $sth = $dbh->prepare($query);
//        $sth->setFetchMode(PDO::FETCH_CLASS, 'AnnonceModel');
        $sth->execute();
        $annonces = array();
        while (($row = $sth->fetch(PDO::FETCH_ASSOC)) !== false) {
            $annonces[] = self::annonceFromRow($row);
        }
        $sth->closeCursor();

        $dbh = null;
        return $annonces;
    }


}

