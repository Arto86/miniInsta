<?php
var_dump($_FILES);
if (isset($_FILES['photo']) && $_FILES['photo']['error'] === 0){
    $author = htmlspecialchars($_POST['author']);
    $tmp_name = $_FILES['photo']['tmp_name'];
    $original_name = basename($_FILES['photo']['name']);
    $size = $_FILES['photo']['size'];
    $mime_type = mime_content_type($tmp_name);
    $extension = strtolower(pathinfo($original_name, PATHINFO_EXTENSION));

    $allowed_mimes = ['image/jpeg', 'image/png', 'image/gif', 'image.webp'];
    $allowed_exts = ['jpg', 'jpeg', 'png', 'gif'];
    $max_size = 2 * 1024 * 1024;

    if(!in_array($mime_type, $allowed_mimes) || !in_array($extension, $allowed_exts)){
        echo "Extension non autorisée.";
    } else if ($size > $max_size){
        echo "Fichier trop volumineux (max 2 MO).";
    }else {
        $upload_dir = 'uploads/';
        if(!is_dir($upload_dir)){
            mkdire($upload_dir, 0755, true);
        }
        $new_name = $upload_dir . time() . '_' . preg_replace('/[^a-zA-Z0-9\-]/', '_', $author) . '.' . $extension;
        if (move_uploaded_file($tmp_name, $new_name)) {
            echo "Fichier bien envoyé : $new_name";
        } else {
            echo "Erreur lors du déplacement de fichier.";
        }
    }
} else {
    echo "Aucun fichier envoyé ou erreur d'upload.";
}