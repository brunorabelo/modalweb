<?php

require_once "../db/db.php";

class UserModel
{
    public string $email;
    public string $username;
    public string $password;
    public string $phone;
    public string $address;
    public bool $is_admin;

    public static function getUser($email)
    {
        $dbh = Database::connect();
        $query = "SELECT * FROM `users` WHERE email=?";
        $sth = $dbh->prepare($query);
        $sth->setFetchMode(PDO::FETCH_CLASS, 'User');
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

        if (password_verify($mdp, $user->mdp))
            return true;
        return false;
    }

    public static function insererUtilisateur($password, $phone, $address, $email)
    {
        $dbh = Database::connect();
        if (is_null(UserModel::getUser($email))) {
            $sth = $dbh->prepare("INSERT INTO `users` (`password`, `phone`, `address`, `email`) VALUES(?,?,?,?)");
            $sth->execute(array( password_hash($password, PASSWORD_DEFAULT), $phone, $address, $email));
        }
        $dbh = null;
    }
}

?>
