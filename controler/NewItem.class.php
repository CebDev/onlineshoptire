<?php

	include_once(DOSSIER_BASE_INCLUDE."controler/Controleur.abstract.class.php");
    include_once(DOSSIER_BASE_INCLUDE."model/DAO/ItemDAO.class.php");
    include_once(DOSSIER_BASE_INCLUDE."model/DAO/ModeleDAO.class.php");

	class NewItem extends Controleur {
        // ******************* Attributs 
		private $tabManufacturier;
		private $nouveauModele;
		private $nouvelItem;
		private $message="''";
        // ******************* Constructeur qui initialise son parent
		public function __construct(){
			parent::__construct();
		}

        // ******************* Getteurs ******************************
        public function getManufacturier(){
			return $this->tabManufacturier;
		}
        // ******************* Méthode exécuter action

        /**
         * @return string
         * @throws Exception
         */
        public function executerAction(){
            $this->tabManufacturier = ItemDAO::remplirSelectManufacturier();
			//----------------------------- VÉRIFIER LA VALIDITÉ DE LA SESSION -----------
			if($this->acteur != 'administrateur'){
                header('Location: index.php');
            }
            //--------------------------- INTERACTION BD -----------------------------
            if(ISSET($_POST['typeModele'])){
                $this->message = "Le modele na pas pu etre ajouter a la base de donnee ";
                $this->nouveauModele=new Modele(
                    -1,
                    $_POST['manufacturier'],
                    $_POST['modeleNom'],
                    $_POST['saison'],
                    $_POST['saison'],
                    $_POST['rft'],
                    $_POST['typeModele'],
                    $_POST['link']
                );
                $modeleInserer=ModeleDAO::inserer($this->nouveauModele);

                $_POST['prix'] = str_replace(',', '.',$_POST['prix']);

                if($modeleInserer!=null) {
                    $this->nouvelItem = new Item(-1,
                        $modeleInserer->getIdModel(),
                        $modeleInserer->getManufacturier(),
                        $modeleInserer->getModeleNom(),
                        $modeleInserer->getWinter(),
                        $modeleInserer->getRft(),
                        $modeleInserer->getAllWeather(),
                        $modeleInserer->getTypeModel(),
                        $modeleInserer->getPictureLink(),
                        (int)$_POST['largeur'],
                        (int)$_POST['ratio'],
                        (int)$_POST['diametre'],
                        (int)$_POST['iCharge'],
                        $_POST['iVitesse'],
                        floatval($_POST['prix']),
                        (int)$_POST['stock'],
                        (int)$_POST['remise']
                    );
                    var_dump($this->nouvelItem);
                    $itemInserer = ItemDAO::inserer($this->nouvelItem);
                    if ($itemInserer == false) {
                       $this->message="Erreur: item impossible à ajouter";
                    } else {
                        $this->message= "Le nouvel item a été ajouté avec succès";
                    }
                }
                else{$this->message="Veuillez entrez un nom de modele valide et qui est non existant";}
            }
            echo "<script type='text/javascript'>alert('$this->message');</script>";
			//----------------------------- RETOURNER LE NOM DE A VUE À APPELER -----
			return 'NewItem';

        }
    }