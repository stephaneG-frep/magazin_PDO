<?php 
require_once("class/ClassFruit.php");
require_once("class/ClassPanier.php");
require_once("class/ClassmonPDO.php");
require_once("class/ClassPaniersManager.php");
require_once("class/ClassFruitsManager.php");
include("common/header.php");
?>
<div class="container">
<h3 class="bg-success text-warning p-4 mt-4 mb-4 rounded-lg border-5 border border-warning">Les Paniers : </h3>

<?php 
    if(isset($_POST['idFruit']) && $_POST['type'] === "modification"){
        $idFruitToUpdate = $_POST['idFruit'];
        $poidsFruitToUpdate = (int) $_POST['poidsFruit'];
        $prixFruitToUpdate = (int) $_POST['prixFruit'];
        $res = FruitManager::updateFruitDB($idFruitToUpdate,$poidsFruitToUpdate,$prixFruitToUpdate);
        if($res){
            echo '<div class="alert alert-success mt-2" role="alert">Modifié avec succès...</div>';
        } else {
            echo ' <div class="alert alert-danger mt-2" role="alert">La modification à ratée...</div>';
        }
    } elseif (isset($_POST['idFruit']) && $_POST['type'] === "supprimer"){
        $idFruitToUpdate = $_POST['idFruit'];
        $res = FruitManager::deleteFruitFromPanier($idFruitToUpdate);
        if($res){
            echo '<div class="alert alert-success mt-2" role="alert">Supprimé avec succès...</div>';
        } else {
            echo ' <div class="alert alert-danger mt-2" role="alert">La suppression à ratée...</div>';
        }
    }


    PanierManager::setPaniersFromDB();
    foreach(Panier::$paniers as $panier){
        $panier->setFruitToPanierFromDB();
        echo $panier;
    }
?>

</div>
<?php
include_once("common/footer.php");
?>