<script src="https://kit.fontawesome.com/16e9ed29a1.js" crossorigin="anonymous"></script>

<?php

function lire_dossier(){
    $files_names = [];
    try {
        $photos_dir = opendir("uploads");
        do {
            $file_name = readdir($photos_dir);
            if ($file_name && $file_name != "." && $file_name != ".." && $file_name != "/") {
                $file_names[] = $file_name;
            }
        } while ($file_name);
    } catch (\Throwable $th) {
        throw $th;
    }
    return $file_names;
}

?>

<div class="scroller">
<?php
$liste_des_fichiers = lire_dossier();
foreach ($liste_des_fichiers as $file_name): ?>
<img src="uploads/<?= $file_name ?>">
<h2><?= $author ?></h3>
<p><?= date('F Y') ?></p>
<p><?= date('h:i:s A') ?></p>
<?php endforeach ?>

</div>


<form action="/upload.php" method="post" enctype="multipart/form-data">
    <label class="l_parcourir" for="parcourir">
        <i class="fa-solid fa-images"></i>
    </label>
    <label class="l_auteur" for="auteur">
        <i class="fa-solid fa-square-plus"></i>
    </label>
    <label class="l_send" for="send">
        <i class="fa-solid fa-cloud-arrow-up"></i>
    </label>

    <input id="send" type="submit" value="Envoyer">
    <input id="auteur" type="text" name="author" placeholder="Auteur">
    <input id="parcourir" type="file" name="photo" accept="image/*">
</form>


<style>
html{
    background: linear-gradient(#7C16A4, #FF00B2);
}
body{
    display: flex;
    flex-direction: column;
    align-items: center;
}
img{
    width: 80%;
}
.scroller{
    width : 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}
i{
    font-size : 9rem;
    color : white;
}
form{
    position : fixed;
    bottom : 20px;
    display : flex;
    flex-direction: row;
    justify-content: space-evenly;
    align-items : center;
    width : 90%;
    align-self : center;
    z-index : 9999;
}
label{
    display: inline-block;
    cursor: pointer;
}
.l_send:checked ~ #send{
    display: block;
}
.l_parcourir:checked ~ #parcourir{
    display: block;
}
.l_auteur:checked ~ #auteur{
    display: block;
}
input{
    display: none;
}


h2{
    font-size : 5rem
}
p{
    font-size : 3rem
}
h2, p{
    color : white;
    margin : 1vh
}