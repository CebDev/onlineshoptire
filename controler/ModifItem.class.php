<?php

	include_once(DOSSIER_BASE_INCLUDE."controler/Controleur.abstract.class.php");


	class ModifItem extends Controleur {
        // ******************* Attributs 
        private $tabManufacturier;
        private $itemToModify;
        // ******************* Constructeur qui initialise son parent
		public function __construct(){
			parent::__construct();
		}

        // ******************* Getteurs ******************************
        public function getManufacturier(){
			return $this->tabManufacturier;
        }
        
        public function getItemToModify(){
            return $this->itemToModify;
        }

        // ******************* Méthode exécuter action
		public function executerAction() {
            if($this->acteur != 'administrateur'){
                header('Location: index.php');
            }

        $this->tabManufacturier = ItemDAO::remplirSelectManufacturier();

        $this->itemToModify = ItemDAO::chercher($_POST['idItem']);

		//----------------------------- VÉRIFIER LA VALIDITÉ DE LA SESSION (pas besoin ici) -----------
		//----------------------------- VÉRIFIER LA VALIDITÉ DES POSTS (pas besoin ici) ---------------
		//--------------------------- INTERACTION BD -----------------------------
        if (isset($_POST['modif'])){
            $idModele = ModeleDAO::chercherAvecFiltre(" WHERE modeleNom = '".$_POST['modeleNom']."'");
            $this->itemToModify->setManufacturier($_POST['manufacturier']);
            $this->itemToModify->setModeleNom($_POST['modeleNom']);
            $this->itemToModify->setRft($_POST['rft']);

            $idModele[0]->setManufacturier($_POST['manufacturier']);
            $idModele[0]->setModeleNom($_POST['modeleNom']);
            $idModele[0]->setRft($_POST['rft']);

            $this->itemToModify->setLargeur($_POST['largeur']);
            $this->itemToModify->setRatio($_POST['ratio']);
            $this->itemToModify->setDiametre($_POST['diametre']);
            $this->itemToModify->setIndiceCharge($_POST['iCharge']);
            $this->itemToModify->setIndiceVitesse($_POST['iVitesse']);

            $this->itemToModify->setPrixDeBase($_POST['prix']);
            $this->itemToModify->setStock($_POST['stock']);

            $idModele = ModeleDAO::chercherAvecFiltre(" WHERE modeleNom = '".$_POST['modeleNom']."'");

            ModeleDAO::modifier($idModele[0]);
            ItemDAO::modifier($this->itemToModify);
                
            }
            //----------------------------- RETOURNER LE NOM DE LA VUE À APPELER -----
			return 'modifItem';
        }
    }