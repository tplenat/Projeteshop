<?php

class Categorie {

    private $idCategorie;
    private $libelle;
    private $image;
    private $collectionProduit = array();
    private static $select = "select * from categorie";
    private static $selectById = "select * from categorie where idCategorie = :idCategorie";
    private static $insert = "insert into categorie (libelle,image) values (:libelle,:image)";
    private static $update = "update categorie set libelle=:libelle,image=:image where idCategorie=:idCategorie";
    private static $delete = "delete from categorie where idCategorie =:idCategorie";

    public function compareTo(Categorie $categorie) {
        return $this->idCategorie == $categorie->idCategorie;
    }

    private function existProduit(Produit $produit) {
        $existe = false;
        foreach ($this->collectionProduit as $produitCourant) {
            if ($produit->compareTo($produitCourant)) {
                $existe = true;
                break;
            }
        }
        return $existe;
    }

    private function saveProduits() {
        foreach ($this->collectionProduit as $produit) {
            $produit->save();
        }
    }

    public static function fetchAll() {
        $collectionCategorie = Array();
        $dba = new DBA();
        $pdo = $dba->getPDO();
        $pdoStatement = $pdo->query(Categorie::$select);
        $recordSet = $pdoStatement->fetchAll(PDO::FETCH_ASSOC);
        foreach ($recordSet as $record) {
            $collectionCategorie[] = Categorie::arrayToCategorie($record);
        }
        return $collectionCategorie;
    }

    public static function fetch($idCategorie) {
        $dba = new DBA();
        $pdo = $dba->getPDO();
        $pdoStatement = $pdo->prepare(Categorie::$selectById);
        $pdoStatement->bindParam(":idCategorie", $idCategorie);
        $pdoStatement->execute();
        $record = $pdoStatement->fetch(PDO::FETCH_ASSOC);
        $categorie = Categorie::arrayToCategorie($record);
        return $categorie;
    }

    private static function arrayToCategorie(Array $array) {
        $c = new Categorie();
        $c->idCategorie = $array["idCategorie"];
        $c->libelle = $array["libelle"];
        $c->image = $array["image"];
        $c->collectionProduit = Produit::fetchAllByCategorie($c);
        return $c;
    }



    public function getIdCategorie() {
        return $this->idCategorie;
    }

    public function getLibelle() {
        return $this->libelle;
    }

    public function getImage() {
        return $this->image;
    }

    public function setLibelle($libelle): void {
        $this->libelle = $libelle;
    }

    public function setImage($image): void {
        $this->image = $image;
    }

}
