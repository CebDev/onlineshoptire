<?php


class CommandeDAO implements DAO {
    /**
     * @param $id
     * @return Commande|null
     * @throws Exception
     */
    static public function chercher($id){
        $uneCommande = null;
        $listeItemsCommande=array();
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Connexion base de donnee imposible.");
        }
        $requete = $connexion->prepare("SELECT * FROM shrdatabase.commande WHERE id =:unId");
        $requete->bindParam(":unId", $id);
        $requete->execute();
        if ($requete->rowCount() > 0) {
            $enregistrement = $requete->fetch();
            $uneCommande = new Commande($enregistrement['id'], $enregistrement['clientCourriel'], $enregistrement['statut'],$enregistrement['dateCommande'], $enregistrement['dateExpedition'],  $enregistrement['paiement'], array());
            $requete->closeCursor();

            $requete2= $connexion->prepare("SELECT * FROM lignecommande  WHERE commandeID=:unId");
            $requete2->bindParam(":unId", $id);
            $requete2->execute();

            foreach($requete2 as $enregistrement){
                $unItem = ItemDAO::chercher($enregistrement['itemID']);
                $cetItemQuantite=array($unItem, $enregistrement['quantite']);
                array_push($listeItemsCommande,$cetItemQuantite);
            }
            $uneCommande->setItemsCommande($listeItemsCommande);

            $requete2->closeCursor();
        }
        ConnexionDB::close();
        return $uneCommande;
    }

    static public function chercherTous(){
        return self::chercherAvecFiltre("");
    }

    /**
     * @param $filtre
     * @return array des commandes
     * @throws Exception
     */
    static public function chercherAvecFiltre($filtre){
        $commandes = array();
        try {
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e) {
            throw new Exception("Connexion base de donnee imposible.");
        }
        $requete = $connexion->prepare("SELECT * FROM shrdatabase.commande ".$filtre);
        $requete->execute();
        
        if ($requete->rowCount() > 0) {
            foreach ($requete as $enregistrement) {
                $uneCommande = new Commande($enregistrement['id'], $enregistrement['clientCourriel'], $enregistrement['statut'],$enregistrement['dateCommande'], $enregistrement['dateExpedition'],  $enregistrement['paiement'], array());
                
                $requete2 = $connexion->prepare("SELECT * FROM lignecommande  WHERE commandeID=:unId");
                $idCommande = $uneCommande->getId();
                $requete2->bindParam(":unId", $idCommande);
                $requete2->execute();
                $listeItemsCommande=array();
                foreach($requete2 as $enregistrement){
                    $unItem = ItemDAO::chercher($enregistrement['itemID']);
                    $cetItemQuantite=array($unItem, $enregistrement['quantite']);
                    array_push($listeItemsCommande,$cetItemQuantite);
                }
                $uneCommande->setItemsCommande($listeItemsCommande);
                $requete2->closeCursor();
                array_push($commandes,$uneCommande);
            }
        }
        ConnexionDB::close();
        return $commandes;
    }

    /**
     * @param Commande $uneCommande
     * @return Commande|null
     * @throws Exception
     */
    static public function inserer($uneCommande){
        try{
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e){
            throw new Exception("Connexion base de donnee imposible.");
        }

        $requete = $connexion->prepare("INSERT INTO commande  (clientCourriel, dateCommande , dateExpedition, statut, paiement) VALUES (?,?,?,?,?)");
        $isRecorded = $requete->execute(array( $uneCommande->getCourrielClient(),$uneCommande->getDateCommande(), $uneCommande->getDateExpedition(), $uneCommande->getStatut(), $uneCommande->getPaiement()));
        $requete->closeCursor();

        if($isRecorded){
            $last_id = $connexion->lastInsertId();
        }

        foreach ($uneCommande->getItemsCommande() as $unItemQuantite){
            $requete2=$connexion->prepare("INSERT INTO lignecommande (clientCourriel, commandeID, itemID, quantite) VALUES (?,?,?,?)");
            $isRecorded = $requete2->execute(array($uneCommande->getCourrielClient(), $last_id, $unItemQuantite[0]->getIdItem(),$unItemQuantite[1]));
        }
        if($isRecorded){
            return self::chercher($last_id);
        }
        return null;
    }


    /**
     * @param Commande $uneCommande
     * @return bool
     * @throws Exception
     */
    static public function modifier($uneCommande){
        {
            try{
                $connexion = ConnexionDB::getInstance();
            } catch (Exception $e){
                throw new Exception("Connexion base de donnee imposible.");
            }

            if (self::chercher($uneCommande->getId()) != null){
                $sql = 'UPDATE commande SET clientCourriel ="'.$uneCommande->getCourrielClient().'", dateCommande= "'.$uneCommande->getDateCommande().'", dateExpedition= "'.$uneCommande->getDateExpedition().'", statut = "'.$uneCommande->getStatut().'", paiement = "'.$uneCommande->getPaiement().'" WHERE id = "'.$uneCommande->getId().'" ';
                $requete = $connexion->prepare($sql);
                $requete->execute();
                $requete->closeCursor();
                }
                return true;
            }
            return false;

    }

    /**
     * @param Commande $uneCommande
     * @return bool
     * @throws Exception
     */
    static public function supprimer($uneCommande){
        try{
            $connexion = ConnexionDB::getInstance();
        } catch (Exception $e){
            throw new Exception("Connexion base de donnee imposible.");
        }
        // On verifie que la commande que l'on souhaite supprimer existe
        if (self::chercher($uneCommande->getId()) != null){
            $requete = $connexion->prepare("DELETE FROM commande WHERE id =" .$uneCommande->getId());
            $requete->execute();
            foreach ($uneCommande->getItemsCommande() as $itemsIdQuantite){
                foreach($itemsIdQuantite as $itemId=>$quantite){
                    $requete2 = $connexion->prepare("DELETE FROM lignecommande WHERE commandeID =" .$uneCommande->getId());
                    $requete2->execute();
                    $requete2->closeCursor();
                }
            }
            return true;
        }
        return false;
    }


}