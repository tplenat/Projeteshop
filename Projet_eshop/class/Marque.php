<?php

class Marque {

    private $id;
    private $nom;
    private $logo;
    private $collectionProduit = array();
    private static $select = "select * from marque";
    private static $selectById = "select * from marque where id = :id";
   private static $selectByIdCategorie= "select distinct nom,id,logo from marque inner join produit on id = idMarque"
           . " where idCategorie = :idCategorie";

    public function compareTo(Marque $marque) {
        return $this->id == $marque->id;
    }

  
 

    public static function fetchAll() {
        $collectionMarque = Array();
        $dba = new DBA();
        $pdo = $dba->getPDO();
        $pdoStatement = $pdo->query(Marque::$select);
        $recordSet = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($recordSet as $record) {
            $collectionMarque[] = Marque::arrayToMarque($record);
        }
        return $collectionMarque;
    }
    
   public static function fetchAllByCategorie(Categorie $categorie) {
        $idCategorie = $categorie->getIdCategorie();
        $collectionMarque = array();
        $pdo = (new DBA())->getPDO();
        $pdoStatement = $pdo->prepare(Marque::$selectByIdCategorie);
        $pdoStatement->bindParam(":idCategorie", $idCategorie);
        $pdoStatement->execute();
        $recordSet = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($recordSet as $record) {
            $collectionMarque[] = Marque::arrayToMarque($record);
        }
        return $collectionMarque;
    }
    
   
    
   
    public static function fetch($id) {
        $dba = new DBA();
        $pdo = $dba->getPDO();
        $pdoStatement = $pdo->prepare(Marque::$selectById);
        $pdoStatement->bindParam(":id", $id);
        $pdoStatement->execute();
        $record = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        $marque = Marque::arrayToMarque($record);
        return $marque;
    }
    
    public static function arrayToMarqueN(Array $array) {
        $m = new Marque();
        
        $m->nom = $array["nom"];
        
        
        return $m;
    }

  
    

    public static function arrayToMarque(Array $array) {
        $m = new Marque();
        $m->id = $array["id"];
        $m->nom = $array["nom"];
        $m->logo = $array["logo"];
        $m->collectionProduit = Produit::fetchAllByMarque($m);
        return $m;
    }


  

    

    

    

    public function getIdMarque() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getLogo() {
        return $this->logo;
    }

    public function setNom($nom): void {
        $this->nom = $nom;
    }

    public function setLogo($logo): void {
        $this->logo = $logo;
    }

}
