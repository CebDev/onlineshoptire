<?php $title = "Administration"; ?>

<?php ob_start(); ?>
    <div class="conteneurMenuAdmin">
        <div class="contenuMenuAdmin">
        <a href="index.php?action=newItem"><button class="btn btnAble">Ajouter Article</button></a>
        <hr>
        <form action="index.php?action=modifItem" method="POST">
            <label for="idItem">Saisir code article </label>
            <input type="text" name="idItem" required>
            <input type="submit" value="Chercher article" class="btn btnAble">
        </form>
        <hr>
        <a href="index.php?action=adminCommande"><button class="btn btnAble">Commande preparation</button></a>
        </div>
    </div>
<?php $content = ob_get_clean(); ?> 

<?php require 'template.php';

