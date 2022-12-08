<?php $title = "Administration"; ?>

<?php ob_start(); ?>
  
<div class="conteneurCommandesClient">
   <table class="tableauCommande">
      <tr>
         <th class="compteTitle" colspan="10"><h2> Commande à preparer </h2></th>
      </tr>
      <?php foreach($controleur->getCommandeClients() as $commande): ?>
         <form action="index.php?action=adminCommande" method="post">
         <input type="hidden" name="idCommande" value=<?=$commande->getId()?>>
         <tr>
            <th class="commandeResume"colspan="10">Commande #<?= $commande->getId() ?> du <?= $commande->getDateCommande() ?> </th>
         </tr>
            <?php foreach($commande->getItemsCommande() as $item):?> 
            <tr>
               <th>Code Item</th>
               <td><?= $item[0]->getIdItem(); ?></td>
               <th>Manufacturier</th>
               <td><?= $item[0]->getManufacturier(); ?></td>
               <th>Modèle</th>
               <td><?= $item[0]->getModeleNom(); ?></td>
               <th>Size</th>
               <td><?= $item[0]->getSize(); ?></td>
               <th>Quantité</th>
               <td><?= $item[1] ?></td>
               
            </tr>
            <?php endforeach; ?>
            <td colspan="10">
            <?php if($commande->getStatut() == "send"): ?>
               <h3>commande expédié le <?= $commande->getDateExpedition() ?></h3>
            <?php else: ?>
               <input class="btn btnAble" type="submit" value="Expédier">
            <?php endif; ?>
            </td>
            </form>
         <?php endforeach; ?>
         <table>
      
</div>

<?php $content = ob_get_clean(); ?> 

<?php require 'template.php';
