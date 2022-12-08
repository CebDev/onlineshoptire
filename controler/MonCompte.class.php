<?php

include_once(DOSSIER_BASE_INCLUDE."controler/Controleur.abstract.class.php");
include_once(DOSSIER_BASE_INCLUDE."model/DAO/ActeurDAO.class.php");

class MonCompte extends Controleur {
    // ******************* Attributs
    private $unActeur;
    private $commandeEnCours = null;

    // ******************* Constructeur qui initialise son parent


    // ******************* Getteurs ******************************
    public function getObjetActeur(){
        return $this->unActeur;
    }

    public function getCommandeEnCours(){
        return $this->commandeEnCours;
    }

	// 		if(isset($_POST['nouveauClient'])){
	// 			var_dump($_POST);
	// 			$this->unActeur = new Acteur(
	// 				'client',
	// 				$_POST['courriel'],
	// 				$_POST['password'],
	// 				$_POST['prenom'],
	// 				$_POST['nom'],
	// 				$_POST['ville'],
	// 				str_replace(' ','',$_POST['codePostal']),
	// 				$_POST['adresse'],
	// 				$_POST['telephone']
	// 			);
	// 			$unActeur = ActeurDAO::inserer($this->unActeur);
	// 		} else if (isset($_POST['nom'])){
	// 			// dans le cas ou la variable $_POST['nom'] existe, cést que l'utilisateur vient dénregistrer des modifications sur ces renseignements
	// 			$this->unActeur->setCourriel($_POST['courriel']);
	// 			$this->unActeur->setNom($_POST['nom']);
	// 			$this->unActeur->setPrenom($_POST['prenom']);
	// 			$this->unActeur->setAdresse($_POST['adresse']);
	// 			$this->unActeur->setVille($_POST['ville']);
	// 			$this->unActeur->setCp($_POST['codePostal']);
	// 			$this->unActeur->setNumtel($_POST['telephone']);
	// 			$this->unActeur->changerMdp($_POST['oldPassword'], $_POST['newPassword']);
	// 			var_dump($this->unActeur);
	// 			var_dump(ActeurDAO::modifier($this->unActeur));
	// 		}
            
	// 		if ($this->unActeur == null){
	// 			header('Location: index.php?erreur=erreurLog');
	// 		} else if($this->unActeur->getType() == 'administrateur'){			
	// 			$this->acteur = "administrateur";
	// 			$_SESSION['connecte'] = $this->unActeur->getType();
	// 			header('Location: index.php?action=administration');
	// 		} else if($this->unActeur->getType() == 'client'){			
    //             $this->acteur = "client";
	// 			$_SESSION['connecte'] = $this->unActeur->getType();
	// 			$_SESSION['courrielClient'] = $this->unActeur->getCourriel();
    //             $vues = "monCompte";
	// 		}
            
	// 		//----------------------------- RETOURNER LE NOM DE LA VUE À APPELER -----
	// 		return $vues;
	// 	}

    //     // inserer recuperation en bd des commandes du client en cours
    //     return null;
    // }

    // ******************* Méthode exécuter action
    public function executerAction() {
        //----------------------------- VÉRIFIER LA VALIDITÉ DE LA SESSION (pas besoin ici) -----------
        //----------------------------- VÉRIFIER LA VALIDITÉ DES POSTS (pas besoin ici) ---------------
        //--------------------------- INTERACTION BD -----------------------------
        if (isset($_SESSION['connecte'])){
            $this->unActeur = ActeurDAO::chercher($_SESSION['courrielClient']);
        } else {
            $this->unActeur = ActeurDAO::chercherParNumeroMotPasse($_POST['courriel'], $_POST['password']);
        }

        if(isset($_POST['nouveauClient'])){
            var_dump($_POST);
            $this->unActeur = new Acteur(
                'client',
                $_POST['courriel'],
                $_POST['password'],
                $_POST['prenom'],
                $_POST['nom'],
                $_POST['ville'],
                str_replace(' ','',$_POST['codePostal']),
                $_POST['adresse'],
                $_POST['telephone']
            );
            $unActeur = ActeurDAO::inserer($this->unActeur);
        } else if (isset($_POST['nom'])){
            // dans le cas ou la variable $_POST['nom'] existe, cést que l'utilisateur vient dénregistrer des modifications sur ces renseignements
            $this->unActeur->setCourriel($_POST['courriel']);
            $this->unActeur->setNom($_POST['nom']);
            $this->unActeur->setPrenom($_POST['prenom']);
            $this->unActeur->setAdresse($_POST['adresse']);
            $this->unActeur->setVille($_POST['ville']);
            $this->unActeur->setCp($_POST['codePostal']);
            $this->unActeur->setNumtel($_POST['telephone']);
            $this->unActeur->changerMdp($_POST['oldPassword'], $_POST['newPassword']);
            var_dump($this->unActeur);
            var_dump(ActeurDAO::modifier($this->unActeur));
        }

        if ($this->unActeur == null){
            header('Location: index.php?erreur=erreurLog');
        } else if($this->unActeur->getType() == 'administrateur'){
            $this->acteur = "administrateur";
            $_SESSION['connecte'] = $this->unActeur->getType();
            header('Location: index.php?action=administration');
        } else if($this->unActeur->getType() == 'client'){
            $this->acteur = "client";
            $_SESSION['connecte'] = $this->unActeur->getType();
            $_SESSION['courrielClient'] = $this->unActeur->getCourriel();
            $this->commandeEnCours = CommandeDAO::chercherAvecFiltre('where clientCourriel ="'.$this->unActeur->getCourriel().'" AND statut="to prepare"');
            $vues = "monCompte";
        }

        //----------------------------- RETOURNER LE NOM DE LA VUE À APPELER -----
        return $vues;
    }



}
