<?php

require_once "../db/db.php";

class UserModel
{
    public string $email;
    public string $nom;
    public string $prenom;
    public string $password;
    public string $phone;
    public string $address;
    public bool $is_admin;

    public static function getUser($email)
    {
        $dbh = Database::connect();
        $query = "SELECT * FROM `users` WHERE email=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'UserModel');
        $sth->execute(array($email));
        $user = $sth->fetch();
        $sth->closeCursor();

        if (!$user)
            return null;

        $dbh = null;
        return $user;
    }

    public static function login($email, $mdp)
    {
        $user = UserModel::getUser($email);

        if (!$user)
            return null;

        if (!self::testerMdp($user, $mdp))
            return null;

        return $user;
    }

    private static function testerMdp($user, $mdp)
    {
        if (!$user)
            return false;

        if (password_verify($mdp, $user->password))
            return true;
        return false;
    }

    public static function updatePassword($user, $password)
    {
        if (!$user)
            return false;
        $dbh = Database::connect();
        if (!is_null(UserModel::getUser($user->email))) {
            $sth = $dbh->prepare("UPDATE `users` SET `password` = ? WHERE `email` = ?");
            $sth->execute(array(password_hash($password, PASSWORD_DEFAULT), $user->email));
            return true;
        }
        $dbh = null;
        return false;
    }

    public static function updateUser($user, $newNom, $newPrenom, $newTelephone, $newAddress)
    {
        $email = $user->email;
        $dbh = Database::connect();
        if (UserModel::getUser($email)) {
            $sth = $dbh->prepare("UPDATE `users` SET `nom` = ?, `prenom` = ?, `phone` = ?,`address` = ?  WHERE `email` = ?");
            $sth->execute(array($newNom, $newPrenom, $newTelephone, $newAddress, $email));
        }
        $dbh = null;
    }

    public static function insererUtilisateur($password, $phone, $address, $email, $nom, $prenom)
    {
        $dbh = Database::connect();
        if (is_null(UserModel::getUser($email))) {
            $sth = $dbh->prepare("INSERT INTO `users` (`password`, `phone`, `address`, `email`, `nom`, `prenom`) VALUES(?,?,?,?,?,?)");
            $sth->execute(array(password_hash($password, PASSWORD_DEFAULT), $phone, $address, $email, $nom, $prenom));
        }
        $dbh = null;
    }
}

?>
