<div id="paiement-container">
    <div class="paiement-contain">
        <a href="#" onclick="document.getElementById('paiement-container').style.display = 'none'">X</a>
        <div class="recapPanier">
            <table>
                <tr>
                    <th class="recapPanierTableTitle" colspan="2">Récapitulatif Paiement</th>
                </tr>
                <tr>
                    <th>Livraison</th>
                    <td>OFFERTE</td>
                </tr>
                <tr>
                    <th>Taxes</th>
                    <td><?= $controleur->getTotalPanier() * 0.15 ?> $</td>
                </tr>
                <tr>
                    <th>Total a payer</th>
                    <td><?= $controleur->getTotalPanier() * 1.15 ?> $</td>
                </tr>
            </table>
        </div>
        <div class="paiementCarte">
            <form action="index.php?action=validation" method="post">
                <table>
                    <tr>
                        <th class="paiementCarteTitle" colspan="2">Paiement Carte</th>
                    </tr>
                    <tr>
                        <td><input type="radio" name="visa" checked>Visa</td>
                        <td><input type="radio" name="visa">MasterCard</td>
                    </tr>
                    <tr>
                        <th><label for="visa">Nom sur la carte :</label></th>
                        <td><input class="inputLong" type="input" name="visa"  title="saisir le nom du porteur de la carte" placeholder="saisir le nom du porteur de la carte" required</td>
                    </tr>
                    <tr>
                        <th><label for="numVisa">Numéro de la carte :</label></th>
                        <td><input class="inputLong" type="input" name="numVisa"  title="saisir les 16 caractères" placeholder="XXXX-XXXX-XXXX-XXXX" pattern="\d{4}-\d{4}-\d{4}-\d{4}" required></td>
                    </tr>
                    <tr>
                        <th><label for="expiration">Date d'expiration :</label></th>
                        <td><input id="inputDateExpiration" type="tel" name="dateExpiration" placeholder="MM/YY" pattern="(1[0-2]|0[1-9])\/\d\d" data-valid-example="11/18" title="format souhaité MM/YY" required></td>
                    </tr>
                    <tr>
                        <th><label for="verifCode">Code vérification :</label></th>
                        <td><input id="inputCodeVerif" type="tel" name="verifCode" placeholder="XXX" pattern="\d{3}" title="code de 3 chiffres" required></td>
                    </tr>
                    <tr>
                        <td  colspan="2"><input class="btn btnAble" type="submit" value="Payer"></td>
                    </tr>
                </table>
            </form>
        </div>
    </div> 
</div>