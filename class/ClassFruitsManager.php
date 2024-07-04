<?php
require_once("class/ClassFruit.php");
require_once("class/ClassmonPDO.php");


class FruitManager{
    public static function setFruitsFromDB(){
    $pdo = MonPDO::getPDO();
    $stmt = $pdo->prepare("select f.nom as Nom, f.poids as Poids, f.prix as Prix from fruit f");
    $stmt->execute();
    $fruits = $stmt->fetchAll();
    foreach($fruits as $fruit){
        Fruits::$fruits[] = new Fruits($fruit['Nom'],$fruit['Poids'],$fruit['Prix']);
        }
    }

    public static function getNbFruitsInDB(){
        $pdo = MonPDO::getPDO();
        $req = "select count(*) as nbFruit from fruit";
        $stmt = $pdo->prepare($req);
        $stmt->execute();
        $resultat = $stmt->fetch();
        return $resultat['nbFruit'];
    }

    public static function inserIntoDB($nom, $poids, $prix, $idPanier){
        $pdo = MonPDO::getPDO();
        $req = "insert into fruit values (:nom,:poids,:prix,:idPanier)";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
        $stmt->bindValue(":poids", $poids, PDO::PARAM_INT);
        $stmt->bindValue(":prix", $prix, PDO::PARAM_INT);
        $stmt->bindValue(":idPanier", $idPanier, PDO::PARAM_INT);
        try{
            return $stmt->execute();
        } catch (PDOException $e){
            echo "Erreur : ". $e->getMessage();
            return false;
        }
    }

    public static function updateFruitDB($idFruitToUpdate,$poidsFruitToUpdate,$prixFruitToUpdate){
        $pdo = MonPDO::getPDO();
        $req = "update fruit set Poids=:poids,Prix=:prix where nom = :id";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":id", $idFruitToUpdate, PDO::PARAM_STR);
        $stmt->bindValue(":poids", $poidsFruitToUpdate, PDO::PARAM_INT);
        $stmt->bindValue(":prix", $prixFruitToUpdate, PDO::PARAM_INT);
        try{
            return $stmt->execute();
        } catch (PDOException $e){
            echo "Erreur : ". $e->getMessage();
            return false;
        }
    }

    public static function deleteFruitFromPanier($idFruitToUpdate){
        $pdo = MonPDO::getPDO();
        $req = "update fruit set identifiant = null where nom = :id";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":id", $idFruitToUpdate, PDO::PARAM_STR);
        try{
            return $stmt->execute();
        } catch (PDOException $e){
            echo "Erreur : ". $e->getMessage();
            return false;
        }
    }

    public static function getPanierFromFruit($nom){
            $pdo = MonPDO::getPDO();
            $stmt = $pdo->prepare("select p.identifiant as Client from fruit f inner join panier p
            on f.identifiant = p.identifiant where f.nom = :nom");
            $stmt->bindValue(":nom", $nom, PDO::PARAM_STR);
            $stmt->execute();
            $client = $stmt->fetch();
            return $client['Client'];
    }

    public static function updatePanierForFruitDB($idFruit,$idPanier){
        $pdo = MonPDO::getPDO();
        $req = "update fruit set identifiant = :idPanier where nom = :idFruit";
        $stmt = $pdo->prepare($req);
        $stmt->bindValue(":idFruit", $idFruit, PDO::PARAM_STR);
        $stmt->bindValue(":idPanier", $idPanier, PDO::PARAM_INT);
        try{
            return $stmt->execute();
        } catch (PDOException $e){
            echo "Erreur : ". $e->getMessage();
            return false;
        }
    }
}


?>