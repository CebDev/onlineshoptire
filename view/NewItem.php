<?php $title = "Ajout Item"; ?>

<?php ob_start(); ?>
    <h3 class="titleNewItem">NOUVEL ARTICLE</h3>
    <div class="main-top" id="main-top">
        <div class="left-contain">
            <div class="container">
                <form action="index.php?action=newItem" method="post">
                    <h4 class="compteTitle">INFORMATIONS MODELE</h4>
                    <table>
                        <tr>
                            <th>Manufacturier :</th>
                            <td><select class="inputForm" name="manufacturier">
                                <!-- remplissage du select largeur avec les dimensions disponibles dans la BD -->
                                <?php foreach($controleur->getManufacturier() as $unManufacturier): ?>
                                    <option value="<?= $unManufacturier['nom'] ?>"><?= $unManufacturier['nom'] ?></option>
                                <?php endforeach; ?>
                            </select><br></td>
                        </tr>
                        <tr>
                            <th>Nom du modele :</th>
                            <td><input  required class="inputForm" type="name" name="modeleNom"><br></td>
                        </tr>
                        <tr>
                            <th>Toutes saisons :</th>
                            <td>
                                <input  class="radioBtn" type="radio" name="saison" value="Y" >
                                <img class="iconWeather" src="./view/pictures/icons/rainfull.svg" alt="icone allweather"><br>
                            </td>
                        </tr>
                        <tr>
                            <th>Winter :</th>
                            <td>
                                <input  class="radioBtn" type="radio" name="saison" value="Y" checked>
                            <img class="iconWeather" src="./view/pictures/icons/ice.svg" alt="icone hivers"><br>
                        </td>
                        </tr>
                        <tr>
                            <th class="separationTd">RFT :</th>
                            <td class="separationTd">
                                <input class="radioBtn" type="radio" name="rft" value="Y">YES 
                                <input class="radioBtn" type="radio" name="rft" value="" checked> NO
                                <br>
                            </td>
                        </tr>
                        <tr>
                            <th>Type :</th>
                            <td><input required class="inputForm" type="text" name="typeModele" ><br></td>
                        </tr>
                        <tr>
                            <th>Lien vers image :</th>
                            <td><input class="inputForm" type="url" name="link"><br></td>
                        </tr>
                        <tr>
                            <th>Remise :</th>
                            <td><input class="inputForm" type="text" name="remise"><br></td>
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
                            <td><input required class="inputForm" type="number" name="largeur"><br></td>
                        </tr>
                        <tr>
                            <th>Ratio :</th>
                            <td><input required class="inputForm" type="number" name="ratio"><br></td>
                        </tr>
                        <tr>
                            <th>Diametre :</th>
                            <td><input required class="inputForm" type="number" name="diametre"><br></td>
                        </tr>
                        <tr>
                            <th>Indice Charge :</th>
                            <td><input required class="inputForm" type="number" name="iCharge"><br></td>
                        </tr>
                        <tr>
                            <th>Indice Vitesse :</th>
                            <td><input required class="inputForm" type="name" maxlength="1" name="iVitesse"><br></td>
                        </tr>
                        <tr>
                            <th>Stock :</th>
                            <td><input required class="inputForm" type="number" name="stock"><br></td>
                        </tr>
                        <tr>
                            <th>Prix Unitaire hors remise:</th>
                            <td><input required class="inputForm" type="text" name="prix"><br></td>
                        </tr>
                        
                        <tr>
                            <th></th>
                            <td>
                                 <input class="btn btnAble" type="submit" value="S'enregistrer">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        
        </div>
    </div>


<?php $content = ob_get_clean(); ?> 

<?php require 'template.php';

