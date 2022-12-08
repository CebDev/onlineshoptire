<?php

	include_once(DOSSIER_BASE_INCLUDE."controler/Controleur.abstract.class.php");


	class AdminCommande extends Controleur {
		// ******************* Attributs 
		private $commandeClients = array();

        // ******************* Constructeur qui initialise son parent
		public function __construct(){
			parent::__construct();
		}

		// ******************* Getteurs ******************************
		public function getCommandeClients(){
			return $this->commandeClients ; 
		}
        
        // ******************* Méthode exécuter action
		public function executerAction() {
			if($this->acteur != 'administrateur'){
                header('Location: index.php');
            }
			//----------------------------- VÉRIFIER LA VALIDITÉ DE LA SESSION (pas besoin ici) -----------
			//----------------------------- VÉRIFIER LA VALIDITÉ DES POSTS (pas besoin ici) ---------------
			if(isset($_POST['idCommande'])){
				date_default_timezone_set("America/New_York");
				$commande = CommandeDAO::chercher($_POST['idCommande']);
				$commande->setDateExpedition(date("Y-m-d H:i:s"));
				$commande->setStatut('send');
				CommandeDAO::modifier($commande);
			}
			//--------------------------- INTERACTION BD -----------------------------
			$this->commandeClients = CommandeDAO::chercherAvecFiltre("ORDER BY dateCommande DESC"); 
			//----------------------------- RETOURNER LE NOM DE LA VUE À APPELER -----
			return 'adminCommande';
        }
    }