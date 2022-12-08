<?php

//include_once 'enum.class.php';

class Commande{
    private $id;
    private $courrielClient;
    private $dateCommande;
    private $dateExpedition;
    private $itemsCommande=array();
    private $statut;
    private $paiement;

    /**
     * Construit une commande a partir des attributs fournits
     * @param int $id l'ID de la commande dans la BD
     * @param String $courrielClient le courriel du client dans la bd
     * @param String $statut le statut de la commande
     * @param DateTime $dateCommande date de la commande
     * @param DateTime $dateExpedition date d'expedition
     * @param string $paiement type de paiement de la commande
     * @param $itemsCommande
     */
    public function __construct($id, $courrielClient,$statut, $dateCommande, $dateExpedition, $paiement, $itemsCommande){
        $this->id=$id;
        $this->courrielClient=$courrielClient;
        $this->statut=$statut;
        $this->dateCommande=$dateCommande;
        $this->dateExpedition=$dateExpedition;
        $this->paiement=$paiement;
        $this->itemsCommande=$itemsCommande;
    }

    /**
     * @return int
     */
    public function getId(): int{
        return $this->id;
    }

    /**
     * @return String
     */
    public function getCourrielClient(): String{
        return $this->courrielClient;
    }

    /**
     * @return DateTime
     */
    public function getDateExpedition()
    {
        return $this->dateExpedition;
    }


    /**
     * @return array
     */
    /**
     * @return array
     */
    public function getItemsCommande(): array{
        return $this->itemsCommande;
    }

    /**
     * @return String
     */
    public function getStatut(): String{
        return $this->statut;
    }

    /**
     * @param String $statut
     */
    public function setStatut(String $statut): void{
        $this->statut = $statut;
    }

    /**
     * @return mixed
     */
    public function getPaiement(){
        return $this->paiement;
    }

    /**
     * @return mixed
     */
    public function getDateCommande(){
        return $this->dateCommande;
    }


    /**
     * @param array $itemsCommande
     */
    public function setItemsCommande(array $itemsCommande): void
    {
        $this->itemsCommande = $itemsCommande;
    }

    /**
     * @param DateTime $dateExpedition
     */
    public function setDateExpedition($dateExpedition): void
    {
        $this->dateExpedition = $dateExpedition;
    }

    /**
     * @param DateTime $dateCommande
     */
    public function setDateCommande(DateTime $dateCommande): void
    {
        $this->dateCommande = $dateCommande;
    }

    /**
     * @param string $paiement
     */
    public function setPaiement(string $paiement): void
    {
        $this->paiement = $paiement;
    }

}