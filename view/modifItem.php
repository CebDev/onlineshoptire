<?php $title = "Ajout Item"; ?>

<?php ob_start(); ?>
    <h3 class="titleNewItem">MODIFIER UN ARTICLE</h3>
    <div class="main-top" id="main-top">
        <div class="left-contain">
            <div class="container">
                <form action="index.php?action=modifItem" method="post">
                    <input type="hidden" name="modif" value="yes">
                    <h4 class="compteTitle">INFORMATIONS MODELE</h4>
                    <table>
                        <tr>
                            <th>Code Item :</th>
                            <td><input type="text" name="idItem" class="inputForm"  value="<?= $controleur->getItemToModify()->getIdItem() ?>"><br></td>
                        </tr>

                        <tr>
                            <th>Manufacturier :</th>
                            <td><input type="text" name="manufacturier" class="inputForm" required value="<?= $controleur->getItemToModify()->getManufacturier() ?>"><br></td>
                        </tr>
                        <tr>
                            <th>Nom du modele :</th>
                            <td><input  required class="inputForm" type="name" name="modeleNom" value="<?= $controleur->getItemToModify()->getModeleNom() ?>"><br></td>
                        </tr>
                        <tr>
                            <th>Toutes saisons :</th>
                            <td>
                                <input  class="radioBtn" type="checkbox" name="allweather" value="<?=$controleur->getItemToModify()->getAllWeather() ?>" >
                                <img class="iconWeather" src="./view/pictures/icons/rainfull.svg" alt="icone allweather"><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Winter :</th>
                            <td>
                                <input  class="radioBtn" type="checkbox" name="winter" value="<?=$controleur->getItemToModify()->getWinter() ?>">
                            <img class="iconWeather" src="./view/pictures/icons/ice.svg" alt="icone hivers"><br>
                        </td>
                        </tr>
                        <tr>
                            <th class="separationTd">RFT :</th>
                            <td class="separationTd">
                                <input class="radioBtn" type="radio" name="rft" value="<?=$controleur->getItemToModify()->getRft() ?>">YES 
                                <input class="radioBtn" type="radio" name="rft" value="<?=$controleur->getItemToModify()->getRft() ?>" checked> NO
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <th>Type :</th>
                            <td><input required class="inputForm" type="text" name="typeModele" value="<?= $controleur->getItemToModify()->getTypeModel() ?>"><br></td>
                        </tr>
                        <tr>
                            <th>Lien vers image :</th>
                            <td><input class="inputForm" type="url" name="link" value="<?= $controleur->getItemToModify()->getPictureLink() ?>"><br></td>
                        </tr>
                        <tr>
                            <th>Remise :</th>
                            <td><input class="inputForm" type="text" name="remise" value="<?= $controleur->getItemToModify()->getRemise() ?>"><br></td>
                        </tr>
                    </table>
                
            </div>
        </div>
        <div class="right-contain">
            <div class="container">            
                <h4 class="compteTitle">SPECIFICATIONS ITEM</h4>
                    <table>
                        <tr>
                            <th>Largeur :</th>
                            <td><input required class="inputForm" type="number" name="largeur" value="<?= $controleur->getItemToModify()->getLargeur() ?>"><br></td>
                        </tr>
                        <tr>
                            <th>Ratio :</th>
                            <td><input required class="inputForm" type="number" name="ratio" value="<?= $controleur->getItemToModify()->getRatio() ?>"><br></td>
                        </tr>
                        <tr>
                            <th>Diametre :</th>
                            <td><input required class="inputForm" type="number" name="diametre" value="<?= $controleur->getItemToModify()->getDiametre() ?>"><br></td>
                        </tr>
                        <tr>
                            <th>Indice Charge :</th>
                            <td><input required class="inputForm" type="number" name="iCharge" value="<?= $controleur->getItemToModify()->getIndiceCharge() ?>"><br></td>
                        </tr>
                        <tr>
                            <th>Indice Vitesse :</th>
                            <td><input required class="inputForm" type="name" maxlength="1" name="iVitesse" value="<?= $controleur->getItemToModify()->getIndiceVitesse() ?>"><br></td>
                        </tr>
                        <tr>
                            <th>Stock :</th>
                            <td><input class="inputForm" type="number" name="stock" value="<?= $controleur->getItemToModify()->getStock() ?>"><br></td>
                        </tr>
                        <tr>
                            <th>Prix Unitaire hors remise:</th>
                            <td><input required class="inputForm" type="text" name="prix" value="<?= $controleur->getItemToModify()->getPrixDeBase() ?>"><br></td>
                        </tr>
                        
                        <tr>
                            <th></th>
                            <td>
                                 <input class="btn btnAble" type="submit" value="Enregistrer modification">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        
        </div>
    </div>


<?php $content = ob_get_clean(); ?> 

<?php require 'template.php';

