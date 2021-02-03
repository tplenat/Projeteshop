<?php

class Produit {

    private $idProduit;
    private $libelle;
    private $description;
    private $prix;
    private $image;
    private $categorie; // objet de classe categorie
    private $marque; // objet de classe categorie
    private static $selectByIdCategorie = "select * from produit where idCategorie = :idCategorie";
    private static $selectByIdMarque = "select * from produit where idMarque = :id";
    private static $select = "select * from produit";
    private static $selectById = "select * from produit where idProduit = :idProduit";
    private static $insert = "insert into produit (libelle,description,image,prix,idCategorie) values (:libelle,:description,:image,:prix,:idCategorie)";
    private static $update = "update produit set libelle=:libelle,description=:description,image=:image,prix=:prix,idCategorie=:idCategorie where idProduit=:idProduit";
    private static $delete = "delete from produit where idProduit =:idProduit";

    public function compareTo(Produit $produit) {
        return $produit->idProduit == $this->idProduit;
    }
    

    public static function fetchAllByCategorie(Categorie $categorie) {
        $idCategorie = $categorie->getIdCategorie();
        $collectionProduit = array();
        $pdo = (new DBA())->getPDO();
        $pdoStatement = $pdo->prepare(Produit::$selectByIdCategorie);
        $pdoStatement->bindParam(":idCategorie", $idCategorie);
        $pdoStatement->execute();
        $recordSet = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($recordSet as $record) {
            $collectionProduit[] = Produit::arrayToProduitC($record,
                            $categorie);
        }
        return $collectionProduit;
    }
    
    public static function fetchAllByMarque(Marque $marque) {
        $idmarque = $marque->getIdMarque();
        $collectionProduit = array();
        $pdo = (new DBA())->getPDO();
        $pdoStatement = $pdo->prepare(Produit::$selectByIdMarque);
        $pdoStatement->bindParam(":id", $idmarque);
        $pdoStatement->execute();
        $recordSet = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($recordSet as $record) {
            $collectionProduit[] = Produit::arrayToProduitM($record, $marque);
        }
        return $collectionProduit;
    }

    public static function fetchAll() {
        $collectionProduit = Array();
        $dba = new DBA();
        $pdo = $dba->getPDO();
        $pdoStatement = $pdo->query(Produit::$select);
        $recordSet = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($recordSet as $record) {
            $collectionProduit[] = Produit::arrayToProduitC($record);
        }
        return $collectionProduit;
    }

    public static function fetch($idProduit) {
        $dba = new DBA();
        $pdo = $dba->getPDO();
        $pdoStatement = $pdo->prepare(Produit::$selectById);
        $pdoStatement->bindParam(":idProduit", $idProduit);
        $pdoStatement->execute();
        $record = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        $produit = Produit::arrayToProduit($record);
        return $produit;
    }

    private static function arrayToProduitC(Array $array, Categorie
            $categorie = null) {
        $p = new Produit();
        $p->idProduit = $array["idProduit"];
        $p->libelle = $array["libelle"];
        $p->description = $array["description"];
        $p->image = $array["image"];
        $p->prix = $array["prix"];
        
        if ($categorie == null) {
            if ($array["idCategorie"] != null) {
                $p->categorie = Categorie::fetch($array["idCategorie"]);
            } else {
                $p->categorie = null;
            }
        } else {
            $p->categorie = $categorie;
        }
        
        return $p;
    }
    
    
    private static function arrayToProduitM(Array $array,  Marque $marque = null) {
        $p = new Produit();
        $p->idProduit = $array["idProduit"];
        $p->libelle = $array["libelle"];
        $p->description = $array["description"];
        $p->image = $array["image"];
        $p->prix = $array["prix"];
        $p->categorie= Categorie::fetch($array["idCategorie"]);
        if ($marque == null) {
            if ($array["idMarque"] != null) {
                $p->marque = Marque::fetch($array["idMarque"]);
            } else {
                $p->marque = null;
            }
        } else {
            $p->marque = $marque;
        }
        
        return $p;
    }

    public function save() {
        if ($this->idProduit == null) {
            $this->insert();
        } else {
            $this->update();
        }
    }

    private function insert() {
        $dba = new DBA();
        $pdo = $dba->getPDO();
        $pdoStatement = $pdo->prepare(Produit::$insert);
        $pdoStatement->bindParam(":libelle", $this->libelle);
        $pdoStatement->bindParam(":description", $this->description);
        $pdoStatement->bindParam(":image", $this->image);
        $pdoStatement->bindParam(":prix", $this->prix);
        if ($this->categorie != null) {
            $idCategorie = $this->categorie->getIdCategorie();
        }
        $pdoStatement->bindParam(":idCategorie", $idCategorie);
        if ($this->marque != null) {
            $id = $this->marque->getIdMarque();
        }
        $pdoStatement->bindParam(":idMarque", $idMarque);
        $pdoStatement->execute();
        $this->idProduit = $pdo->lastInsertId();
    }

    private function update() {
        $dba = new DBA();
        $pdo = $dba->getPDO();
        $pdoStatement = $pdo->prepare(Produit::$update);
        $pdoStatement->bindParam(":idProduit", $this->idProduit);
        $pdoStatement->bindParam(":libelle", $this->libelle);
        $pdoStatement->bindParam(":description", $this->description);
        $pdoStatement->bindParam(":image", $this->image);
        $pdoStatement->bindParam(":prix", $this->prix);
        if ($this->categorie != null) {
            $idCategorie = $this->categorie->getIdCategorie();
        }
        $pdoStatement->bindParam(":idCategorie", $idCategorie);
        if ($this->marque != null) {
            $idMarque = $this->marque->getIdMarque();
        }
        $pdoStatement->bindParam(":idMarque", $idMarque);
        $pdoStatement->execute();
      
    }

    public function delete() {
        $pdo = (new DBA())->getPDO();
        $pdoStatement = $pdo->prepare(Produit::$delete);
        $pdoStatement->bindParam("idProduit", $this->idProduit);
        $resultat = $pdoStatement->execute();
        $nblignesAffectees = $pdoStatement->rowCount();
        if ($nblignesAffectees == 1) {
            $this->getCategorie()->removeProduit($this);
            $this->idProduit = null;
        }
        return $resultat;
    }

    public function setCategorie(Categorie $categorie = null) {
        $this->categorie = $categorie;
        if ($categorie != null) {
            $categorie->addProduit($this);
        }
    }

    public function getCategorie() {
        return $this->categorie;
    }
    
    public function getMarque() {
        return $this->marque;
    }

    public function getIdProduit() {
        return $this->idProduit;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getPrix() {
        return $this->prix;
    }

    public function getImage() {
        return $this->image;
    }

    public function setLibelle($libelle): void {
        $this->libelle = $libelle;
    }

    public function setDescription($description): void {
        $this->description = $description;
    }

    public function setPrix($prix): void {
        $this->prix = $prix;
    }

    public function setImage($image): void {
        $this->image = $image;
    }

}
