<?php
function uploadImage($filename)
{
    if (!empty($_FILES['photo']['tmp_name']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
        // Le fichier a bien été téléchargé
        // Par sécurité on utilise getimagesize plutot que les variables $_FILES
        list($larg, $haut, $type, $attr) = getimagesize($_FILES['photo']['tmp_name']);
        $taille_maxi = 3000000;//en octets ici ~3Mo
        $taille = filesize($_FILES['photo']['tmp_name']);
        if($taille>$taille_maxi){
            return false;
        }
        if (exif_imagetype($_FILES['photo']['tmp_name'])) {
            echo 'ici';
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $filename)) {
                return true;
            }
        }
    }
    return false;
}
?>