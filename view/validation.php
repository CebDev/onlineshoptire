<?php $title = "Commande Valide"; ?>

<?php ob_start(); ?>

    <div class="panier-vide">
        <h3>Votre commande #<?=$controleur->getIdCommande()?> est validée.<br>Merci</h3>
            <a href="index.php"><button class="btn backgroundRed">Retour à l'accueil</button></a>
    </div>


<?php $content = ob_get_clean(); ?> 

<?php require 'template.php';
