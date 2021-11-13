<?php

function uploadImage($filename)
{
    if (!empty($_FILES['fichier']['tmp_name']) && is_uploaded_file($_FILES['fichier']['tmp_name'])) {
        // Le fichier a bien été téléchargé
        // Par sécurité on utilise getimagesize plutot que les variables $_FILES
        list($larg, $haut, $type, $attr) = getimagesize($_FILES['fichier']['tmp_name']);
        if (exif_imagetype($_FILES['fichier']['tmp_name'])) {
            if (move_uploaded_file($_FILES['fichier']['tmp_name'], 'img/annonces/' . $filename)) {
                echo "Copie réussie";
                return true;
            }
        }
//        else
//            echo "mauvais type de fichier";
    }
    return false;
}

?>