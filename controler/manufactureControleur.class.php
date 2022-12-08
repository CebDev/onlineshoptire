<?php
	include_once(DOSSIER_BASE_INCLUDE."controler/Defaut.class.php");
	include_once(DOSSIER_BASE_INCLUDE."controler/Resultat.class.php");
	include_once(DOSSIER_BASE_INCLUDE."controler/Panier.class.php");
	include_once(DOSSIER_BASE_INCLUDE."controler/MonCompte.class.php");
	include_once(DOSSIER_BASE_INCLUDE."controler/Deconnexion.class.php");
	include_once(DOSSIER_BASE_INCLUDE."controler/NouveauCompte.class.php");
	include_once(DOSSIER_BASE_INCLUDE."controler/Administration.class.php");
	include_once(DOSSIER_BASE_INCLUDE."controler/NewItem.class.php");
	include_once(DOSSIER_BASE_INCLUDE."controler/Validation.class.php");
	include_once(DOSSIER_BASE_INCLUDE."controler/AdminCommande.class.php");
	include_once(DOSSIER_BASE_INCLUDE."controler/ModifItem.class.php");
	
	class ManufactureControleur {
		//  Méthode qui crée une instance du controleur associé à l'action
		//  et le retourne, si l'action n'est pas reconnu on crée un controleur
		//  de type défaut 
		public static function creerControleur($action) {
			if ($action == 'resultatRecherche'){
				return new Resultat();
			} else if ($action == 'panier'){
				return new Panier();
			} else if ($action == 'monCompte'){
				return new MonCompte();
			} else if ($action == 'nouveauCompte'){
					return new NouveauCompte();
			} else if ($action == 'deconnexion'){
				return new Deconnexion();
			} else if ($action == 'administration'){
				return new Administration();
			} else if ($action == 'newItem'){
				return new NewItem();
			} else if ($action == 'validation'){
				return new Validation();
			} else if ($action == 'adminCommande'){
				return new AdminCommande();
			} else if ($action == 'modifItem'){
					return new ModifItem();
			} else {
				return new Defaut();
			}
		}
	}