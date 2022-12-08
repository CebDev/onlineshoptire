<?php $title = "SHR Inscription"; ?>
<?php ob_start(); ?>
    
            <div class="containerFormNewCustomer" >
                <form class="formulaireCompte" action="index.php?action=monCompte" method="post">
                    <input type="hidden" name="nouveauClient" value="nouveauClient">
                    <h4 class="compteTitle">Saisissez VOS INFORMATIONS</h4>
                    <table>
                        <tr>
                            <th>Nom :</th>
                            <td><input class="inputForm" type="text" name="nom" required><br></td>
                        </tr>
                        <tr>
                            <th>Prénom :</th>
                            <td><input class="inputForm" type="text" name="prenom" required><br></td>
                        </tr>
                        <tr>
                            <th>Adresse :</th>
                            <td><input class="inputForm" type="text" name="adresse" required><br></td>
                        </tr>
                        <tr>
                            <th>Code postal :</th>
                            <td><input class="inputForm" type="text" name="codePostal" required><br></td>
                        </tr>
                        <tr>
                            <th>Ville :</th>
                            <td><input class="inputForm" type="text" name="ville" required><br></td>
                        </tr>
                        <tr>
                            <th>Telephone :</th>
                            <td><input class="inputForm" type="text" name="telephone" required><br></td>
                        </tr>
                        <tr>
                            <th>Courriel :</th>
                            <td><input class="inputForm" type="mail" name="courriel" required><br></td>
                        </tr>
                        <tr>
                            <th>Nouveau mot passe :</th>
                            <td><input id="nouveauComptePassword" class="inputForm" type="password" name="password" pattern=".{6,}" required><br></td>
                        </tr>
                        <tr>
                            <th>Confirmer :</th>
                            <td><input
                            id="nouveauCompteConfirmPassword" class="inputForm" type="password" name="PasswordConfirmation" pattern=".{6,}" required><br></td>
                        </tr>
                        <tr>
                            <th></th>
                            <td>
                                <input id="btnSubmit" class="btn btnAble" type="submit" value="S'enregistrer"
                                disabled=true >
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
    </div >

    
<?php $content = ob_get_clean(); ?>

<?php require 'template.php';