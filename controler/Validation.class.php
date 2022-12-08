<?php

    include_once(DOSSIER_BASE_INCLUDE."controler/Controleur.abstract.class.php");
    include_once(DOSSIER_BASE_INCLUDE."model/Commande.class.php");
    include_once(DOSSIER_BASE_INCLUDE."model/DAO/CommandeDAO.class.php");

	class Validation extends Controleur {

        // ******************* Attributs 
        private $tabItem = array();
        private $idCommande;
        // ******************* Constructeur qui initialise son parent
		
        // ******************* Getteurs ******************************
        public function getIdCommande(){
            return $this->idCommande;
        }
        // ******************* Méthode exécuter action
		public function executerAction() {
            
            //----------------------------- VÉRIFIER LA VALIDITÉ DE LA SESSION -----------
            if (isset($_SESSION['connecte']) && $_SESSION['connecte'] == 'client'){
                $this->acteur = 'client';
                $this->genererTabItem();
            } else {
                header("Location: index.php");
            }
			//----------------------------- VÉRIFIER LA VALIDITÉ DES POSTS (pas besoin ici) ---------------
            //--------------------------- INTERACTION BD -----------------------------
            date_default_timezone_set("America/New_York");
            $uneCommande = new Commande(-1, $_SESSION['courrielClient'], "to prepare", date("Y-m-d H:i:s"), date("1111-11-11 11:11:11"), $this->getTotalPanier(), $this->tabItem);

            $uneCommande = CommandeDAO::inserer($uneCommande);

            // récupération de la commande dans la bd
            $this->idCommande = $uneCommande->getId();
            // mise à jour du stock de chaque item constituant la commande
            foreach($this->tabItem as $item){
                $item[0]->deduireStock($item[1]);
                ItemDAO::modifier($item[0]);
            }
            // effacement du panier
            unset($_SESSION['panier']);
			//----------------------------- RETOURNER LE NOM DE LA VUE À APPELER -----
			return 'validation';
        }

        /**
         * Methode qui remplit un tableau avec les items contenus dans le panier
         */
        public function genererTabItem(){
            $this->tabItem = array();
            foreach($_SESSION['panier'] as $item){
                array_push($this->tabItem, Array(ItemDAO::chercher($item[0]), $item[1]));
            }
        }

        /**
         * Methode qui à partir du panier calcul le montant total du panier avant taxe
         * @return float le montant total du panier
         */
        public function getTotalPanier(){
            $totalPanier = 0;
            foreach($_SESSION['panier'] as $item){
                $totalPanier += (ItemDAO::chercher($item[0]))->getPrixDeVente() * $item[1];
            }
            return $totalPanier;
        }
    }