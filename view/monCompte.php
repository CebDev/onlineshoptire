<?php $title = "SHR Mon compte"; ?>
<?php ob_start(); ?>
    <div class="main-top" id="main-top">
        <div class="left-contain">
            <div class="container">
                <form class="formulaireCompte" action="index.php?action=monCompte" method="post">
                    <h4 class="compteTitle">VERIFIER VOS INFORMATIONS</h4>
                    <table>
                        <tr>
                            <th>Nom :</th>
                            <td><label>
                                    <input type="text" name="nom" value="<?= $controleur->getObjetActeur()->getNom() ?>" required>
                                </label><br></td>
                        </tr>
                        <tr>
                            <th>Prénom :</th>
                            <td><label>
                                    <input type="text" name="prenom" value="<?= $controleur->getObjetActeur()->getPrenom() ?>" required>
                                </label><br></td>
                        </tr>
                        <tr>
                            <th>Adresse :</th>
                            <td><label>
                                    <input type="text" name="adresse" value="<?= $controleur->getObjetActeur()->getAdresse() ?>" required>
                                </label><br></td>
                        </tr>
                        <tr>
                            <th>Code postal :</th>
                            <td><label>
                                    <input type="text" name="codePostal" value="<?= $controleur->getObjetActeur()->getCp() ?>" required>
                                </label><br></td>
                        </tr>
                        <tr>
                            <th>Ville :</th>
                            <td><label>
                                    <input type="text" name="ville" value="<?= $controleur->getObjetActeur()->getVille() ?>" required>
                                </label><br></td>
                        </tr>
                        <tr>
                            <th>Telephone :</th>
                            <td><input type="tel" name="telephone" value="<?= $controleur->getObjetActeur()->getNumTel() ?>" required><br></td>
                        </tr>
                        <tr>
                            <th>Courriel :</th>
                            <td><label>
                                    <input type="text" name="courriel" value="<?= $controleur->getObjetActeur()->getCourriel() ?>" required>
                                </label><br></td>
                        </tr>
                        <tr>
                            <th>Nouveau mot passe :</th>
                            <td><label>
                                    <input type="password" id="newPassword" name="newPassword" value="" pattern=".{6,}" onchange="newPwdSet()">
                                </label><br></td>
                        </tr>
                        <tr>
                            <th>Confirmer :</th>
                            <td><label>
                                    <input type="password" id="newPasswordConfirmation" name="newPasswordConfirmation" value="" pattern=".{6,}" onkeyup="checkConfirmPassword()">
                                </label><br></td>
                        </tr>
                        <tr>
                            <th>Ancien mot de passe :</th>
                            <td><label>
                                    <input type="password" name="oldPassword" value="" pattern=".{6,}">
                                </label><br></td>
                        </tr>
                        <tr>
                            <th colspan="2">
                                <input id="btnModifCompte" class="btn btnDisabled" disabled type="submit" value="Enregistrer Modification">
                            </th>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
        <div class="right-contain">
            <div class="container">
                <h4 class="compteTitle">COMMANDES EN COURS</h4>
                <?php if ($controleur->getCommandeEnCours() == null): ?>
                    <h3>Aucune commande en cours</h3>
                <?php else: ?>
                    <table>
                        <?php foreach($controleur->getCommandeEnCours() as $commande): ?>
                            <tr>
                                <th colspan="2" >Commande #<?=$commande->getId()?> du <?=$commande->getDateCommande()?> </th>
                            </tr>
                            <?php foreach($commande->getItemsCommande() as $item): ?>
                                <tr>
                                    <th>Article</th>
                                    <td><?= $item[0]->getManufacturier()." ".$item[0]->getModeleNom()." - ".$item[0]->getSize()." X ".$item[1] ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <th>Statut</th>
                                <td>en préparation</td>
                            </tr>
                            <tr>
                                <th>Prix</th>
                                <td>
                                    <?= round($commande->getPaiement()*1.15,2) ?> $
                                </td>

                            </tr>
                        <?php endforeach; ?>
                    </table>
                <?php endif; ?>
            </div>

        </div>
    </div onload="checkConfirmPassword()">


<?php $content = ob_get_clean(); ?>

<?php require 'template.php';
