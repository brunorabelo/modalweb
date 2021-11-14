<?php
function uploadImage($filename)
{
    $error = '';
    if (!empty($_FILES['photo']['tmp_name']) && is_uploaded_file($_FILES['photo']['tmp_name'])) {
        // Le fichier a bien été téléchargé
        // Par sécurité on utilise getimagesize plutot que les variables $_FILES
        list($larg, $haut, $type, $attr) = getimagesize($_FILES['photo']['tmp_name']);
        $taille_maxi = 6000000;//en octets ici ~3Mo
        $taille = filesize($_FILES['photo']['tmp_name']);
        if ($taille > $taille_maxi) {
            $error = 'The size of the image is too big';
            return $error;
        }
        if (exif_imagetype($_FILES['photo']['tmp_name'])) {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $filename)) {
                return true;
            } else {
                $error = 'It was not possible to upload the image';
            }
        } else {
            $error = 'The type of the image is not accepted';
        }
    }
    return $error;
}

?>